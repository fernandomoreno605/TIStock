<?php

namespace backend\controllers;

use backend\models\HotelesSearch;
use backend\models\TransferenciaItemsSearch;
use backend\models\User;
use backend\models\TransferenciaItems;
use backend\models\UserSearch;
use Yii;
use backend\models\Transferencias;
use backend\models\TransferenciasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;

class TransferenciasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access'=>[
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index','create','update','view'],
                'rules' => [
                    //allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    //everything else is denied
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new TransferenciasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchHotelModel = new HotelesSearch();
        $hotelProvider = $searchHotelModel->hotelList();

        $searchUserModel =  new UserSearch();
        $userProvider = $searchUserModel->userList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'hotelProvider' => $hotelProvider,
            'userProvider' => $userProvider,
        ]);
    }

    public function actionView($id)
    {
        $searchHotel = new HotelesSearch();
        $searchModel = new TransferenciaItemsSearch();
        $searchModel->transferencias_transferencia_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $idHotel = $this->findModel($id)->transferencia_destino_id;

        $hotelName = $searchHotel->getHotelName($idHotel);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'hotelName' => $hotelName,
        ]);
    }

    public function actionCreate()
    {

        $modelsTransItems = [new TransferenciaItems];
        $model = new Transferencias();

        if ($model->load(Yii::$app->request->post())) {

            $idUsuario = Yii::$app->user->id;
            $consulta = User::findOne($idUsuario);
            $hotelId = $consulta->hoteles_hotel_id;

            $model->transferencia_status = 'en camino';
            $model->usuarios_usuario_id = $idUsuario;
            $model->hoteles_hotel_id = $hotelId;

            if ($model->save()) {

                $modelsTransItems = Model::createMultiple(TransferenciaItems::classname());
                Model::loadMultiple($modelsTransItems, Yii::$app->request->post());

            // validate all models
                //validate the main model
                $valid = $model->validate();
                //validate the second model, it's necessary veryficated the second model, because 
                //if have a foreing key required, not pass this validation, it´s neccessary remove them
                $valid = Model::validateMultiple($modelsTransItems) && $valid;

                if ($valid) {
                    
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            foreach ($modelsTransItems as $modelTransItem) {
                                $modelTransItem->transferencias_transferencia_id = $model->transferencia_id;
                                if (! ($flag = $modelTransItem->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->transferencia_id]);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
            }
            //return $this->redirect(['view', 'id' => $model->transferencia_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'modelsTransItems' => (empty($modelsTransItems)) ? [new TransferenciaItems] : $modelsTransItems,

        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->transferencia_status != 'entregada'){
            $hotelSeek = new HotelesSearch();
            $hotelsProvider = $hotelSeek->listing();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->transferencia_id]);
            }

            return $this->render('update', [
                'model' => $model,
                'hotelsProvider' => $hotelsProvider,
            ]);
        }else{
            return $this->redirect(['view', 'id' => $model->transferencia_id]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Transferencias::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
