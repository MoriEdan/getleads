<div class="container gad">
    <?php echo SiteVariable::get('GAD_728x15') ?>
</div>

<div class="container gad">
    <?php echo SiteVariable::get('GAD_728x90') ?>
</div>

<div>
    <?php if ($qrs): ?>
        <?php $i = 1; ?>
        <?php foreach ($qrs as $qr): ?>
            <?php
            if ($i == 1) {
                echo '<div class="shelve">
                    <div class="shelve-content">';
            }
            ?>
            <a href="javascript:;" class="shelve-frame">
                <img src="<?php echo $qr->image_url ?>?<?php echo rand() ?>" />
            </a>
            <?php
            if ($i == 3) {
                echo '  </div>
                  </div>';
                $i = 0;
            }
            $i++
            ?>
        <?php endforeach ?>
        <?php
        if ($i != 1) {
            echo '      </div>
                </div>';
        }
    endif;
    ?>
</div>

<div class="container gad">
    <?php echo SiteVariable::get('GAD_728x90') ?>
</div>

<div class="container gad">
    <?php echo SiteVariable::get('GAD_728x15') ?>
</div>


<div style="text-align: center;margin-bottom: 30px;">
<?php
$this->widget('CLinkPager', array(
    'pages' => $pages,
    'header' => '',
))
?>
</div>