<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$module = Yii::$app->controller->module;

if (method_exists($module, 'getSidebar')):?>

    <?php $this->beginContent(__DIR__ . '/_column2.php', [
        'actions' => $module->getSidebar(),
    ]); ?>

<?php else: ?>
    <?php if (method_exists($module, 'detectActions')): ?>
         <?php  $actions = $module->detectActions(); ?>
         <?php  \yii\helpers\VarDumper::dump($actions); ?>
        <?php $this->beginContent(__DIR__ . '/_column2.php', [
            'actions' => $actions,
        ]); ?>
    <?php else: ?>

        <?php $this->beginContent(__DIR__ . '/_base.php'); ?>

    <?php endif ?>
<?php endif ?>

<?= $content ?>

<?php $this->endContent(); ?>
