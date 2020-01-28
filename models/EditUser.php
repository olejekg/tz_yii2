<?php
/**
 * Created by PhpStorm.
 * User: Oleg
 * Date: 14.01.2020
 * Time: 17:01
 */

namespace app\models;
use Yii;
use yii\base\Model;

class EditUser extends Model
{
    public $login;
    public $password;
    public $first_name;
    public $last_name;
    public $sex;
    public $email;

    public function rules() {
        return [
            [['first_name', 'email', 'login', 'password', 'last_name', 'sex'], 'required'],
            ['email', 'email'],
            ['login', 'string', 'length'=>[4], 'message'=>'Логин должен содержать не менее 4-х символов!!'],
            ['password', 'string', 'length'=>[6], 'message'=>'Пароль должен содержать не менее 6 символов!!'],
            ['first_name', 'match', 'pattern'=>'/^([А-ЯЇІЁ]{1}[а-яёїі]{1,23}|[A-Z]{1}[a-z]{1,23})$/u',
                'message'=>'Имя должно начинаться с большой буквы и содержать только буквы укр/рус/англ алфавита'],
            ['last_name', 'match', 'pattern'=>'/^([А-ЯЇІЁ]{1}[а-яёїі]{1,23}|[A-Z]{1}[a-z]{1,23})$/u',
                'message'=>'Фамилия должна начинаться с большой буквы и содержать только буквы укр/рус/англ алфавита'],
        ];
    }
}