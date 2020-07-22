<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
    <h1>User</h1>
    <ul>
        <?php foreach ($countries as $country): ?>
            <li>
                <?= Html::encode("{$country->FirstName} ({$country->LastName})") ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>