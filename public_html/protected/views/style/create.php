<?php
$this->breadcrumbs=array(
	'Styles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Style', 'url'=>array('index')),
	array('label'=>'Manage Style', 'url'=>array('admin')),
);
?>

<h1>Create Style</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>