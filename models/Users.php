<?php
/**
 * Created by PhpStorm.
 * User: Oleg
 * Date: 08.01.2020
 * Time: 18:57
 */

namespace app\models;


use yii\db\ActiveRecord;

class Users extends ActiveRecord
{
    public function rules()
    {
        return array_merge([
            [['login', 'password', 'first_name', 'last_name', 'sex', 'email'], 'safe'],
            ['email', 'email'],
            ['email','unique','message'=>'Пользователь с таким email адресом уже зарегистрирован.'],
            ['login','unique','message'=>'Пользователь с таким логином уже зарегистрирован.'],
        ], parent::rules()); //'targetClass' => self::className(),
    }
}

?>