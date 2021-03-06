<?php
namespace frontend\models;

use DateTime;
use Yii;
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


    /**
     * @inheritdoc
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
        date_default_timezone_set('EUROPE/BRATISLAVA');

        $user = new User();
        $user->USERNAME  = $this->username;
        $user->EMAIL     = $this->email;
        $user->ROLE_NAME = 'super-admin';
//        $user->CREATED_AT = date('Y-m-d H:i:s', time());
//        $user->UPDATED_AT = date('Y-m-d H:i:s', time());
        $user->setPassword($this->password);
        $user->generateAuthKey();
//        $user->PASSWORD_RESET_TOKEN = Yii::$app->security->generateRandomString() . '_' . time();
        return $user->save() ? $user : null;
    }
}
