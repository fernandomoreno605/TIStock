<?php

namespace frontend\controllers;

use common\widgets\Alert;
use Yii;
use frontend\models\User;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use frontend\models\HotelesSearch;
use frontend\models\AuthHotel;
use frontend\models\Hoteles;
use frontend\models\AuthHotelSearch;
use frontend\views\alerts\Alerts;
class UserController extends Controller
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
            //access to the views
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
            //end of the access rule
        ];
    }

    public function actionIndex()
    {
        if($_SESSION['user_type'] != 'admin'){
            return $this->goBack();
        }else{
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $searchHotelModel = new HotelesSearch();
            $hotelProvider = $searchHotelModel->hotelList();

            return $this->render('admin/index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'hotelProvider' => $hotelProvider,
            ]);
        }
    }

    public function actionCreate()
    {
        $model = new User();
        $modelAuth = new AuthHotel();
        $hotelList = $this->AuthItems();
        if ($model->load(Yii::$app->request->post())) {

            $pass = $model->password_hash;

            $model->password_hash = Yii::$app->security->generatePasswordHash($pass);
            $model->auth_key = Yii::$app->security->generateRandomString();
            $model->status = 10;
            $model->created_at = 0;
            $model->updated_at=0;



            if ($model->save()){
                if(isset($_POST['User']['permissions'])){
                    $permissionsList = $_POST['User']['permissions'];
                    if ($permissionsList != null) {
                        foreach ($permissionsList as $values) {
                            $newPermissions = new AuthHotel();
                            $newPermissions->users_user_id= $model->id;
                            $newPermissions->hoteles_hotel_id = $values;
                            $newPermissions->save();
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                $model->password_hash='';
            }
        }
        if ($_SESSION['user_type'] == 'admin') {
            return $this->render('admin/create', [
                'model' => $model,
                'hotelList' => $hotelList,
                'modelAuth' => $modelAuth,
            ]);
        }else{
            return $this->redirect('index');
        }
    }

    public function actionView($id)
    {
        $seachModel = new AuthHotelSearch();
        $seachModel->users_user_id = $id;
        $dataProvider = $seachModel->search(Yii::$app->request->queryParams);

        if ($_SESSION['user_type']!='admin'){
            return $this->render('common/view', [
                'model' => $this->findModel($_SESSION['user_id']),
            ]);
        }
        else{
            return $this->render('admin/view', [
                'model' => $this->findModel($id),
                'dataProvider' => $dataProvider,
            ]);

        }
    }

    public function actionPassword($id){
        //condition: if the user is common
        $alert = new Alerts();
        if ($_SESSION['user_type']!= 'admin'){
            $model = $this->findModel($_SESSION['user_id']);
            $model->password = null;
            if ($model->load(Yii::$app->request->post())){
                if ($model->password === $model->confirm_password){
                    if($model->password != null && $model->confirm_password != null){
                        $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                        $model->save();
                        return $this->render('common/view', [
                            'model' => $this->findModel($_SESSION['user_id']),
                            'alert' => $alert->updateAlert(),
                        ]);
                    }
                    return $this->render('common/_password',[
                        'model' => $model,
                        'alert' => $alert->voidFields(),
                    ]);
                }
                else{
                    $model->password = null;
                    $model->confirm_password = null;
                    return $this->render('common/_password',[
                        'model' => $model,
                        'alert' => $alert->notMatch(),
                    ]);
                }
            }
            return $this->render('common/_password',[
                'model' => $model,
            ]);
        }//end of the part of commun user

        //start of admin user
        else{

            $model = $this->findModel($id);
            $model->password = null;

            if ($model->load(Yii::$app->request->post())){
                if ($model->password === $model->confirm_password){
                    if($model->password != null && $model->confirm_password != null){
                        $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                        $model->save();

                        $seachModel = new AuthHotelSearch();
                        $seachModel->users_user_id = $id;
                        $dataProvider = $seachModel->search(Yii::$app->request->queryParams);

                        return $this->render('admin/view', [
                            'model' => $this->findModel($id),
                            'dataProvider' => $dataProvider,
                            'alert' => $this->successful(),
                        ]);
                    }

                    return $this->render('admin/_password',[
                        'model' => $model,
                        'alert' => $alert->voidFields(),
                    ]);
                }
                else{
                    $model->password = null;
                    $model->confirm_password = null;
                    return $this->render('admin/_password',[
                        'model' => $model,
                        'alert' => $alert->notMatch(),
                    ]);
                }
            }
            return $this->render('admin/_password',[
                'model' => $model,
            ]);
        }//end of admin user
    }

    public function actionUpdate($id)
    {
        $alert = new Alerts();
        if ($_SESSION['user_type'] != 'admin'){
            $model = $this->findModel($_SESSION['user_id']);

            if ($model->load(Yii::$app->request->post())) {
                $imageName = $model->username;
                $file = UploadedFile::getInstance($model,'file');
                if ($file != null){
                    $model->file = UploadedFile::getInstance($model,'file');
                    $model->file->saveAs('user/'.$imageName.'.'.$model->file->extension);
                    $model->user_image = 'user/'.$imageName.'.'.$model->file->extension;
                }
                if ($model->save()){
                    $_SESSION['username'] = $model->username;
                    $_SESSION['name'] = $model->first_name.' '.$model->last_name;
                    $_SESSION['image'] = $model->user_image;
                    return $this->render('common/view',[
                        'model' => $this->findModel($_SESSION['user_id']),
                        'alert' => $alert->updateAlert(),
                    ]);
                }
            }
            return $this->render('common/update', [
                'model' => $model,
            ]);
        }else{
            $model = $this->findModel($id);
            $hotelList = $this->AuthAllowed($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                if(isset($_POST['User']['permissions'])){
                    $permissionsList = $_POST['User']['permissions'];
                    if ($permissionsList != null) {
                        AuthHotel::deleteAll(['users_user_id' => $id]);
                        foreach ($permissionsList as $values) {
                            $newPermissions = new AuthHotel();
                            $newPermissions->users_user_id= $model->id;
                            $newPermissions->hoteles_hotel_id = $values;
                            $newPermissions->save();
                        }
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->render('admin/update', [
                'model' => $model,
                'hotelList' => $hotelList,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function AuthItems(){
        $list='<div id="user-permissions">
        <label class="control-label" >User Permissions</label>
        <br/><br/>';

        $hotelItems = Hoteles::find()->All();
        foreach ($hotelItems as $item){
            $list = $list.'<label>
							<input type="checkbox" value="'.$item['hotel_id'].'"name="User[permissions][]"> '
                .$item['hotel_name'].'</label><br/>';
        }
        $list=$list.'</div>';
        return $list;
    }

    public function AuthAllowed($id){
        $list='<div id="user-permissions">
        <label class="control-label" >User Permissions</label>
        <br/><br/>';
        $hotelItems = Hoteles::find()->All();
        $allowedTo = AuthHotel::find()
            ->where(['users_user_id' => $id])
            ->All();
        foreach ($hotelItems as $item){
            $i = 0;
            foreach ($allowedTo as $permission){
                if ($item['hotel_id'] == $permission['hoteles_hotel_id']){
                    $i++;
                    $list = $list.'<label>
							<input type="checkbox" value="'.$item['hotel_id'].'"name="User[permissions][]" checked> '
                        .$item['hotel_name'].'</label><br/>';
                }
            }
            if ($i ==0){
                $list = $list.'<label>
							<input type="checkbox" value="'.$item['hotel_id'].'"name="User[permissions][]"> '
                    .$item['hotel_name'].'</label><br/>';
            }
        }
        $list=$list.'</div>';
        return $list;
    }
}