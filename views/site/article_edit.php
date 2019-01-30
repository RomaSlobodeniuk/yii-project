<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $f->field($form, 'title')->input('text', ['value' => $article->title]); ?>
<?= $f->field($form, 'short_description')->input('text', ['value' => $article->short_description]); ?>
<?= $f->field($form, 'description')->input('text', ['value' => $article->description]); ?>
<?= $f->field($form, 'date')->input('text', ['value' => $article->date]); ?>
<?= $f->field($form, 'author')->input('text', ['value' => $article->author]); ?>
<?= $f->field($form, 'image')->fileInput()->input('file', ['value' => $article->image]); ?>
<?= Html::submitButton('Save'); ?>
<?php ActiveForm::end(); ?>
