<?php

namespace app\models\form;

use yii\base\Model;
use app\models\User;

class SignUpForm extends Model
{
    public $username;
    public $password;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'string', 'min' => 5],
            ['verifyCode', 'captcha', 'captchaAction' => 'sign-up/captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code'
        ];
    }

    /**
     * @return User|null
     */
    public function signUp() {

        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->setUsername($this->username);
        $user->setPassword($this->password);

        return $user->save() ? $user : null;
    }
}
