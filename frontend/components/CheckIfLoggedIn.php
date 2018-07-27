<?php
namespace frontend\components;
class CheckIfLoggedIn extends \yii\base\Behavior{
    public function events()
    {
        return [
            \yii\web\Application::EVENT_BEFORE_REQUEST => 'changeLanguage',
        ];
    }
    /**
     * this function is used when the user change the application language,
     * sets a cookie, when the user wants to log on, checks the cookie and
     * sets the last used language
     */
    public function changeLanguage(){
        if (\Yii::$app->getRequest()->getCookies()->has('lang')){
            \Yii::$app->language = \Yii::$app->getRequest()->getCookies()->getValue('lang');
        }
    }
}