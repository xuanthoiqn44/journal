<div class="sidebar-wrapper">
    <ul class="nav">
        <li class=" <?php if ($active == 'index'){echo 'active';}?> ">
            <a class="nav-link" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['admin/']); ?>">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="<?php if ($active == 'admin-profile'){echo 'active';}?>">
            <a class="nav-link" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['admin/admin-profile']); ?>">
                <i class="material-icons">person</i>
                <p>Admin Profile</p>
            </a>
        </li>
        <li class="<?php if ($active == 'ManageContent'){echo 'active';}?> ">
            <a class="nav-link" href="#">
                <i class="material-icons">library_books</i>
                <p>Manage Content</p>
            </a>
        </li>
        <li class="<?php if ($active == 'manage-user'){echo 'active';}?>">
            <a class="nav-link" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('admin/manage-user'); ?>">
                <i class="material-icons">person</i>
                <p>Manage User</p>
            </a>
        </li>
        <li class=" <?php if ($active == 'editor'){echo 'active';}?>">
            <a class="nav-link" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('admin/editor'); ?>">
                <i class="material-icons">content_paste</i>
                <?php $new = \app\models\Editor::find()->where(['Status_Active'=>'0']);
                ?>
                <?php if ($new->count() > 0) {?>
                <span class="notification-menu"><?= $new->count();?></span>
                <?php }?>
                <p>Editor</p>
            </a>
        </li>
        <li class=" <?php if ($active == 'all-post'){echo 'active';}?>">
            <a class="nav-link" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('admin/all-post'); ?>">
                <i class="material-icons">bubble_chart</i>
                <?php $new = \app\models\Post::find()->where(['Status'=>'New']);
                ?>
                <?php if ($new->count() > 0) {?>
                    <span class="notification-menu"><?= $new->count();?></span>
                <?php }?>
                <p>Manage Posts</p>
            </a>
        </li>
        <li class=" <?php if ($active == 'completed-post'){echo 'active';}?>">
            <a class="nav-link" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('admin/completed-post'); ?>">
                <i class="material-icons">bubble_chart</i>
                <?php $new = \app\models\Post::find()->where(['Status'=>'Completed','Status_Salary_Editor'=>'No']);
                ?>
                <?php if ($new->count() > 0) {?>
                    <span class="notification-menu"><?= $new->count();?></span>
                <?php }?>
                <p>Completed Posts</p>
            </a>
        </li>
        <li class=" <?php if ($active == 'statistic-salary-post'){echo 'active';}?>">
            <a class="nav-link" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('admin/statistic-salary-post'); ?>">
                <i class="material-icons">bubble_chart</i>
                <p>Statistic Salary Posts</p>
            </a>
        </li>
        <li class=" <?php if ($active == 'feedback'){echo 'active';}?>">
            <a class="nav-link" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl('admin/feedback'); ?>">
                <i class="material-icons">bubble_chart</i>
                <p>Feedback</p>
            </a>
        </li>
        <li class=" <?php if ($active == 'EditorSalary'){echo 'active';}?>">
            <a class="nav-link" href="#">
                <i class="material-icons">bubble_chart</i>
                <p>Editor salary</p>
            </a>
        </li>
        <li class=" active-pro ">
            <a class="nav-link" href="#">
                <i class="material-icons">unarchive</i>
                <p>Upgrade to PRO</p>
            </a>
        </li>
    </ul>
</div>