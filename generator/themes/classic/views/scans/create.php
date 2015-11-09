<?php
$this->breadcrumbs=array(
	'Scans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Scans', 'url'=>array('index')),
	array('label'=>'Manage Scans', 'url'=>array('admin')),
);
?>

<h1>Create Scans</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>