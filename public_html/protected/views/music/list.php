<form action="" method="get">
    <?php if(isset($_GET['q'])) $value = $_GET['q']; else $value="";?>
    <input name="q"/>
    <input type="submit"/>
</form>



<div id="wrapper">
    <table>
       <?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '//music/_view2',
));

?>
    </table>
</div>       