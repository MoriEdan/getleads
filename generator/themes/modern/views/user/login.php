<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<div class="well">
<fieldset>
    <legend>Login</legend>

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

    <?php $error = $form->error($model, 'rememberMe', array('class' => 'help-block')); ?>
    <div class="control-group <?php echo strip_tags($error) ? 'error' : '' ?>">
        <div class="controls">
            <div class="checkbox">
                <?php echo $form->checkBox($model, 'rememberMe', array('class' => 'input-xlarge')); ?> Remember me
                <?php echo $error ?>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary')); ?>
    </div>
</fieldset>
    </div>
<?php $this->endWidget(); ?>
