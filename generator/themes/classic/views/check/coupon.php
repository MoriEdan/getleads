<div class="row">
    <div class="col-sm-offset-2 col-sm-8 col-xs-12">
        <div style="min-height: 100px; margin-top: 100px;">
       <div class="panel panel-default" style="background-color:#eeeeee;">
  <div class="panel-body">
   
 
      <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usedcoupons-coupon-form',
          'htmlOptions'=>array('class'=>'form-inline'),
	'enableAjaxValidation'=>false,
)); ?>

	

      <div class="col-xs-5 col-sm-5 frmcoupon"><div class="form-group">
	<?php 
         echo CHtml::hiddenField('Usedcoupons[selectedvalue]','');
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name'=>'Usedcoupons[coupon]',
            'value'=>'',
            'source'=>CController::createUrl('check/autoComplete'),
            'options'=>array(
            'showAnim'=>'fold',         
            'minLength'=>'2',
            'select'=>'js:function( event, ui ) {
                        $("#Usedcoupons_coupon").val( ui.item.label );
                        $("#Usedcoupons_selectedvalue").val( ui.item.value );
                        return false;
                  }',
            ),
            'htmlOptions'=>array(
            'onfocus' => 'js: this.value = null; $("#Usedcoupons_coupon").val(null); $("#Usedcoupons_selectedvalue").val(null);',
            'class' => 'form-control input-lg',
            'placeholder' => "Coupon Code",
            ),
            ));
        
        
        
        ?>
              <?php echo $form->error($model,'coupon'); ?>
      </div>
</div>


	

	
            <div class="col-xs-4 col-sm-5 frmcoupon"><div class="form-group">
		<?php echo $form->textField($model,'citycode',array('class'=>'form-control input-lg','placeholder'=>'City Code')); ?>
                
		<?php echo $form->error($model,'citycode'); ?>
        </div>
	</div>


	
              <div class="col-xs-3 col-sm-2 frmcoupon"><div class="form-group">
		<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary btn-lg')); ?>
              </div>
	</div>

<?php $this->endWidget(); ?>

 
  </div>
</div>
    </div>
    </div>
</div>
    <div class="clearfix"></div>
    
    <div class="col-sm-offset-2 col-sm-8 col-xs-12">
        <div class="row">
   
       <?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'my-model-grid',
    'dataProvider' => $model->search(),
    'columns'=>array('coupon',
        'citycode',
        array('header'=>'Add date',
            'value'=>'Yii::app()->dateFormatter->format("d.M.y hh:mm a",$data->add_date)'
            ),array(
        'class' => 'CButtonColumn',
        'header' => 'Actions',
        'template' => '{delete}',
                'deleteButtonUrl' => 'Yii::app()->createUrl("check/del", array("id"=>$data->id))',
                'visible'=>(Yii::app()->user->getState('is_companyadmin')==1),

        )
        ),
    

    
));

?>
 
    </div>
        
    </div>
