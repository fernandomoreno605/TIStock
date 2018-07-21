<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\User;
use backend\models\UserSearch;
use backend\models\Comments;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,

                    ],
                    [
                        'actions' => ['logout', 'index','see','erase'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionSee(){
        if (isset($_POST['lang'])){
            $id = $_POST['lang'];
            if ($id != null){
                $query = Comments::findOne($id);
                $query->comment_status = 1;
                $query->save();
            }
        }
    }
    public function actionErase(){
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            if ($id != null){
                $query = Comments::findOne($id);
                $query->delete();
            }
        }
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = 'loginLayout';
        if (!Yii::$app->user->isGuest) {

            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $id = Yii::$app->user->id;
            $userData = User::findOne($id);

            $idHotel = $userData->hoteles_hotel_id;

            $_SESSION['user_id'] = $id;
            $_SESSION['current_hotel']= $idHotel;

            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
