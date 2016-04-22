<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


?>
<?php $this->beginContent(__DIR__ . '/_base.php'); ?>
<div class="row">

    <div class="col-md-9 col-sm-8">
        <?= $content ?>
    </div>

    <div class="col-md-3 col-sm-4">
        <p>
            可用的菜单
        </p>
        <div class="list-group">
            <?php
            foreach ($actions as $id => $actionConf) {
                $label = '<i class="glyphicon glyphicon-chevron-right"></i>' . Html::encode($actionConf['label']);
                echo Html::a($label, $actionConf['url'], [
                    // 'class' => $generator === $activeGenerator ? 'list-group-item active' : 'list-group-item',
                ]);
            }
            ?>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>
