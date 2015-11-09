<?php $this->pageTitle = CHtml::encode(Yii::app()->name); ?>

<div id="qr-features">
    <img src="<?php echo Yii::app()->theme->baseUrl ?>/assets/images/features.png" />
</div>

<a class="btn btn-green btn-lg" href="<?php echo $this->createUrl('qr/generate') ?>">Create Your Custom QR Code</a>

<?php if($gallery): ?>
    <?php foreach($gallery as $qr): ?>
        <img src="<?php echo $qr->image_url ?>" />
    <?php endforeach ?>
<?php endif ?>