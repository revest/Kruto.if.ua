<?php
//foreach ($Tracks as $track){   var_dump($track);   echo '<br>';   echo '<br>';}
//var_dump($Tracks[0]);


$dataProvider = new SDataProvider("grid", $Tracks);
//echo "sdf";
/*
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        'number',
        'title',
        'styles',
        'link',
        'date_relize',
    ),
    )
);*/

 $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'graber/_view',
)); ?>

