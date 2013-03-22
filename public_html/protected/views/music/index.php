<?php
$burl = Yii::app()->baseUrl;
global $STYLES;
global $STYLES_ALIAS;
$Syles = $STYLES;
$Syles[0] = '-Всі стилі-';
$STYLES_ALIAS[0] = '';
$style = '';
if (isset($_GET['style']))
    $style = $_GET['style'];

foreach ($Syles as $id => $name) {
    $List[$STYLES_ALIAS[$id]] = $name;
}

$this->menu = array(
    array('label' => 'Create Track', 'url' => array('create')),
    array('label' => 'Manage Track', 'url' => array('admin')),
);
?>

<div>
    <h1 class="fl_l">Клубна музика скачати бесплатно</h1>        

</div>
<div class="style-navigator">
    <? foreach ($List as $al => $name) : ?>
        <a <?if($style==$al) echo "class='selected'"?> href="<?= $burl ?>/music/<?= $al ?>"><?= $name ?></a>
<? endforeach ?>
</div>
<hr/>
<? $_SESSION['playlist'] = array() ?>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
<?
/*
  <script type="text/javascript">
  $('#style').change(function(){
  location.hash= "<?=Yii::app()->baseUrl?>/music/"+$('#style').val();
  });
  </script>

  <form method="GET" action="" >
  <? echo CHtml::dropDownList('style', $style, $List, array('class'=>'fl_l')); ?>
  </form>
 */?>