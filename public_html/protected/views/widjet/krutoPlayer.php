<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/krutoPlayer.css'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/uppod.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/uppod_api.js'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/playerKruto.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile("https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"); ?>
<?$icondir = Yii::app()->baseUrl . "/images/icon/player/";?>
<div class="krutoPlayer">

    <div class="cover"><a class="href" href="#">
            <img src="http://clubtone.net/_ld/2940/294030.jpg" alt="cover" /></a>
    </div>

    <div class="info">
        <a class="href" href="#">
            <div class="title">
                <?php echo CHtml::encode(Yii::app()->name) . " - " . tm('Subcultural Young People Portal'); ?>
            </div>
        </a>


        <div class="timing">

            <div class="timeline">
                <div class="loaded">
                    <div class="progress"></div>
                </div>
            </div>

        </div>

        <div class="lowest">
            <div class="buttons">
                <a class="prev" href="#"> <img title="prev"  src="<?=$icondir?>prev1.png" /></a>
                <a class="play" href="#"> <img title="play" src="<?=$icondir?>play.png" /></a>
                <a class="pause" href="#"><img title="pause" src="<?=$icondir?>pause.png" /></a>
                <a class="next" href="#"> <img title="next" src="<?=$icondir?>/next1.png" /></a>
                <a class="href" href="#"> <img title="download" src="<?=$icondir?>/download.png" /> </a>
            </div>

            <div class="duration">0:0</div>
            <div class="divert">|</div>
            <div class="time">0:0</div> 
            <div class="clear"></div>
        </div>

    </div>
    <div class="clear"></div>
</div>

<? $burl = Yii::app()->baseUrl;?>

<div style="background: #000; margin-top: 14px;  height:0px; width: 0px; overflow:hidden; border:1px #00ff00 solid;">
<object style="margin-top: -280px" id="main-player" width="450" height="300"  data="<?=$burl?>/flash/uppod.swf" type="application/x-shockwave-flash" id="audiopl116795">
    <param value="false" name="allowFullScreen">
    <param value="always" name="allowScriptAccess">
    <param value="opaque" name="wmode">
    <param value="<?=$burl?>/flash/uppod.swf" name="movie">
    <param value="uid=main-player&comment=0&amp;st=<?=$burl?>/flash/player4.txt&amp;file=" name="flashvars">
</object>
</div>

