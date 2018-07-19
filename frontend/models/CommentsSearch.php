<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Comments;

class CommentsSearch extends Comments
{
    public function rules()
    {
        return [
            [['id_comment', 'hoteles_hotel_id', 'comment_status'], 'integer'],
            [['coment_subjet', 'comment_text', 'timestamp', 'url'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    public function search($params)
    {
        $query = Comments::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_comment' => $this->id_comment,
            'hoteles_hotel_id' => $this->hoteles_hotel_id,
            'comment_status' => $this->comment_status,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'coment_subjet', $this->coment_subjet])
            ->andFilterWhere(['like', 'comment_text', $this->comment_text])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
    public function getNotificationsByHotelId(){
        //head of the notifications list html
        $notifications = '<ul id="" class="dropdown-menu">';

        //find all notifications for the current hotel
        $query = Comments::find()
            ->where(['hoteles_hotel_id' => $_SESSION['current_hotel']])
            ->orderBy(['timestamp' => SORT_DESC])
            ->asArray()
            ->all();
        //condition to fill the body with notifications
        if ($query != null){
            foreach ($query as $item) {
                //condition to put one specific style for seen and unseen notifications
                if ($item['comment_status'] == 0){
                    $notifications = $notifications.'
                        <li class="alert alert-custom alert-dismissable">
                            <button id="'.$item['id_comment'].'" type="button" class="close" data-dismiss="alert">×</button>            
                            <a class="notification" id="'.$item['id_comment'].'" href="'.$item['url'].'"><strong>'
                                .$item['coment_subjet'].'
                            </strong><br />
                            <small><em>
                            '.$item['comment_text'].'
                            </em></small>
                            </a>
                        </li>';
                }else{
                    $notifications = $notifications.'
                        <li class="alert alert-light alert-dismissable">
                            <button id="'.$item['id_comment'].'" type="button" class="close" data-dismiss="alert">×</button>            
                            <a class="notification" id="'.$item['id_comment'].'" href="'.$item['url'].'"><strong>'
                                .$item['coment_subjet'].'
                            </strong><br />
                            <small><em>
                            '.$item['comment_text'].'
                            </em></small>
                            </a>
                        </li>';
                }
            }
        }
        $notifications = $notifications.'</ul>';

        return $notifications;
    }
    public function getNotificationsUnseen()
    {
        $query = Comments::find()
            ->where(['hoteles_hotel_id' => $_SESSION['current_hotel']])
            ->andWhere(['comment_status' => 0])
            ->count();
        if ($query != 0){
            return $query;
        }else{
            return null;
        }

    }
}
