<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 9/25/2018
 * Time: 12:34 AM
 */
?>
<?php foreach ($countries as $posts): ?>
            <li>
                <?= Html::encode("{$posts->File_Name}") ?>
            </li>
        <?php endforeach; ?>
?>