<?php
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$u = ActiveForm::begin();
     if ($user) {
        if ($update_user_result) {
            if ($update_user_result['result']) { ?>
                <p><h2 style="color: green;">Данные пользователя успешно обновлены.</h2></p>
            <?php } else
            { ?>
                <p><h2 style="color: red;">Error. Данные пользователя не обновлены.</h2></p>
            <?php
                foreach ($update_user_result['errors'] as $field => $err_descr) {
                    ?><p><b style="color: red;"><?php echo $field; ?></b>: <?php echo $err_descr[0]; ?></p>
                <?php }
            }
        }
        ?>
        <h2>Пользователь <b>ID: <?=$id?></b></h2>
    <table>
        <tr>
            <th>&nbsp;Логин&nbsp;</th><th>&nbsp;Пароль&nbsp;</th><th>&nbsp;Имя&nbsp;</th><th>&nbsp;Фамилия&nbsp;</th>
            <th>&nbsp;Пол&nbsp;</th><th>&nbsp;Дата создания&nbsp;</th><th>&nbsp;Email&nbsp;</th>
        </tr>
        <tr>
            <td>&nbsp;<?=$u->field($editUser, 'login')->
                textInput(['value'=>($update_user_result) ? $edit_user->login : $user->login])->label(false)?></td>
            <td>&nbsp;<?=$u->field($editUser, 'password')->
                textInput(['value'=>($update_user_result) ? $edit_user->password : $user->password])->label(false)?></td>
            <td>&nbsp;<?=$u->field($editUser, 'first_name')->
                textInput(['value'=>($update_user_result) ? $edit_user->first_name : $user->first_name])->label(false)?></td>
            <td>&nbsp;<?=$u->field($editUser, 'last_name')->
                textInput(['value'=>($update_user_result) ? $edit_user->last_name : $user->last_name])->label(false)?></td>
            <td>&nbsp;<?=$u->field($editUser, 'sex')->radioList(['Male'=>'Male', 'Female'=>'Female','NI'=>'NI'],
                    ['value'=>($update_user_result) ? $edit_user->sex : $user->sex])->label(false)?></td>
            <td>&nbsp;<?=date("d-m-Y H:i",strtotime($user->date_created))?></td>
            <td>&nbsp;<?=$u->field($editUser, 'email')->
                textInput(['value'=>($update_user_result) ? $edit_user->email : $user->email])->label(false)?></td>
        </tr>
    </table>
        <div style="float:left;"><?= Html::submitButton('<img src="img/save2.jpg" title="Сохранить">', ['style'=>'padding:0px;']); ?>
         <?php ActiveForm::end(); ?></div>
         <div><button onclick="confirmDeleteUser(<?=$id?>,
                 '<?=Yii::$app->urlManager->createUrl(['site/actions'])?>')">
             <img src="img/vereyka.jpg" title="Удалить" /></button></div>


    <?php

         $count_addresses_on_page = count($addresses);
        if ($update_address_result) {
            if ($update_address_result['updated']) { ?>
            <p><h2 style="color: green;">Адресов пользователя успешно обновлено: <?=$update_address_result['updated']?></h2></p>
        <?php }
            if ($update_address_result['notupdated']){ ?>
                <p><h2 style="color: red;">Error. Адресов пользователя не обновлено: <?=$update_address_result['notupdated']?></h2></p>
            <?php
                for ($i=0; $i<$count_addresses_on_page; $i++) {
                    foreach ($update_address_result['errors'][$i] as $field => $err_descr) {
                        ?><p><b style="color: red;"><?php echo $field.' ['.$i; ?></b>]: <?php echo $err_descr[0]; ?></p>
                    <?php }
                }
            }} ?>


        <h2>Адреса пользователя <b><?=$user->login?></b>:</h2>
         <table>
             <tr><td class="addr-control">
                 <?php
                 $a = ActiveForm::begin(); ?>
         <table class="address">
             <tr>
                 <th>&nbsp;Почтовый индекс&nbsp;</th><th>&nbsp;Страна&nbsp;</th><th>&nbsp;Название города&nbsp;</th>
                 <th>&nbsp;Название улицы&nbsp;</th><th>&nbsp;Номер дома&nbsp;</th><th>&nbsp;Номер офиса/квартиры&nbsp;</th><th></th>
             </tr>
             <?php $i=0; foreach ($addresses as $address) {
                 ?> <tr>
                     <td>&nbsp;<?=$a->field($editAddress, "[$i]post_index")->
                         textInput(['value'=>($update_address_result)?$edit_address[$i]['post_index']:$address->post_index])
                             ->label(false)?></td>
                     <td>&nbsp;<?=$a->field($editAddress, "[$i]country")->dropDownList($countries, ['options' =>
                             [($update_address_result)?$edit_address[$i]['country']:$address->country => ['Selected' => true]]])
                             ->label(false)?></td>
                     <td>&nbsp;<?=$a->field($editAddress, "[$i]city")->textInput(['value'=>
                             ($update_address_result)?$edit_address[$i]['city']:$address->city])->label(false)?></td>
                     <td>&nbsp;<?=$a->field($editAddress, "[$i]street")->textInput(['value'=>
                             ($update_address_result)?$edit_address[$i]['street']:$address->street])->label(false)?></td>
                     <td>&nbsp;<?=$a->field($editAddress, "[$i]house_number")->textInput(['value'=>
                             ($update_address_result)?$edit_address[$i]['house_number']:$address->house_number])->label(false)?></td>
                     <td>&nbsp;<?=$a->field($editAddress, "[$i]apartmant_office")->textInput(['value'=>
                             ($update_address_result)?$edit_address[$i]['apartmant_office']:$address->apartmant_office])->label(false)?></td>
                     <td><?=$a->field($editAddress, "[$i]id")->
                         hiddenInput(['value'=>$address->id])->label('')?></td>
                 </tr>
                 <?php $i++; } ?>
             <tr><td colspan="6">
                     <?= Html::submitButton('<img src="img/save2.jpg" title="Сохранить">', ['style'=>'padding:0px;']); ?>
                 </td></tr>
         </table>
         <?php ActiveForm::end(); ?>
         <?= LinkPager::widget(['pagination' => $pagination]) ?>
                 </td>

             <td class="addr-control">
                 <table class="address">
                     <tr><th>Удалить</th></tr>
                     <?php
                             for ($j=0; $j<$count_addresses_on_page; $j++) { ?>
                                 <tr><td><?php if ($total_addresses_count>1) { ?>
                                     <button onclick="confirmDeleteAddress(<?=$addresses[$j]->id?>,
                                             '<?=Yii::$app->urlManager->createUrl(['site/actions'])?>')">
                                 <img src="img/vereyka.jpg" title="Удалить" /></button>
                                 <?php } else { ?>
                                         <button onclick="delLastAddress()">
                                             <img src="img/vereyka.jpg" title="Удалить" /></button>
                                     <?php } ?></td></tr><?php
                             }
                     ?>
                 </table>
             </td>
         </table>



        <?php
         $post_index_val = $city_val = $street_val = $house_val = $apart_office_val = "";
         $country_val='UA';
        if ($same_address) { ?>
            <p><h2 style="color: red;">Error. Адрес не добавлен: </h2></p><p><b style="color: red;">У данного пользователя уже есть такой адрес.</b></p>
        <?php }
        if ($new_address) {
            if ($naid=$new_address['address_id']) { ?>
                <p><h2 style="color: green;"> Success. Пользователю добавлен новый адрес.</h2></p>
            <?php }
            else { ?>
                <p><h2 style="color: red;"> Error. Адрес не добавлен:</h2></p>
                <?php foreach ($new_address['errors'] as $field => $err_descr) {
                    ?><p><b style="color: red;"><?php echo $field; ?></b>: <?php echo $err_descr[0]; ?></p>
                <?php }
            }}

        $f = ActiveForm::begin();
        ?>
        <h2>Добавить еще один адрес пользователю: </h2>
        <table>
            <tr><td><?=$f->field($addUser, "post_index")->textInput(['value'=>($naid)?"":$new_address_data['post_index']])?></td>
                <td><?=$f->field($addUser, "country")->dropDownList($countries,
                        ['options' => [($naid||!$new_address)?"UA":$new_address_data['country'] => ['Selected' => true]]])?></td>
                <td><?=$f->field($addUser, "city")->textInput(['value'=>($naid)?"":$new_address_data['city']])?></td>
                <td>&nbsp;</td><td><?=$f->field($addUser, "street")->textInput(['value'=>($naid)?"":$new_address_data['street']])?></td>
                <td>&nbsp;</td><td><?=$f->field($addUser, "house_number")->textInput(['value'=>($naid)?"":$new_address_data['house_number']])?></td>
                <td><?=$f->field($addUser, "apartmant_office")->textInput(['value'=>($naid)?"":$new_address_data['apartmant_office']])?></td></tr>
        </table>
         <?= Html::submitButton('<img src="img/save2.jpg" title="Сохранить">', ['style'=>'padding:0px;']); ?>
        <?=$f->field($addUser, 'login')->hiddenInput(['value'=>'Abcd'])->label(false)?>
        <?=$f->field($addUser, 'password')->hiddenInput(['value'=>'Test666'])->label(false)?>
        <?=$f->field($addUser, 'first_name')->hiddenInput(['value'=>'Test'])->label(false)?>
        <?=$f->field($addUser, 'last_name')->hiddenInput(['value'=>'Test'])->label(false)?>
        <?=$f->field($addUser, 'sex')->hiddenInput(['value'=>'NI'])->label(false)?>
        <?=$f->field($addUser, 'email')->hiddenInput(['value'=>'test@abcd.com'])->label(false)?>

        <?php ActiveForm::end(); ?>

    <?php } else { ?>
    <p>Пользователь не найден.</p>
    <?php }
    //var_dump($addresses);
    /*var_dump($edit_user); echo '<br/>'; var_dump($update_user_result); echo '<br/>'; var_dump($user);*/
    //var_dump(empty($edit_address)); echo "; "; var_dump($edit_address); echo '<br/>';
    //var_dump($update_address_result); echo '<br/>';
    //var_dump($is_address_change); echo '<br/>';
//var_dump($new_address_data); echo '<br/>';
//var_dump($new_address); echo '<br/>';
//var_dump($same_address); echo '<br/>';
?>
