<?php

namespace frontend\controllers;

use frontend\models\Comments;
use yii\bootstrap\Alert;
use frontend\models\HotelesSearch;
use frontend\models\ProductosSearch;
use frontend\models\TransferenciaItemsSearch;
use Yii;
use frontend\models\Transferencias;
use frontend\models\TransferenciasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\TransferenciaItems;
use frontend\models\User;
use frontend\models\Model;
use frontend\models\Productos;

class TransferenciasController extends Controller
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
                'only' => ['index','create','update','view','received'.'assign'],
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

        return $this->render('common/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReceived()
    {

        $searchModel = new TransferenciasSearch();
        $dataProvider = $searchModel->searchRecived(Yii::$app->request->queryParams);

        return $this->render('common/received', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    public function actionView($id)
    {
        $searchHotel = new HotelesSearch();
        $searchModel = new TransferenciaItemsSearch();
        $searchModel->transferencias_transferencia_id = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $idHotel = $this->findModel($id)->transferencia_destino_id;
        $idHotelOrigin = $this->findModel($id)->hoteles_hotel_id;

        $hotelName = $searchHotel->getHotelName($idHotel);

        $validation = $this->findModel($id);

        if ($validation->hoteles_hotel_id == $_SESSION['current_hotel'] || $validation->transferencia_destino_id == $_SESSION['current_hotel']){
            return $this->render('common/view', [
                'model' => $this->findModel($id),
                'dataProvider' => $dataProvider,
                'hotelName' => $hotelName,
                'idHotelDestination' => $idHotel,
                'idHotelOrigin' => $idHotelOrigin,
            ]);
        }else{
            return $this->redirect(['index']);
        }
    }

    public function actionCreate()
    {
        //creating search model to get all the active product of the current hotel
        $searchModel = new ProductosSearch();
        $hotelSeek = new HotelesSearch();
        $dataProvider = $searchModel->searchBy();
        $count = $searchModel->countActive();
        $hotelsProvider = $hotelSeek->listing();
        $modelsTransItems = [new TransferenciaItems];
        $model = new Transferencias();

        if ($model->load(Yii::$app->request->post())) {
            //set main data about the user who made the register

            $model->transferencia_status = 'to deliver';
            $model->usuarios_usuario_id = $_SESSION['user_id'];
            $model->hoteles_hotel_id = $_SESSION['current_hotel'];

            if ($model->save()) {

                $newComment = new Comments();
                $newComment->timestamp = date('Y:m:d H:i:s');
                $newComment->hoteles_hotel_id = $model->transferencia_destino_id;
                $newComment->coment_subjet  = 'Transfers';
                $newComment->comment_text = 'You received a new transfer';
                $newComment->url = 'index.php?r=transferencias%2Fview&id='.$model->transferencia_id;
                $newComment->comment_status = 0;
                $newComment->save();

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
                                //changing the stock quantity
                                $actualProduct = Productos::findOne(['product_id' => $modelTransItem->productos_producto_id]);
                                $oldQuantity = $actualProduct->product_stock;
                                $rest = $modelTransItem->cantidad;
                                $newQuantity = $oldQuantity - $rest;
                                $actualProduct->product_stock = $newQuantity;
                                if ($newQuantity == 0){
                                    $actualProduct->product_status = 'inactive';
                                }
                                $actualProduct->save();
                                //end of stock update
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

        }

        return $this->render('common/create', [
            'model' => $model,
            'hotelsProvider' => $hotelsProvider,
            'count' => $count,
            'dataProvider' => $dataProvider,
            'modelsTransItems' => (empty($modelsTransItems)) ? [new TransferenciaItems] : $modelsTransItems,
        ]);
    }

    public function actionUpdate($id){

        $model = $this->findModel($id);
        $hotelSeek = new HotelesSearch();
        $hotelsProvider = $hotelSeek->listing();

        $destination = $this->findModel($id)->transferencia_destino_id;
        $origin = $this->findModel($id)->hoteles_hotel_id;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->transferencia_status == 'delivered'){
                $model->usuarios_usuario_recibe = $_SESSION['user_id'];

                $newQuery = new Comments();
                $newQuery->timestamp = date('Y:m:d H:i:s');
                $newQuery->hoteles_hotel_id = $model->hoteles_hotel_id;
                $newQuery->coment_subjet  = 'Transfers';
                $newQuery->comment_text = 'Transfer delivered';
                $newQuery->url = 'index.php?r=transferencias/view&id='.$model->transferencia_id;
                $newQuery->comment_status = 0;
                $newQuery->save();
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->transferencia_id]);
        }
        //$model->transferencia_status != 'entregada'
        if ($model->hoteles_hotel_id == $_SESSION['current_hotel'] or $model->transferencia_destino_id == $_SESSION['current_hotel']){
            if ($model->transferencia_status != 'delivered'){
                return $this->render('common/update', [
                    'model' => $model,
                    'hotelsProvider' => $hotelsProvider,
                    'destination' => $destination,
                    'origin' => $origin,
                ]);
            }else{
                return $this->redirect(['view', 'id' => $model->transferencia_id]);
            }

        }else{
            return $this->redirect(['view', 'id' => $model->transferencia_id]);
        }
    }

    public function actionAssign($id)
    {
        $searchModel = new ProductosSearch();

        $model = $this->findModel($id);

        $searchModelItem = new TransferenciaItemsSearch();
        $itemProvider = $searchModelItem->searchItemsByTransferId($id);

        if ($model->load(Yii::$app->request->post())) {
            try{
                if (isset($_POST['Transferencias']['producto_destino'])){

                    $origen = $_POST['Transferencias']['producto_origen'];
                    $destino = $_POST['Transferencias']['producto_destino'];

                    if ($destino != null){
                        for ($i=0;$i<sizeof($origen);$i++){
                            $query = TransferenciaItems::findOne(['productos_producto_id' => $origen[$i],
                                'transferencias_transferencia_id'=> $id]);
                            $update = Productos::findOne(['product_id' => $destino[$i]]);
                            $addQuantity = $query->cantidad;
                            $oldQuantity = $update->product_stock;
                            $newQuantity = $oldQuantity + $addQuantity;
                            $update->product_stock = $newQuantity;
                            $query->item_status = 1;
                            $update->save();
                            $query->save();
                        }
                    }
                }
                if (isset($_POST['Transferencias']['nuevo_producto'])){
                    $newProduct = $_POST['Transferencias']['nuevo_producto'];
                    if ($newProduct != null){
                        foreach ($newProduct as $product) {
                            $actualProduct = Productos::findOne(['product_id' => $product]);
                            $addProduct = new Productos();
                            $addProduct->product_id = null;
                            $addProduct->product_name = $actualProduct->product_name;
                            $addProduct->product_branch = $actualProduct->product_branch;
                            $addProduct->product_provider = $actualProduct->product_provider;
                            $addProduct->product_created_date = date('y:m:d');
                            $addProduct->product_status = 'active';

                            $dataItemTransfer = TransferenciaItems::findOne(['transferencias_transferencia_id' => $id,
                                'productos_producto_id' => $product]);

                            $transferData = Transferencias::findOne(['transferencia_id' => $id]);

                            $addProduct->product_stock = $dataItemTransfer->cantidad;
                            $addProduct->hoteles_hotel_id = $transferData->transferencia_destino_id;
                            $addProduct->save();
                            $dataItemTransfer->item_status = 1;
                            $dataItemTransfer->save();
                        }
                    }
                }
                //$model->save();
                return $this->redirect(['view', 'id' => $model->transferencia_id]);

            }catch (\Exception $e){
                return $this->render('common/_assign', [
                    'itemProvider' => $itemProvider,
                    'alert' => $this->error(),
                ]);
            }

        }
        return $this->render('common/_assign', [
            'itemProvider' => $itemProvider,
            'alert' => null,
        ]);
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
    public function successful(){
        $alert = '<div class="alert alert-success alert-dismissable" role="alert">
                    '.Yii::t('app', 'Update Successful').'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $alert;
    }
    public function error(){
        $alert = '<div class="alert alert-danger alert-dismissable" role="alert">
                    '.Yii::t('app', 'Please fill all the fields').'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $alert;
    }

}
