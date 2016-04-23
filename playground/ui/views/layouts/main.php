<?php $this->beginContent('@frontend/views/layouts/_base.php'); ?>

<?php if (\yiier\web\Layout::hasRegion('sidebar.right')): ?>
    <div class="row">

        <div class="col-md-9 col-sm-8">
            <?= $content ?>
        </div>

        <div class="col-md-3 col-sm-4">

            <!-- sidebar-right -->
            <div id="sidebar-right" class="sidebar">
                <div class="sidebar-content">
                    <?php \yiier\web\Layout::renderRegion('sidebar.right'); ?>
                </div>
            </div>
            <!-- /sidebar-right -->

        </div>
    </div>

    <?php else: ?>

    <?= $content ?>

<?php endif; ?>

<?php $this->endContent(); ?>