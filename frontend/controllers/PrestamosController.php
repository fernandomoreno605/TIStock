<?php

namespace frontend\controllers;
use frontend\models\HotelesSearch;
use frontend\models\PrestamoArticulos;
use frontend\models\Productos;
use frontend\models\ProductosSearch;
use frontend\models\User;
use frontend\models\UserSearch;
use Yii;
use frontend\models\Prestamos;
use frontend\models\PrestamosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Model;
use frontend\models\PrestamoArticulosSearch;

class PrestamosController extends Controller
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
        $searchModel = new PrestamosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchHotel = new HotelesSearch();
        $hotelProvider = $searchHotel->listing();

        $searchUser = new UserSearch();
        $userProvider = $searchUser->listingUsers();

        if ($_SESSION['user_type'] != 'admin'){
            return $this->render('common/index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        return $this->render('admin/index', [
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

        $validation = $this->findModel($id);
        if ($_SESSION['user_type'] != 'admin'){
            if ($validation->hoteles_hotel_id != $_SESSION['current_hotel']){
                return $this->redirect(['index']);
            }else{
                return $this->render('common/view', [
                    'model' => $this->findModel($id),
                    'dataProvider' => $dataProvider,
                ]);
            }
        }
        return $this->render('admin/view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionCreate()
    {
        //creating search model to get all the active product of the current hotel
        $searchModel = new ProductosSearch();
        $dataProvider = $searchModel->searchBy();
        $count = $searchModel->countActive();

        $modelsPrestamosArticulo= [new PrestamoArticulos];
        $model = new Prestamos();

        if ($model->load(Yii::$app->request->post())) {

            $model->users_user_id = $_SESSION['user_id'];
            $model->hoteles_hotel_id = $_SESSION['current_hotel'];
            $model->prestamo_fecha = date('Y:m:d');
            $model->prestamo_status = 'on loan';

            if ($model->save()) {
                //getting data of current hotel
                //multiple insertion to the db
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
                                //updating the stock
                                $actualProduct = Productos::findOne(['product_id' => $modelPrestamosArticulo->productos_product_id]);
                                $oldQuantity = $actualProduct->product_stock;
                                $rest = $modelPrestamosArticulo->producto_cantidad;
                                $newQuantity = $oldQuantity - $rest;
                                if ($newQuantity == 0){
                                    $actualProduct->product_status = 'inactive';
                                }
                                $actualProduct->product_stock = $newQuantity;
                                $actualProduct->save();
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
        if ($_SESSION['user_type'] != 'admin'){
            return $this->render('common/create', [
                'model' => $model,
                'count' => $count,
                'dataProvider' => $dataProvider,
                'modelsPrestamosArticulo' => (empty($modelsPrestamosArticulo)) ? [new PrestamoArticulos()] : $modelsPrestamosArticulo,

            ]);
        }else{
            return $this->goBack();
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $validate = Prestamos::findOne(['prestamo_id' =>$id]);
            if ($validate->prestamo_fecha_entrega == null && $validate->prestamo_status != 'delivered'){
                $model->prestamo_fecha_entrega = date('Y:m:d');
                if ($model->save()){
                    $inLoan = PrestamoArticulos::find()
                        ->where(['prestamos_prestamo_id' => $id])
                        ->asArray()
                        ->all();

                    foreach ($inLoan as $item){
                        $actualProduct = Productos::findOne(['product_id' => $item['productos_product_id']]);
                        $oldQuantity = $actualProduct->product_stock;
                        $plusQuantity = $item['producto_cantidad'];
                        $updateQuantity = $oldQuantity + $plusQuantity;
                        $actualProduct->product_stock = $updateQuantity;
                        $actualProduct->product_status = 'active';
                        $actualProduct->save();
                    }
                }
            }

            return $this->redirect(['view', 'id' => $model->prestamo_id]);
        }

        if ($model->hoteles_hotel_id != $_SESSION['current_hotel'] or $model->prestamo_status == 'delivered'){
            return $this->redirect(['index']);
        }else{
            return $this->render('common/update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $validation = $this->findModel($id);
        if ($_SESSION['user_type'] != 'admin'){
            if ($validation->hoteles_hotel_id != $_SESSION['current_hotel']){
                return $this->redirect(['index']);
            }else{
                $this->findModel($id)->delete();
                return $this->redirect(['index']);
            }
        }else{
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }
    }

    protected function findModel($id)
    {
        if (($model = Prestamos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
