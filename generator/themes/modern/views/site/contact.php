<?php
$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>

<div class="well">
<div class="page-header">
        <h1>Contact Us</h1>
</div>

<?php if (Yii::app()->user->hasFlash('contact')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>

<?php else: ?>


        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'contact-form',
            'enableClientValidation' => false,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('class' => 'form-horizontal'),
                ));
        ?>
        <fieldset>
                <?php echo $form->errorSummary($model, '<div class="alert alert-error"> <a class="close" data-dismiss="alert" href="#">×</a>', '</div>'); ?>

            <?php $error = $form->error($model, 'name', array('class' => 'help-block')); ?>
            <div class="control-group <?php echo empty($error) ? '' : 'error' ?>">
                <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'name', array('class' => 'input-xlarge')); ?>
                    <?php echo $error; ?>
                </div>
            </div>
            
            <?php $error = $form->error($model, 'email', array('class' => 'help-block')); ?>
            <div class="control-group <?php echo empty($error) ? '' : 'error' ?>">
                <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'email', array('class' => 'input-xlarge')); ?>
                    <?php echo $error; ?>
                </div>
            </div>
            
            <?php $error = $form->error($model, 'subject', array('class' => 'help-block')); ?>
            <div class="control-group <?php echo empty($error) ? '' : 'error' ?>">
                <?php echo $form->labelEx($model, 'subject', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model, 'subject', array('class' => 'input-xlarge', 'size' => 60, 'maxlength' => 128)); ?>
                    <?php echo $error; ?>
                </div>
            </div>
            
            <?php $error = $form->error($model, 'body', array('class' => 'help-block')); ?>
            <div class="control-group <?php echo empty($error) ? '' : 'error' ?>">
                <?php echo $form->labelEx($model, 'body', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textArea($model, 'body', array('class' => 'input-xlarge', 'rows' => 6, 'cols' => 50)); ?>
                    <?php echo $error; ?>
                </div>
            </div>


            <?php if (CCaptcha::checkRequirements()): ?>
            <?php $error = $form->error($model, 'verifyCode', array('class' => 'help-block')); ?>
            <div class="control-group <?php echo empty($error) ? '' : 'error' ?>">
                    <?php echo $form->labelEx($model, 'verifyCode', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <div class="alert alert-info">
                                <a class="close" data-dismiss="alert" href="#">×</a>
                            Please enter the letters as they are shown in the image above.
                            <br/>Letters are not case-sensitive.
                        </div>
                        <?php $this->widget('CCaptcha'); ?>
                        <?php echo $form->textField($model, 'verifyCode', array('class' => 'input-xlarge')); ?>
                        <?php echo $error; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-actions">
                <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary')); ?>
            </div>
        </fieldset>
    <?php $this->endWidget(); ?>

<?php endif; ?>
</div>