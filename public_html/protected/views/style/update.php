<?php
$this->breadcrumbs=array(
	'Styles'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Style', 'url'=>array('index')),
	array('label'=>'Create Style', 'url'=>array('create')),
	array('label'=>'View Style', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Style', 'url'=>array('admin')),
);
?>

<h1>Update Style <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>