<div class="page-header">
    <div class="row">
    <div class="col-xs-10">    
        <h3 style="margin-top: 0px; margin-bottom: 8px;">Company</h3>
      </div>
      <div class="col-xs-2">
          <div class="pull-right">
              <a href="<?php echo Yii::app()->createUrl('check/add') ?>" class="btn btn-primary">Add Company</a>
          </div>
      </div>
    </div>
</div>


  <div class="table-responsive">
    <?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'my-model-grid',
    'dataProvider' => $dataProvider,
    'columns'=>array('username','first_name','last_name','company',array('header'=>'Created date','value'=>'Yii::app()->dateFormatter->format("d MMM y",strtotime($data->created_at))'),array(
            'class'=>'CButtonColumn',
        'header'=>'Actions'
        ),),
    

    
));

?>

</div>