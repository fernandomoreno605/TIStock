<?php
namespace frontend\views\alerts;
/**
 * Created by PhpStorm.
 * User: Fernando
 * Date: 27/07/2018
 * Time: 04:01 PM
 */
use Yii;
class Alerts
{
    public function dangerAlert($message){
        $alert = '<div class="alert alert-danger alert-dismissable" role="alert">
                    '.$message.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $alert;
    }
    public function voidFields(){
        $alert = '<div class="alert alert-danger alert-dismissable" role="alert">
                    '.Yii::t('app','Please fill all the fields').'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $alert;
    }
    public function notMatch(){
        $alert = '<div class="alert alert-danger alert-dismissable" role="alert">
                    '.Yii::t('app','The password doesn\'t match').'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $alert;
    }
    public function successfulAlert($message){
        $alert = '<div class="alert alert-success alert-dismissable" role="alert">
                    '.$message.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $alert;
    }
    public function updateAlert(){
        $alert = '<div class="alert alert-success alert-dismissable" role="alert">
                    '.Yii::t('app','Update Successful').'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        return $alert;
    }
}
?>