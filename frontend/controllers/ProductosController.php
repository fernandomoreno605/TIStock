<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Productos;
use frontend\models\ProductosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\User;
use yii\web\UploadedFile;


/**
 * ProductosController implements the CRUD actions for Productos model.
 */
class ProductosController extends Controller
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
                'only' => ['index','create','update','view','quantity'],
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
    public function actionQuantity($id){
        $query = Productos::findOne(['product_id' => $id]);
        $quantity = $query['product_stock'];

        if ($quantity != 0){
            for($i = 1; $i <= $quantity; $i++ ){
                echo "<option>".$i."</option>";
            }
        }else{
            echo '<option>'.Yii::t('app','First Select a Product') .' </option>';
        }

        //echo "<option> - </option>";
        //return $quantity;
    }

    public function actionIndex()
    {
        $searchModel = new ProductosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $productList = $searchModel->productsAsArray();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'productList' => $productList,
        ]);
    }

    public function actionView($id)
    {
        $data = $this->findModel($id);
        if ($data->hoteles_hotel_id != $_SESSION['current_hotel']){
            return $this->redirect(['index']);

        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

        }
    }

    public function actionCreate()
    {
        $model = new Productos();

        if ($model->load(Yii::$app->request->post())) {

            $imageName = $model->product_name.$_SESSION['current_hotel'];

            $file = UploadedFile::getInstance($model,'file');
            if ($file != null){
                $model->file = UploadedFile::getInstance($model,'file');
                $model->file->saveAs('product/'.$imageName.'.'.$model->file->extension);
                $model->product_image = 'product/'.$imageName.'.'.$model->file->extension;
            }
            if ($model->product_stock == 0){
                $model->product_status = 'inactive';
            }
            $model->hoteles_hotel_id = $_SESSION['current_hotel'];
            $model->product_created_date = date('Y:m:d');
            $model->save();
            return $this->redirect(['view', 'id' => $model->product_id]);

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $imageName = $model->product_name.$_SESSION['current_hotel'];

            $file = UploadedFile::getInstance($model,'file');
            if ($file != null){

                $model->file = UploadedFile::getInstance($model,'file');
                $model->file->saveAs('product/'.$imageName.'.'.$model->file->extension);
                $model->product_image = 'product/'.$imageName.'.'.$model->file->extension;

            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->product_id]);
        }
        if ($model->hoteles_hotel_id != $_SESSION['current_hotel']){
            return $this->redirect(['index']);
        }else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $validation = $this->findModel($id);
        if ($validation->hoteles_hotel_id != $_SESSION['current_hotel']){
            return $this->redirect(['index']);
        }else{
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
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
                    '.Yii::t('app', 'The password doesn\'t match').'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $alert;
    }

    protected function findModel($id)
    {
        if (($model = Productos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}