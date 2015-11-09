<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

  <div class="container">
            <div class="row">
                <h1 style="visibility: visible; font-size:25px;" class="main-head text-center wow fadeInDown animated animated" data-wow-delay=".5s"><i class="glyphicon glyphicon-log-in"></i>&nbsp;Login</h1>
        <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-default grey-section" >


                    <div class="panel-body pannel-body-inner-part" >

                        
                        <?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),'htmlOptions'=>array(
                          'class'=>'form-horizontal',
        'role'=>'form',
                        )
        ));
?>    
                        <div class="col-xs-12">
                            <?php
                               if (Utility::hasFlash('success')) {
                foreach (Utility::getFlash('success') as $message) {

                    echo '<div class="alert alert-success">
                                            <button class="close" data-dismiss="alert">×</button>
                                            ' . $message . '
                                        </div>';
                }
            } ?> <div class="col-sm-offset-1 col-sm-10">
                        <div class="form-group">        
                            <div class="input-group">
                                 <?php $error = $form->error($model, 'username', array('class' => 'text-danger')); ?>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        
                                         <?php echo $form->textField($model, 'username', array('class' => 'form-control input-lg','placeholder'=>$model->getAttributeLabel('username'))); ?>
           
                                    </div>
                         <?php echo $error; ?>
                        </div>
            </div>
                             <div class="col-sm-offset-1 col-sm-10">
                          <div class="form-group">      
                            <div class="input-group">
                                 <?php $error = $form->error($model, 'password', array('class' => 'text-danger')); ?>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                          <?php echo $form->passwordField($model, 'password', array('class' => 'form-control input-lg','placeholder'=>"Password")); ?>
           
                                    </div>
                                    
 <?php echo $error; ?>
                              </div>  
                                 </div> 
                            <div class="col-sm-offset-1 col-sm-10">
                        <div class="form-group">      
                                
                            <div class="input-group">
                                <?php $error = $form->error($model, 'rememberMe', array('class' => 'text-danger')); ?>
                                <div class="checkbox checkbox-primary" style="padding-left: 20px;">
                                          <?php echo $form->checkBox($model, 'rememberMe', array('class' => 'input-xlarge','id'=>'checkbox1')); ?> 
                                        <label for="checkbox1">
                                        
                                           Remember me
               
                                        </label>
                                      </div>
                                 <?php echo $error ?>
                                    </div>
                              </div>
                            </div>
                             <div class="col-sm-offset-1 col-sm-10">
                                <div class="form-group">
                                    <!-- Button -->

                                    <div class="controls">
                                    
                                        <button type="submit" name="LoginForm['Login']" class="btn btn-primary btn-lg col-xs-12"><i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;Login</button>
                                    </div>
                                    
                                </div>
                             </div>
<!-- <div class="col-sm-offset-1 col-sm-10">
                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="<?php echo $this->createUrl('user/register'); ?>">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>
                                </div>   
 </div>-->
                        </div>
                           <?php $this->endWidget(); ?>   



                        </div>                     
                    </div>  
        </div>
            </div>
        </div>
