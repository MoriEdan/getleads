<?php
$this->pageTitle = Yii::app()->name . ' - Customize';
$this->breadcrumbs = array(
    'Customize',
);

Yii::app()->clientScript
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/grid.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/version.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/detector.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/formatinf.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/errorlevel.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/bitmat.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/datablock.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/bmparser.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/datamask.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/rsdecoder.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/gf256poly.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/gf256.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/decoder.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/qrcode.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/findpat.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/alignpat.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/qr/databr.js', CClientScript::POS_END)
;

$qrImg = Yii::app()->getBaseUrl(true) . "/qrs/$qr->id.png?" . rand();

Yii::app()->clientScript->registerScript('checkqr', <<<JS
   qrcode.callback = function(a) {
        if(a.indexOf("http://") !== 0 && a.indexOf("https://") !== 0) {
            $('#qr-error').show(500);
        }
        else {
            $('#qr-success').show(500);
        }
   };
   qrcode.decode('$qrImg');
JS
        , CClientScript::POS_END);
?>

<div class="container gad">
        <?php echo SiteVariable::get('GAD_728x90') ?>
</div>

<form method="post" id="customizeForm" enctype="multipart/form-data">
    <input type="hidden" id="customize" name="customize" value="shape" />
    <input type="hidden" id="customize-type" name="type" />
    <input type="hidden" id="customize-shape" name="shape" />
    <input type="hidden" id="customize-color" name="color" />
    <div class="row well" style="padding:10px;">
        <div class="span6" id="qr-shapes-col">
            <div>
                <div class="page-header">
                    <h1><?php echo Yii::t('dict', 'Background Color & Logo'); ?>:</h1>
                </div>
                <div>
                    <div data-type="background" data-color-format="hex" data-color="#<?php echo $qr->backgroundColor ?>" class="input-append color colorpicker">
                        <input type="text"  value="#<?php echo $qr->backgroundColor ?>">
                        <span class="add-on"><i style="background-color: #<?php echo $qr->backgroundColor ?>;"></i></span>
                    </div>
                </div>
                <div>
                    <input style="width: auto;" type="file" name="logo" id="embed-logo" />
                    <?php if($qr->logo_image): ?>
                        <a style="margin-left: 5px;" class="btn btn-primary" href="<?php echo $this->createUrl('delete_logos', array('id' => $qr->id)) ?>">Remove Logo</a>
                    <?php endif ?>
                </div>
            </div>
            
            <div>
                <div class="page-header">
                    <h1><?php echo Yii::t('dict', 'Frame Shapes'); ?>:</h1>
                </div>
                <div class="qr-frames qr-shapes clear-wrap">
                    <?php foreach ($shapes['frames'] as $shape): ?>
                        <a href="javascript:;" data-type="frame" data-shape="<?php echo $shape ?>" class="qr-shape <?php echo $qr->frame == $shape ? 'current' : '' ?>"><img src="<?php echo $shape_url . "/$shape.png"; ?>" /></a>
                    <?php endforeach ?>
                </div>
                <div>
                    <div data-type="frame" data-color-format="hex" data-color="#<?php echo $qr->frameColor ?>" class="input-append color colorpicker">
                        <input type="text"  value="#<?php echo $qr->frameColor ?>">
                        <span class="add-on"><i style="background-color: #<?php echo $qr->frameColor ?>;"></i></span>
                    </div>
                </div>
            </div>

            <div>
                <div class="page-header">
                    <h1><?php echo Yii::t('dict', 'Frame Marker'); ?>:</h1>
                </div>

                <div class="qr-frame-dots qr-shapes clear-wrap">
                    <?php foreach ($shapes['frame_dots'] as $shape): ?>
                        <a href="javascript:;" data-type="frame_dot" data-shape="<?php echo $shape ?>" class="qr-shape <?php echo $qr->frame_dot == $shape ? 'current' : '' ?>"><img src="<?php echo $shape_url . "/$shape.png"; ?>" /></a>
                    <?php endforeach ?>
                </div>
                <div>
                    <div data-type="frame_dot" data-color-format="hex" data-color="#<?php echo $qr->frame_dotColor ?>" class="input-append color colorpicker">
                        <input type="text"  value="#<?php echo $qr->frame_dotColor ?>">
                        <span class="add-on"><i style="background-color: #<?php echo $qr->frame_dotColor ?>;"></i></span>
                    </div>
                </div>
            </div>

            <div>
                <div class="page-header">
                    <h1><?php echo Yii::t('dict', 'Body Dots'); ?>:</h1>
                </div>
                <div class="qr-dots qr-shapes clear-wrap">
                    <?php foreach ($shapes['dots'] as $shape): ?>
                        <a href="javascript:;" data-type="dot" data-shape="<?php echo $shape ?>" class="qr-shape <?php echo $qr->dot == $shape ? 'current' : '' ?>"><img src="<?php echo $shape_url . "/$shape.png"; ?>" /></a>
                    <?php endforeach ?>
                </div>

                <div>
                    <div data-type="dot" data-color-format="hex" data-color="#<?php echo $qr->dotColor ?>" class="input-append color colorpicker">
                        <input type="text"  value="#<?php echo $qr->dotColor ?>">
                        <span class="add-on"><i style="background-color: #<?php echo $qr->dotColor ?>;"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="span5">
            <div class="page-header">
                <h1><?php echo Yii::t('dict', 'QR Tag'); ?>:</h1>
            </div>
            <div id="qr-success" class="alert alert-success">
                QR code is readable!
            </div>
            <div id="qr-error" class="alert alert-warning">
                QR seems to be unreadable! Please make sure using your mobile scanner.
            </div>
            
            <?php if(Yii::app()->user->isGuest): ?>
                <a href="<?php echo Yii::app()->createUrl('qr/list') ?>" class="btn btn-success" style="width: 100%; margin-bottom: 10px;">Save & Continue</a>
            <?php endif ?>
            
            <div>
                <img src="<?php echo $qrImg; ?>" />
            </div>
                
            <?php if(Yii::app()->user->isGuest): ?>
                <a href="<?php echo Yii::app()->createUrl('qr/list') ?>" class="btn btn-success" style="width: 100%; margin-bottom: 10px; margin-top: 10px;">Save & Continue</a>
            <?php endif ?>
            
            <div class="gad">
                <?php echo SiteVariable::get('GAD_336x280') ?>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
</form>

<div class="container gad">
    <?php echo SiteVariable::get('GAD_728x90') ?>
</div>

<script>
    $('.qr-shape').click(function(){
        var type = $(this).data('type');
        var shape = $(this).data('shape');
        $('#customize-type').val(type);
        $('#customize-shape').val(shape);
        $('#customizeForm').submit();
    });
    
    $('#embed-logo').change(function(){
        $('#customize').val('logo');
        $('#customizeForm').submit();
    });
        
    //        $('.colorpicker').colorpicker();
        
    $('.colorpicker').colorpicker().on('hide', function(ev){
        $('#customize').val('color');
        $('#customize-type').val($(ev.target).data('type'));
        $('#customize-color').val(ev.color.toHex().replace('#', ''));
        $('#customizeForm').submit();
    });
    
    $('.input-append.colorpicker input').blur(function(){
        var picker = $(this).parent();
        var val = $(this).val().toLowerCase();
        if(/#[a-f0-9]{6}/.test(val)) {
            $(picker).data('color', val);
            $(picker).colorpicker('update');
            $(picker).colorpicker('hide');
        }
    });
</script>