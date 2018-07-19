<?php

namespace backend\controllers;

use backend\models\HotelesSearch;
use backend\models\PrestamoArticulos;
use backend\models\User;
use backend\models\UserSearch;
use Yii;
use backend\models\Prestamos;
use backend\models\PrestamosSearch;
use backend\models\PrestamoArticulosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;


/**
 * PrestamosController implements the CRUD actions for Prestamos model.
 */
class PrestamosController extends Controller
{
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

    /**
     * Lists all Prestamos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrestamosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchHotelModel = new HotelesSearch();
        $hotelProvider = $searchHotelModel->hotelList();

        $userSearchModel = new UserSearch();
        $userProvider = $userSearchModel->userList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'hotelProvider' => $hotelProvider,
            'userProvider' => $userProvider,
        ]);
    }

    public function actionView($id)
    {
        $searchModel = new PrestamoArticulosSearch();
        $searchModel->prestamos_prestamo_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $modelsPrestamosArticulo= [new PrestamoArticulos];

        $model = new Prestamos();

        if($model->load(Yii::$app->request->post())){
            $idUsuario = Yii::$app->user->id;
            $consulta = User::findOne($idUsuario);
            $hotelId = $consulta->hoteles_hotel_id;

            $model->users_user_id = $idUsuario;
            $model->hoteles_hotel_id = $hotelId;
            $model->prestamo_fecha = date('Y:m:d');
            $model->prestamo_status = 'on loan';

            if ($model->save()) {


                $modelsPrestamosArticulo = Model::createMultiple(PrestamoArticulos::classname());
                Model::loadMultiple($modelsPrestamosArticulo, Yii::$app->request->post());

                // validate all models
                $valid = $model->validate();
                $valid = Model::validateMultiple($modelsPrestamosArticulo) && $valid;

                if ($valid) {
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        if ($flag = $model->save(false)) {
                            foreach ($modelsPrestamosArticulo as $modelPrestamosArticulo) {
                                $modelPrestamosArticulo->prestamos_prestamo_id = $model->prestamo_id;
                                if (! ($flag = $modelPrestamosArticulo->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                        if ($flag) {
                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->prestamo_id]);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                    }
                }
                //return $this->redirect(['view', 'id' => $model->prestamo_id]);
            }

        }

        return $this->render('create', [

            'model' => $model,
            'modelsPrestamosArticulo' => (empty($modelsPrestamosArticulo)) ? [new PrestamoArticulos()] : $modelsPrestamosArticulo,
        ]);
    }

    /**
     * Updates an existing Prestamos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->save();
            return $this->redirect(['view', 'id' => $model->prestamo_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Prestamos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
