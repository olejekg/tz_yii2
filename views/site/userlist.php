<?php
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<h1>Список пользователей</h1>
<table>
    <tr>
        <th>&nbsp;Логин&nbsp;</th><th>&nbsp;Пароль&nbsp;</th><th>&nbsp;Имя&nbsp;</th><th>&nbsp;Фамилия&nbsp;</th>
        <th>&nbsp;Пол&nbsp;</th><th>&nbsp;Дата создания&nbsp;</th><th>&nbsp;Email&nbsp;</th>
        <th>&nbsp; </th><th>&nbsp; </th><th>&nbsp; </th>
    </tr>
<?php foreach ($users as $usr) {
    $user_url = Yii::$app->urlManager->createUrl(['site/user','id'=>$usr->id]);
    ?>
    <tr>
        <td>&nbsp;<a href="<?= $user_url ?>"><?=$usr->login?>&nbsp;</td>
        <td>&nbsp;<?=$usr->password?>&nbsp;</td><td>&nbsp;<?=$usr->first_name?>&nbsp;</td>
        <td>&nbsp;<?=$usr->last_name?>&nbsp;</td><td>&nbsp;<?=$usr->sex?>&nbsp;</td>
        <td>&nbsp;<?=date("d-m-Y H:i",strtotime($usr->date_created))?>&nbsp;</td><td>&nbsp;<?=$usr->email?></a>&nbsp;</td>
		<td><a href="<?=$user_url?>"><img src="img/edit1.jpg" title="Редактировать пользователя и адреса" /></a></td>
        <td><button onclick="confirmDeleteUser(<?=$usr->id?>,
                    '<?=Yii::$app->urlManager->createUrl(['site/actions'])?>')">
                <img src="img/vereyka.jpg" title="Удалить" /></button></td>
    </tr>
<?php } ?>
</table>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
<p><a href="<?=Yii::$app->urlManager->createUrl(['site/useradd'])?>"><img src="img/plus.png" />
        Добавить нового пользователя</a></p>
<?php
//var_dump($action_params);
?>


