<?php
/**
 * Created by PhpStorm.
 * User: Oleg
 * Date: 15.01.2020
 * Time: 1:50
 */

namespace app\models;
use Yii;
use yii\base\Model;

class EditAddress extends Model
{
    public $post_index;
    public $country;
    public $city;
    public $street;
    public $house_number;
    public $apartmant_office;

    public function rules() {
        return [
            [['post_index', 'country', 'city', 'street', 'house_number'], 'required'],
            ['post_index', 'match', 'pattern'=>'/^\d+$/',
                'message'=>'Почтовый индекс у нас может содержать только цифры'],
            ['house_number', 'match', 'pattern'=>'/^\d+$|^\d+[А-ЯЁЇІа-яёїі]$|^\d+-[А-ЯЁЇІа-яёїі]$|^\d+[A-Za-z]$|^\d+-[A-Za-z]$/u',
                'message'=>'Неверный формат номера дома'],
            ['apartmant_office', 'match', 'pattern'=>'/^\d+$|^\d+[А-ЯЁЇІа-яёїі]$|^\d+-[А-ЯЁЇІа-яёїі]$|^\d+[A-Za-z]$|^\d+-[A-Za-z]$/u',
                'message'=>'Неверный формат номера офиса/квартиры'],
        ];
    }
}