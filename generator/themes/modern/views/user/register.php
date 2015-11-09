<?php
$this->pageTitle = Yii::app()->name . ' - Register';
$this->breadcrumbs = array(
    'Register',
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'register-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>

<div class="well">
<fieldset>
    <legend>User Registration Form</legend>

    <div class="alert">
        <button class="close" data-dismiss="alert">×</button>
        Fields with <span class="required">*</span> are required.
    </div>

    <?php $error = $form->error($model, 'username', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <?php echo $form->labelEx($model, 'username', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'username', array('class' => 'input-xlarge')); ?>
            <?php echo $error; ?>
        </div>
    </div>

    <?php $error = $form->error($model, 'password', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
            <?php echo $form->labelEx($model, 'password', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->passwordField($model, 'password', array('class' => 'input-xlarge')); ?>
            <?php echo $error; ?>
        </div>
    </div>

    <?php $error = $form->error($model, 'password2', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
            <?php echo $form->labelEx($model, 'password2', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->passwordField($model, 'password2', array('class' => 'input-xlarge')); ?>
            <?php echo $error; ?>
        </div>
    </div>

    <?php $error = $form->error($model, 'first_name', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
            <?php echo $form->labelEx($model, 'first_name', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'first_name', array('class' => 'input-xlarge')); ?>
            <?php echo $error; ?>
        </div>
    </div>

    <?php $error = $form->error($model, 'last_name', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
            <?php echo $form->labelEx($model, 'last_name', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'last_name', array('class' => 'input-xlarge')); ?>
            <?php echo $error; ?>
        </div>
    </div>

    <?php $error = $form->error($model, 'email', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
            <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'email', array('class' => 'input-xlarge')); ?>
            <?php echo $error; ?>
        </div>
    </div>
    
    <?php if (CCaptcha::checkRequirements()): ?>
                <?php $error = $form->error($model, 'verifyCode', array('class' => 'help-block')); ?>
                <div class="control-group">
                    <?php echo $form->labelEx($model, 'verifyCode', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <div class="alert alert-info">
                            <a class="close" data-dismiss="alert" href="#">×</a>
                            Please enter code as shown in the image. Letters are not case-sensitive.
                        </div>
                        <?php $this->widget('CCaptcha'); ?>
                        <?php echo $form->textField($model, 'verifyCode', array('class' => 'input-xlarge')); ?>
                        <?php echo $error; ?>
                    </div>
                </div>
            <?php endif; ?>
    
    <div class="form-actions">
        <?php echo CHtml::submitButton('Sign Up', array('class' => 'btn btn-primary')); ?>
    </div>
</fieldset>
</div>
<?php $this->endWidget(); ?>
