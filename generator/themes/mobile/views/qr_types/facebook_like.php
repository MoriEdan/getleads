<div style="margin:0 auto;text-align:center;">
    <h3><?php echo $qr->qrData->title ?></h3>
    <iframe
        src="http://www.facebook.com/plugins/like.php?href=<?php echo $qr->qrData->url ?>&amp;layout=box_count&amp;show_faces=false&amp;action=like&amp;width=48&amp;font=&amp;color_scheme=light"
        scrolling="no"
        frameborder="0"
        style="border:none; overflow:hidden; width:96px; height:65px;margin:0 auto;"
        allowTransparency="true"></iframe>
</div>

<div class="panel panel-default" style="margin-top:20px;">
  <div class="panel-heading">
     <?php if (Yii::app()->user->hasFlash('contact')): ?>

            <div class="flash-success">
                <?php echo Yii::app()->user->getFlash('contact'); ?>
            </div>

        <?php endif; ?>
  
    </div>
  <div class="panel-body">
      <?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'email-form',
    'htmlOptions'=>array('class'=>'form-horizontal'),
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="form-group">
    <?php echo $form->labelEx($model,'email_id',array('class'=>'col-sm-2 control-label','for'=>'username')); ?>
    <div class="col-sm-6">
    <?php echo $form->textField($model,'email_id',array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'email_id'); ?>
    </div>
   
</div>
      
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <button type="submit" class="btn btn-primary">Abschicken</button>
    </div>
  </div>

<?php $this->endWidget(); ?>

  </div>
</div>