<?php $this->pageTitle = CHtml::encode(Yii::app()->name); ?>
<?php $this->header_id = 'header-bg'; ?>
<?php
Yii::app()->clientScript
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/rhinoslider-1.05/js/mousewheel.js', CClientScript::POS_HEAD)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/rhinoslider-1.05/js/rhinoslider-1.05.min.js', CClientScript::POS_HEAD)
        ->registerCssFile(Yii::app()->theme->baseUrl . '/assets/js/rhinoslider-1.05/css/rhinoslider-1.05.css', CClientScript::POS_HEAD)
;
?>
<div id="mid-frame-wrap">
    <div id="mid-frame-inner-wrap">
        <div id="header-frame">
            <ul class="slideshow" id="slideshow">
                <li><img width="214" height="214" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/qr/1.png" /></li>
                <li><img width="214" height="214" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/qr/2.png" /></li>
                <li><img width="214" height="214" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/qr/3.png" /></li>
                <li><img width="214" height="214" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/qr/4.png" /></li>
                <li><img width="214" height="214" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/qr/5.png" /></li>
                <li><img width="214" height="214" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/qr/6.png" /></li>
                <li><img width="214" height="214" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/qr/7.png" /></li>
                <li><img width="214" height="214" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/qr/8.png" /></li>
            </ul>
        </div>
    </div>
</div>

<div id="wall-menu">
<?php
$static_pages = array(array('label' => Yii::t('dict', 'Home'), 'url' => array('/site/index')));
$static_pages[] = array('label' => Yii::t('dict', 'My Codes'), 'url' => array('/qr/list'), 'visible' => !Yii::app()->user->isGuest);
$static_pages[] = array('label' => Yii::t('dict', 'QR Generator'), 'url' => array('/qr/choose'), );
$static_pages[] = array('label' => Yii::t('dict', 'Gallery'), 'url' => array('/qr/gallery'),);
$static_pages[] = array('label' => Yii::t('dict', 'Contact'), 'url' => array('/site/contact'));

$this->widget('zii.widgets.CMenu', array(
    'items' => $static_pages,
    'htmlOptions' => array(
        'class' => 'nav',
    ),
));
?>
</div>

<div class="container gad" style="margin-top: 120px">
    <?php echo SiteVariable::get('GAD_728x90') ?>
</div>
    
<div class="container">
    <div class="banner">
        <div id="whats-so-unique">
            <h1>QR Code Generator</h1>
            <p>Whats so unique about it? Well, you can customize every aspect of a QR code from shapes to colors. Now, no more boring black and white square shaped QR codes. No need to hire a designer and wait for weeks or even months to tweek your QR code and get the job done right, let the designer be yourself and design your QR code on the fly choosing among 15000 style combinations and unlimited colors.</p>
        </div>
        <div id="before-after"></div>
    </div>
    <div class="container gad">
        <?php echo SiteVariable::get('GAD_728x90') ?>
    </div>
    
    <div id="features">
        <ul>
            <li style="list-style: none;"><h1>Advanced Features</h1></li>
            <li>No external API</li>
            <li>Re-Editable QR types</li>
            <li>25 QR code corner shapes</li>
            <li>20 QR code corner dot shapes</li>
            <li>30 QR code body styles</li>
            <li>Changeable QR code corner color</li>
            <li>Changeable QR code corner dot color</li>
            <li>Changeable QR code body color</li>
            <li>Changeable QR code background color</li>
            <li>Built-in QR scannability indicator.</li>
            <li>Built-in URL shortener.</li>
            <li>Optional bitly support.</li>
            <li>High resolution QR code images.</li>
        </ul>
        <ul>
            <li style="list-style: none;"><h1>Types Supported</h1></li>
            <li>Text</li>
            <li>URL</li>
            <li>Facebook Profile</li>
            <li>Facebook Like</li>
            <li>Twitter Profile</li>
            <li>Twitter Status</li>
            <li>Linkedin Profile</li>
            <li>Linkedin Share</li>
            <li>Telephone</li>
            <li>SMS</li>
            <li>Email</li>
            <li>Email Message</li>
            <li>vCard</li>
            <li>meCard</li>
        </ul>
        <ul>
            <li style="list-style: none;"><h1>And Lot More</h1></li>
            <li>Customize QR Code anytime</li>
            <li>Edit QR Code type anytime</li>
            <li>See stats of each QR code</li>
            <li>Post QR code to the public gallery</li>
            <li>Easily customizable theme</li>
            <li>Clean code following best practices</li>
            <li>...</li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div> <!-- /container -->


<?php if ($gallery): ?>
    <div class="shelve" style="margin:20px auto 0 auto;">
        <div class="shelve-content">
            <?php foreach ($gallery as $item): ?>
                <a href="javascript:;" class="shelve-frame">
                    <img src="<?php echo $item->image_url ?>" />
                </a>
            <?php endforeach ?>
        </div>
    </div>
<?php endif ?>

<script>
    $('#slideshow').rhinoslider({
        effect: 'kick',
        controlsPrevNext: false,
        controlsPlayPause: false,
        autoPlay: true,
        showBullets: 'never',
        showControls: 'never',
        controlsMousewheel: false
    });
</script>

<div class="container gad">
    <?php echo SiteVariable::get('GAD_728x15') ?>
</div>

<div class="container gad">
    <?php echo SiteVariable::get('GAD_728x90') ?>
</div>

