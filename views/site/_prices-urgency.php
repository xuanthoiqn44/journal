<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$check = true;
foreach ($list_urgency as $urgency) {?>
    <!-- Group of default radios - option 1 -->
    <div class="_custom-radio <?= $check?"active":"";?>">
        <div class="_rd">
            <input type="radio" class="custom-control-input" value=<?= $urgency->Id?> name="groupOfDefaultRadios" <?= $check?"checked":"";$check = false;?>>
        </div>
        <div class="_price-day"><?= $urgency->Name_Service_Price?> days</div>
        <div class="_price-pages">
            <span class="_prs">$<?= $urgency->Price_USA?></span><span>/page</span>
        </div>
        <div class="_price-date "><?php
            $date = new DateTime();
            $date->modify('+'.$urgency->Name_Service_Price.'day');
            if ($urgency->Name_Service_Price < 7){
                echo $date->format('l').' at '.$date->format('H:m A');
            }
            else{
                echo  $date->format('d/m/Y');
            }
            ?></div>
    </div>
<?php }?>