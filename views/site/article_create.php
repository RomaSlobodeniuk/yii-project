<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $f->field($form, 'title')->input('text'); ?>
<?= $f->field($form, 'short_description')->input('text'); ?>
<?= $f->field($form, 'description')->input('text'); ?>
<?= $f->field($form, 'date')->input('text'); ?>
<?= $f->field($form, 'author')->input('text'); ?>
<?= $f->field($form, 'image')->fileInput()->input('file'); ?>
<?= Html::submitButton('Save'); ?>
<?php ActiveForm::end(); ?>
