<?php $this->pageTitle = CHtml::encode(Yii::app()->name); ?>
<?php $this->header_id = 'header-bg'; ?>
   
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
    
    <div id="features"><h2>Advanced Features</h2>
        <ul>
            <li style="list-style: none;"></li>
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
        <h2>Types Supported</h2>
        <ul>
            <li style="list-style: none;"></li>
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
        <h2>And Lot More</h2>
        <ul>
            <li style="list-style: none;"></li>
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

