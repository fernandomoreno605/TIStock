<?php
namespace frontend\controllers;

use common\models\LoginFormCommon;
use frontend\models\HotelesSearch;
use frontend\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
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

    /**
     * when the user made a click on the notification and is redirect to the url allowed
     * in the notification, change the status in the database to 1 that's equal to saw
     **/
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
    /**
     * when the user select another hotel in the float buttons of the main view,
     * changes the current hotel id to display all related whit the hotel, like a
     * products, loans, etc.
     **/

    public function actionChange(){
        if (isset($_POST['h'])){
            $seachHotelModel = new HotelesSearch();
            $name = $seachHotelModel->getHotelName($_POST['h']);
            $_SESSION['current_hotel'] = $_POST['h'];
            $_SESSION['current_hotel_name'] = $name;
        }
    }
    /**
     * the function erase the notification from the database when the user made a click in the
     * "x" symbol
     **/
    public function actionErase(){
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            if ($id != null){
                $query = Comments::findOne($id);
                $query->delete();
            }
        }
    }
    /**
     * return the main view
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     *return the view login and make the process of get the data of the logged user
     */
    public function actionLogin()
    {
        $this->layout = 'loginLayout';
        //if the user are logged return the main view
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

            //Setting session data of the logged user
            $_SESSION['user_type'] = $userData->user_type;
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
    /**
     *the function language changes the application language
     */
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
