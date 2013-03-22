<?php //  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/swfobject.js'); ?>
<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/uppod_api.js'); ?>
<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/uppod.js'); ?>


<? $burl = Yii::app()->baseUrl;?>


<div style="background: #000; margin-top: 14px;  height:24px; width: 455px; overflow:hidden; border:1px #00ff00 solid;">
<object style="margin-top: -280px" id="main-player" width="450" height="300"  data="<?=$burl?>/flash/uppod.swf" type="application/x-shockwave-flash" id="audiopl116795">
    <param value="false" name="allowFullScreen">
    <param value="always" name="allowScriptAccess">
    <param value="opaque" name="wmode">
    <param value="<?=$burl?>/flash/uppod.swf" name="movie">
    <param value="uid=main-player&comment=0&amp;st=<?=$burl?>/flash/player4.txt&amp;file=" name="flashvars">
</object>
    </div>


