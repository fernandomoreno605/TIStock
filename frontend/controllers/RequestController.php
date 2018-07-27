<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Request;
use frontend\models\RequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Comments;
use frontend\models\Hoteles;
use frontend\models\HotelesSearch;
use frontend\models\UserSearch;
class RequestController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchHotel = new HotelesSearch();
        $hotelProvider = $searchHotel->listing();

        $searchUser = new UserSearch();
        $userProvider = $searchUser->listingUsers();

        if ($_SESSION['user_type'] != 'admin'){
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->render('admin/index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'hotelProvider' => $hotelProvider,
                'userProvider' => $userProvider,
            ]);
        }
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $dataHotel = Hoteles::findOne(['hotel_id' => $model->hotel_made_id]);

        $name = $dataHotel['hotel_name'];

        return $this->render('view', [
            'model' => $this->findModel($id),
            'name' => $name,
            'alert' => null,
        ]);
    }

    public function actionCreate()
    {
        $model = new Request();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_made_id = $_SESSION['user_id'];
            $model->hotel_made_id = $_SESSION['current_hotel'];
            $model->request_status = 'On hold';

            if ($model->save()){
                $query = Hoteles::find()
                    ->asArray()
                    ->all();
                $hotelMadeData = Hoteles::findOne(['hotel_id' => $model->hotel_made_id]);

                foreach ($query as $item){
                    if ($item['hotel_id'] != $model->hotel_made_id){
                        $comment = new Comments();
                        $comment->hoteles_hotel_id = $item['hotel_id'];
                        $comment->url = 'index.php?r=request/view&id='.$model->request_id;
                        $comment->comment_status = 0;
                        $comment->coment_subjet = 'Transfer Request';
                        $comment->comment_text = 'The hotel: '.$hotelMadeData->hotel_name.' requires a transfer' ;
                        $comment->timestamp = date('Y:m:d H:i:s');
                        $comment->save();
                    }
                }
                return $this->redirect(['view', 'id' => $model->request_id]);

            }
            return $this->redirect(['view', 'id' => $model->request_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionAccept($id)
    {
        $model = $this->findModel($id);
        if (($model->hotel_made_id != $model->hotel_acept_id)&& $model->request_status != 'Accepted'){
            $model->hotel_acept_id = $_SESSION['current_hotel'];
            $model->user_acept_id = $_SESSION['user_id'];
            $model->request_status = 'Accepted';
            if ($model->save()){

                $findHotel = Hoteles::findOne(['hotel_id' => $model->hotel_acept_id]);

                $notification = new Comments();
                $notification->hoteles_hotel_id = $model->hotel_made_id;
                $notification->timestamp = date('Y:m:d H:i:s');
                $notification->coment_subjet = 'Request accept';
                $notification->comment_text = 'Your Transfer Request was accepted by: '.$findHotel->hotel_name;
                $notification->comment_status = 0;
                $notification->url = 'index.php?r=request/view&id='.$model->request_id;
                $notification->save();

                $model = $this->findModel($id);
                $dataHotel = Hoteles::findOne(['hotel_id' => $model->hotel_made_id]);

                $name = $dataHotel['hotel_name'];

                return $this->render('view', [
                    'model' => $model,
                    'alert' => $this->successful(),
                    'name' => $name,
                ]);
            }
        }
        return $this->redirect(['index']);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->hotel_made_id == $_SESSION['current_hotel']){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->request_id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            return $this->redirect(['index']);
        }
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($_SESSION['current_hotel'] == $model->hotel_made_id){
            $model->delete();
            return $this->redirect(['index']);
        }else{
            return $this->redirect(['index']);
        }
    }
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
