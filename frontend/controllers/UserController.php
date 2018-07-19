<?php

namespace frontend\controllers;

use Yii;
use frontend\models\User;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
        ];
    }

    public function actionView()
    {
        return $this->render('view', [
            'model' => $this->findModel($_SESSION['user_id']),
            'alert' => null,
        ]);
    }
    public function actionPassword(){
        $model = $this->findModel($_SESSION['user_id']);
        //$alert = null;
        $model->password = null;

        if ($model->load(Yii::$app->request->post())){
            if ($model->password === $model->confirm_password){
                if($model->password != null && $model->confirm_password != null){
                    $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                    $model->save();
                    return $this->render('view', [
                        'model' => $this->findModel($_SESSION['user_id']),
                        'alert' => $this->successful(),
                    ]);
                }

                return $this->render('_password',[
                    'model' => $model,
                    'alert' => $this->voidFields(),
                ]);
            }
            else{
                $model->password = null;
                $model->confirm_password = null;
                return $this->render('_password',[
                    'model' => $model,
                    'alert' => $this->error(),
                ]);
            }
        }
        return $this->render('_password',[
            'model' => $model,
            'alert' => null,
        ]);
    }
    public function actionUpdate()
    {
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
                return $this->render('view',[
                    'model' => $this->findModel($_SESSION['user_id']),
                    'alert' => $this->successful(),
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
    public function voidFields(){
        $alert = '<div class="alert alert-danger alert-dismissable" role="alert">
                    '.Yii::t('app', 'Please fill all the fields').'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $alert;
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
