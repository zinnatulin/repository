<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options'=>['enctype' => 'multipart/form-data']])?>

<?= $form->field($model, 'name'); ?>

<?= $form->field($model, 'email'); ?>

<?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true]) ?>

<div class="form-group">
	<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']); ?>
</div>
<?php ActiveForm::end(); ?>
