<div class="well" style="text-align:center">
    <h1><?php echo Yii::t('yii', 'Choose QR Type') ?></h1>
    <br />
    <a href="<?php echo $this->createUrl('qr/generate', array('type' => 'custom')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/custom.png" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?php echo $this->createUrl('qr/generate', array('type' => 'transparent')) ?>"><img src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/transparent.png" /></a>
</div>