<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $colaborator_no;
    public $hoteles_hotel_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['first_name','required'],
            ['first_name', 'string', 'max' => 50],

            ['last_name','required'],
            ['last_name', 'string', 'max' => 50],

            ['colaborator_no', 'required'],
            ['colaborator_no', 'integer', 'max' => 20],
            ['colaborator_no', 'unique', 'targetClass' => '\common\models\User','message' => 'This colaborator number has already been taken.'],

            ['hoteles_hotel_id', 'required'],
            ['hoteles_hotel_id', 'integer']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        //attributes who we created
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->colaborator_no = $this->colaborator_no;
        $user->hoteles_hotel_id = $this->hoteles_hotel_id;

        return $user->save() ? $user : null;
    }
}
