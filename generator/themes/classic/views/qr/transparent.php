<div class="well">

    <?php if ($image): ?>
        <h1><?php echo Yii::t('yii', 'Place QR Code position and Save') ?></h1>
        <br />
        <input type="button" style="width: 100%;" value="<?php echo Yii::t('yii', 'Convert to QR Code and Preview') ?>" name="generate" class="btn btn-primary qr-generate" />
        <br />
        <br />
        <img alt="loading..." src="<?php echo $image ?>" id="cropbox" />

        <form method="post">
            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <br />
            <input type="button"style="width: 100%;" value="<?php echo Yii::t('yii', 'Convert to QR Code and Preview') ?>" name="generate" class="btn btn-primary qr-generate" />
        </form>

        <a id="save-and-continue" style="width: 100%; margin-bottom: 10px; display: none;" class="btn btn-success" href="<?php echo $this->createUrl('/qr/list') ?>"><?php echo Yii::t('yii', 'Save & Continue') ?></a>

        <script language="Javascript">
            <?php
                $im = '';
                if($file_path) {
                    $im = imagecreatefromstring(file_get_contents($file_path));
                }
            
            ?>
            
            var jcrop_api;
            $(window).load(function() {

                jcrop_api = $.Jcrop('#cropbox');
                jcrop_api.setOptions({
                    aspectRatio: 1,
                    onSelect: updateCoords,
                    minSize: [100, 100],
                    trueSize: [<?php echo imagesx($im) ?>, <?php echo imagesy($im) ?>]
                });
                jcrop_api.setSelect([0, 0, 100, 100]);


                $('#cropbox').Jcrop({
                });

            });

            function updateCoords(c)
            {
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#w').val(c.w);
                $('#h').val(c.h);
            }

            $('.qr-generate').click(function() {
                $('.jcrop-holder').find('#qr-code').remove();
                var q = 'x=' + $('#x').val();
                q += '&y=' + $('#y').val();
                q += '&size=' + $('#w').val();

                $('.jcrop-holder').find('img,div').hide();

                var qr = $('<img style="max-width:100%;" src="<?php echo $this->createUrl('/qr/generatetransqr') ?>?' + q + '" id="qr-code" />');
                qr.click(function() {
                    $(this).remove();
                    $('.jcrop-holder').find('img,div').show();
                });

                $('.jcrop-holder').prepend(qr);
                $('#save-and-continue').show();
            });


        </script>

    <?php endif
    ?>

    <?php if ($model->validate()): ?>
        <button onclick="$(this).hide();
                    $('#upload-form').show()"><?php echo Yii::t('yii', 'Upload another Image') ?></button>
        
    <?php endif ?>
    <div id="upload-form" style="<?php echo $model->validate() ? 'display:none' : '' ?>">
        <h1><?php echo Yii::t('yii', 'Upload Image') ?></h1>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => '-form',
            'enableClientValidation' => false,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
        ));
        ?>

        <?php $error = $form->error($model, 'file', array('class' => 'help-block')); ?>
        <div class="control-group <?php echo empty($error) ? '' : 'error' ?>">
            <?php echo $form->labelEx($model, 'file', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->fileField($model, 'file', array('class' => 'input-xlarge')); ?>
                <?php echo $error; ?>
            </div>
        </div>

        <div class="form-actions" style="text-align:right;">
            <?php echo CHtml::submitButton(Yii::t('yii', 'Upload'), array('class' => 'btn btn-primary')); ?>
        </div>

        <?php $this->endWidget() ?>
    </div>

</div>