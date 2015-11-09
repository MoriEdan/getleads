<?php
$this->pageTitle = Yii::app()->name . ' - Change Password';
$this->breadcrumbs = array(
    'Change Password',
);
?>
    <div class="container">
            <div class="row">
                  <h1 style="visibility: visible; font-size:25px; " class="main-head text-center wow fadeInDown animated animated" data-wow-delay=".5s"><i class="glyphicon glyphicon-lock"></i>&nbsp;CHANGE PASSWORD</h1>
<div id="changepassword" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">   
     <div class="panel panel-default grey-section" >
                 

                    <div class="panel-body pannel-body-inner-part pannel-body-inner-part-bottom" >
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'change-password-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
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
            } ?>
    
       

     <div class="col-sm-offset-1 col-sm-10">
  <div class="form-group">    
       <div class="input-group">
        <?php $error = $form->error($formModel, 'old_password', array('class' => 'text-danger')); ?>
      
           <span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
        
                <?php echo $form->passwordField($formModel, 'old_password', array('class' => 'form-control input-lg','placeholder'=>$formModel->getAttributeLabel('old_password'))); ?>
              
           
       </div>
        <?php echo $error; ?>
       </div>
     </div>
          <div class="col-sm-offset-1 col-sm-10">
  <div class="form-group">    
       <div class="input-group">
        <?php $error = $form->error($formModel, 'password', array('class' => 'text-danger')); ?>
       
          <span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
            
                <?php echo $form->passwordField($formModel, 'password', array('class' => 'form-control input-lg','placeholder'=>$formModel->getAttributeLabel('password'))); ?>
                
           
 </div>
      <?php echo $error; ?>
       </div>
     </div>
         <div class="col-sm-offset-1 col-sm-10">
  <div class="form-group">    
       <div class="input-group">
        <?php $error = $form->error($formModel, 'password2', array('class' => 'text-danger')); ?>
      
                       <span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>   
                <?php echo $form->passwordField($formModel, 'password2', array('class' => 'form-control input-lg','placeholder'=>$formModel->getAttributeLabel('password2'))); ?>
               
            </div>
       <?php echo $error; ?>
        </div>
</div>
     
        <div class="col-sm-offset-1 col-sm-10">
            <div class="form-group">
                                    <!-- Button -->

                                   
            <?php echo CHtml::submitButton('Change Password', array('class' => 'btn btn-primary btn-lg col-xs-12')); ?>
                                    
            </div>
        </div>
     
  
   
 </div>
    <?php $this->endWidget(); ?>
                          </div>                     
                    </div>  
</div>
                 </div>
        </div>