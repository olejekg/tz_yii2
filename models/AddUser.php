<?php
namespace app\models;
use Yii;
use yii\base\Model;

class AddUser extends Model
{
    public $login;
    public $password;
    public $first_name;
    public $last_name;
    public $sex;
    public $email;
    public $post_index;
    public $country;
    public $city;
    public $street;
    public $house_number;
    public $apartmant_office;

    public function rules() {
        return [
            [['first_name', 'email', 'login', 'password', 'last_name', 'sex',
                'post_index', 'country', 'city', 'street', 'house_number'], 'required'],
            ['email', 'email'],
            ['login', 'string', 'length'=>[4], 'message'=>'Логин должен содержать не менее 4-х символов!!'],
            ['password', 'string', 'length'=>[6], 'message'=>'Пароль должен содержать не менее 6 символов!!'],
            ['first_name', 'match', 'pattern'=>'/^([А-ЯЇІЁ]{1}[а-яёїі]{1,23}|[A-Z]{1}[a-z]{1,23})$/u',
                'message'=>'Имя должно начинаться с большой буквы и содержать только буквы укр/рус/англ алфавита'],
            ['last_name', 'match', 'pattern'=>'/^([А-ЯЇІЁ]{1}[а-яёїі]{1,23}|[A-Z]{1}[a-z]{1,23})$/u',
                'message'=>'Фамилия должна начинаться с большой буквы и содержать только буквы укр/рус/англ алфавита'],
            ['post_index', 'match', 'pattern'=>'/^\d+$/',
                'message'=>'Почтовый индекс у нас может содержать только цифры'],
            ['house_number', 'match', 'pattern'=>'/^\d+$|^\d+[А-ЯЁЇІа-яёїі]$|^\d+-[А-ЯЁЇІа-яёїі]$|^\d+[A-Za-z]$|^\d+-[A-Za-z]$/u',
                'message'=>'Неверный формат номера дома'],
            ['apartmant_office', 'match', 'pattern'=>'/^\d+$|^\d+[А-ЯЁЇІа-яёїі]$|^\d+-[А-ЯЁЇІа-яёїі]$|^\d+[A-Za-z]$|^\d+-[A-Za-z]$/u',
                'message'=>'Неверный формат номера офиса/квартиры'],

        ];
    }
}
?>