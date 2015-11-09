<?php
$this->breadcrumbs=array(
	'Scans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Scans', 'url'=>array('index')),
	array('label'=>'Create Scans', 'url'=>array('create')),
	array('label'=>'View Scans', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Scans', 'url'=>array('admin')),
);
?>

<h1>Update Scans <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>