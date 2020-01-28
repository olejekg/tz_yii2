<?php
/**
 * Created by PhpStorm.
 * User: Oleg
 * Date: 09.01.2020
 * Time: 11:47
 */

namespace app\models;
use yii\db\ActiveRecord;

class Addresses extends ActiveRecord
{
    public function rules()
    {
        //return parent::rules(); // TODO: Change the autogenerated stub
        return array_merge([
            [['post_index', 'country', 'city', 'street', 'house_number', 'apartmant_office', 'users_id'], 'safe'],
            //['post_index', 'string', 'length'=>[4,6]],
        ], parent::rules()); //'targetClass' => self::className(),
    }
}

?>