<div class="sidebar-wrapper">
    <ul class="nav">

        <li class="<?php if ($active == 'profile'){echo 'active';}?>">
            <a class="nav-link" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['manage-editor/profile']); ?>">
                <i class="material-icons">person</i>
                <p>Editor Profile</p>
            </a>
        </li>

        <li class=" <?php if ($active == 'request-post'){echo 'active';}?>">
            <a class="nav-link" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['manage-editor/request-post']); ?>">
                <i class="material-icons">content_paste</i>
                <?php $new = \app\models\Post::find()->where(['Status'=>'Waiting editor','Id_Editor'=>Yii::$app->user->identity->getID_EDITOR()]);
                ?>
                <?php if ($new->count() > 0) {?>
                    <span class="notification-menu"><?= $new->count();?></span>
                <?php }?>
                <p>List Request Post</p>
            </a>
        </li>
        <li class=" <?php if ($active == 'manage-post'){echo 'active';}?>">
            <a class="nav-link" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('manage-editor/manage-post'); ?>">
                <i class="material-icons">bubble_chart</i>
                <p>Manage Post</p>
            </a>
        </li>
    </ul>
</div>