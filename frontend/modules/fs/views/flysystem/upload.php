<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model yii\base\DynamicModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-photo-form">

    <?php $form = ActiveForm::begin(
        [
            // 下面的这个配置对
            'options' => ['enctype' => 'multipart/form-data'] // important for upload file
        ]
    ); ?>

    <?= $form->field($model, 'image')->fileInput(['maxlength' => 255]) ?>

    <?php
    /**
     * uncomment for multiple file upload
     *
     * echo $form->field($model, 'image[]')->widget(FileInput::classname(), [
     * 'options'=>['accept'=>'image/*', 'multiple'=>true],
     * ]);
     *
     */
    ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
