<div class="panel panel-default" style="margin-top:20px;">
  <div class="panel-heading">

    <h3 class="panel-title">Add a new Company</h3>
  
    </div>
  <div class="panel-body">
      <?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'htmlOptions'=>array('class'=>'form-horizontal'),
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'focus'=>array($model,'username'),
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="form-group">
    <?php echo $form->labelEx($model,'username',array('class'=>'col-sm-2 control-label','for'=>'username')); ?>
    <div class="col-sm-6">
    <?php echo $form->textField($model,'username',array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'username'); ?>
    </div>
   
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'password',array('class'=>'col-sm-2 control-label','for'=>'password')); ?>
    <div class="col-sm-6">
    <?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'password'); ?>
    </div>
    
</div>
      <div class="form-group">
    <?php echo $form->labelEx($model,'first_name',array('class'=>'col-sm-2 control-label','for'=>'first_name')); ?>
    <div class="col-sm-6">
    <?php echo $form->textField($model,'first_name',array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'first_name'); ?>
    </div>
   
</div>
      <div class="form-group">
    <?php echo $form->labelEx($model,'last_name',array('class'=>'col-sm-2 control-label','for'=>'last_name')); ?>
    <div class="col-sm-6">
    <?php echo $form->textField($model,'last_name',array('class'=>'form-control')); ?>
    <?php echo $form->error($model,'last_name'); ?>
    </div>
   
</div>
        <div class="form-group">
    <?php echo $form->labelEx($model,'company',array('class'=>'col-sm-2 control-label','for'=>'company')); ?>
    <div class="col-sm-6">
   <?php echo $form->dropDownList($model,'company', CHtml::listData(Qr::model()->findAll(array('condition'=>"company!=''",'distinct'=>true, 'order' => 'company ASC')), 'company', 'company'), array('empty'=>'Select Company','class'=>'form-control')) ?>
    <?php echo $form->error($model,'company'); ?>
    </div>
   
</div>
        <div class="form-group">
    <?php echo $form->labelEx($model,'is_companyadmin',array('class'=>'col-sm-2 control-label','for'=>'is_companyadmin')); ?>
    <div class="col-sm-6">
        <label style="padding-top: 5px;">
    <?php echo $form->checkBox($model,'is_companyadmin',array('value'=>'1')); ?>
        </label>
    <?php echo $form->error($model,'is_companyadmin'); ?>
    </div>
   
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
         <?php echo $form->hiddenField($model,'is_shop',array('value'=>'1')); ?>
        <?php echo $form->hiddenField($model,'id',array('value'=>0)); ?>
      <button type="submit" class="btn btn-primary">Add</button>
    </div>
  </div>
<?php $this->endWidget(); ?>

  </div>
</div>