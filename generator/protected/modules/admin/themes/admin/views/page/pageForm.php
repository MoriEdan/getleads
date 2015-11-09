<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/bootstrap-wysihtml5-0.0.2.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/wysihtml5-0.3.0_rc2.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/bootstrap-wysihtml5-0.0.2.min.js');

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'page-pageForm-form',
//    'enableClientValidation' => true,
//    'clientOptions' => array(
//        'validateOnSubmit' => true,
//    ),
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    ),
        ));
?>

<fieldset>
    <legend>Add New Page</legend>
    <div class="alert">
        <button class="close" data-dismiss="alert">×</button>
        Fields with <span class="required">*</span> are required.
    </div>

        <?php  $error = $form->error($model, 'title'); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
            <?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($model, 'title', array('class' => 'input-xlarge')); ?>
            <p class="help-block"><?php echo $error; ?></p>
        </div>
    </div>

    <div class="control-group">
            <?php echo $form->labelEx($model, 'content', array('class' => 'control-label')); ?>
        <div class="controls">
        <p class="help-block"><?php echo $form->error($model, 'content'); ?></p>
        <?php echo $form->textArea($model, 'content', array('class' => 'rte', 'style' => 'width:100%;height:300px;')); ?>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton('Save', array('class' => 'btn btn-primary')); ?>
    </div>
</fieldset>
<?php $this->endWidget(); ?>

<script>
    $('.rte').wysihtml5();
</script>