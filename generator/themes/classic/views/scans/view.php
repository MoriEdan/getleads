<?php
$this->breadcrumbs=array(
	'Scans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Scans', 'url'=>array('index')),
	array('label'=>'Create Scans', 'url'=>array('create')),
	array('label'=>'Update Scans', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Scans', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Scans', 'url'=>array('admin')),
);
?>

<h1>View Scans #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ip',
		'scan',
		'browser',
		'platform',
		'client',
		'counter',
	),
)); ?>
