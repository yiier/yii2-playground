<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$module = Yii::$app->controller->module;

if (method_exists($module, 'getSidebar')):?>

    <?php $this->beginContent(__DIR__ . '/_column2.php' ,[
        'actions'=>$module->getSidebar() ,
    ]); ?>

<?php else: ?>

    <?php $this->beginContent(__DIR__ . '/_base.php'); ?>

<?php endif ?>

<?= $content ?>
<?= \yiier\web\AutoloadExample::widget(); ?>`

<?php $this->endContent(); ?>
