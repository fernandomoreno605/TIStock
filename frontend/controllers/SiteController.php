<?php
namespace frontend\controllers;

use common\models\LoginFormCommon;
use frontend\models\Hoteles;
use frontend\models\HotelesSearch;
use frontend\models\User;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Comments;
use frontend\models\AuthHotelSearch;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['login','error','language'],
                        'allow' => true,
                        //'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','index','change','see','erase'],
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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

    public function actionChange(){
        if (isset($_POST['h'])){
            $seachHotelModel = new HotelesSearch();
            $name = $seachHotelModel->getHotelName($_POST['h']);
            $_SESSION['current_hotel'] = $_POST['h'];
            $_SESSION['current_hotel_name'] = $name;
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

        $model = new LoginFormCommon();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $id = Yii::$app->user->id;
            $userData = User::findOne($id);
            $idHotel = $userData->hoteles_hotel_id;

            $searchHotelModel = new HotelesSearch();
            $hotelName = $searchHotelModel->getHotelName($idHotel);

            $searchPermissionsModel = new AuthHotelSearch();
            $permissions = $searchPermissionsModel->permissionsList($id);
            //Setting session data
            $_SESSION['user_id'] = $id;
            $_SESSION['current_hotel']= $idHotel;
            $_SESSION['username'] = $userData->username;
            $_SESSION['name'] = $userData->first_name.' '.$userData->last_name;
            $_SESSION['image'] = $userData->user_image;
            $_SESSION['current_hotel_name'] = $hotelName;
            $_SESSION['hotel_permissions'] = $permissions;

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

    public function actionLanguage(){
        if (isset($_POST['lang'])){
            Yii::$app->language = $_POST['lang'];
            $cookie =new yii\web\Cookie([
                'name' => 'lang',
                'value' => $_POST['lang']
            ]);
            Yii::$app->getResponse()->getCookies()->add($cookie);
        }
    }
}
