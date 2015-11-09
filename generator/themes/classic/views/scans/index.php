<div class="panel panel-default" style="margin-top:20px;">
    <div class="panel-heading">
        <h3 class="panel-title">Reporting Kunde iklinik</h3>
    </div>
    <div class="panel-body">
        <?php
             
        $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'scans_list',
        'enableSorting' => true,
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
        array('header' => 'ID', 'value' => '$data->id','name'=>'id','sortable'=>true,'filter'=>false),
        array('header' => 'Title',
        'name' => 'qrtitle',
        'value' => '$data->qrtitle',
        'filter' => CHtml::dropDownList( 'Scans[qrtitle]', $model->qrtitle,
        CHtml::listData( Qr::model()->findAll( array( 'order' => 'id desc','condition'=>"company LIKE'%".Yii::app()->user->getState('company')."%'",'distinct'=>true ) ), 'title', 'title' ),
        array( 'empty' => 'select title' )

        ),'sortable'=>false),
        array('header' => 'IP', 'value' => '$data->ip','name'=>'ip','sortable'=>true,'filter'=>false),
        array('header' => 'Scan', 'value' => 'Yii::app()->dateFormatter->format("d.M.y hh:mm a",$data->scan)','name'=>'scan','sortable'=>true,'filter'=>false),
        array('header' => 'Browser', 'value' => '$data->browser'),
        array('header' => 'Platform', 'value' => '$data->platform'),
        array('header' => 'Enjoyer', 'value' => '$data->counter','name'=>'counter','sortable'=>true,'filter'=>false),
        array(
        'class' => 'CButtonColumn',
        'header' => 'Actions',
        'template' => '{delete}'
        ), ),
        ));
        ?>
    </div>
</div>