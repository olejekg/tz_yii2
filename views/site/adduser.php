<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$f = ActiveForm::begin();
if ($create_user_errors) {
    //var_dump($create_user_errors);
    ?><p><h2 style="color: red;">Error. Пользователь не добавлен в базу.</h2></p><?php
    foreach ($create_user_errors as $field => $err_descr) {
        ?><p><b style="color: red;"><?php echo $field; ?></b>: <?php echo $err_descr[0]; ?></p>
    <?php }
} else { if ($users_id) {
    ?><p><h2 style="color: green;">Новый пользователь добавлен в базу.
    <a href="<?=Yii::$app->urlManager->createUrl(['site/user','id'=>$users_id])?>">ID: <?=$users_id?>; Логин: <?=$login?></a>
</h2></p><?php
if ($new_address['errors']) {
    ?><p><h2 style="color: red;">Error. Адрес пользователя не добавлен в базу.</h2></p><?php
    foreach ($new_address['errors'] as $field => $err_descr) {
        ?><p><b style="color: red;"><?php echo $field; ?></b>: <?php echo $err_descr[0]; ?></p>
    <?php }
} else { if ($new_address['address_id']) {
    ?><p><h2 style="color: green;">Адрес пользователя добавлен в базу.</h2><p><?php
    }
}
}}
$country_select = ($country && !$users_id) ? $country : 'UA';
?>
<table>
    <tr><td><b>Заполните данные нового пользователя:&nbsp;</b></td><td>&nbsp;</td>
        <td>&nbsp;<b>Также добавьте сведения об адресе пользователя:</b></td></tr>
    <tr><td><?=$f->field($addUser, 'login')->textInput(['value'=>($users_id)?'':$login])?></td><td>&nbsp;</td>
        <td><?=$f->field($addUser, 'post_index')->textInput(['value'=>($users_id)?'':$post_index])?></td></tr>
    <tr><td><?=$f->field($addUser, 'password')->textInput(['value'=>($users_id)?'':$password])?></td><td>&nbsp;</td>
        <td><?=$f->field($addUser, 'country')->dropDownList($countries, ['options' => [$country_select => ['Selected' => true]]])?></td></tr>
    <tr><td><?=$f->field($addUser, 'first_name')->textInput(['value'=>($users_id)?'':$first_name])?></td><td>&nbsp;</td>
        <td><?=$f->field($addUser, 'city')->textInput(['value'=>($users_id)?'':$city])?></td></tr>
    <tr><td><?=$f->field($addUser, 'last_name')->textInput(['value'=>($users_id)?'':$last_name])?></td>
        <td>&nbsp;</td><td><?=$f->field($addUser, 'street')->textInput(['value'=>($users_id)?'':$street])?></td></tr>
    <tr><td><?=$f->field($addUser, 'sex')->radioList(['Male'=>'Male', 'Female'=>'Female','NI'=>'NI'],['value'=>'NI'])?></td>
        <td>&nbsp;</td><td><?=$f->field($addUser, 'house_number')->textInput(['value'=>($users_id)?'':$house_number])?></td></tr>
    <tr><td><?=$f->field($addUser, 'email')->textInput(['value'=>($users_id)?'':$email])?></td><td>&nbsp;</td>
        <td><?=$f->field($addUser, 'apartmant_office')->textInput(['value'=>($users_id)?'':$apartmant_office])?></td></tr>
</table>
<?= Html::submitButton('Отправить'); ?>
<?php ActiveForm::end(); ?>
