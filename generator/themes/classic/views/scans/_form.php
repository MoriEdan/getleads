<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'scans-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'scan'); ?>
		<?php echo $form->textField($model,'scan'); ?>
		<?php echo $form->error($model,'scan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'browser'); ?>
		<?php echo $form->textField($model,'browser',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'browser'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'platform'); ?>
		<?php echo $form->textField($model,'platform',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'platform'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'client'); ?>
		<?php echo $form->textField($model,'client',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'client'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'counter'); ?>
		<?php echo $form->textField($model,'counter'); ?>
		<?php echo $form->error($model,'counter'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->