<?php
/*
 * id
 * title
 * preview_link
 * prev__id
 * next__id
 */
$icondir = Yii::app()->baseUrl . "/images/icon/player/";
?>
<div class="track-player" id="track-player-m<?= $id ?>">
    <? if ($prev_id != "") : ?>
        <a href="<?= $this->createUrl('/music/' . $prev_id) ?>">
            <img src="<?= $icondir ?>prev1.png" alt="previous" title="previous"/>
        </a>
    <? endif; ?>


    <a class="play" style="" href="#" href="#"> <img title="play" src="<?= $icondir ?>play.png" /></a>
    <a class="pause" style="display: none" href="#"><img title="pause" src="<?= $icondir ?>pause.png" /></a>

    <?=
    CHtml::link('<img src="' . $icondir . 'download.png" alt="download" title="download"/>', "#", array('noajax' => 'true',
        'onclick' => "return downloadWindow('$preview_link')",
    ))
    ?>

    <? if ($next_id != "") : ?>
        <a href="<?= $this->createUrl('/music/' . $next_id) ?>">
            <img src="<?= $icondir ?>next1.png" alt="next" title="next"/>
        </a>
    <? endif; ?>
</div>

<script type="text/javascript">
    window.currentTrack_id = '<?=$id?>';
    $(function(){          
        if(!player.Track.id>0)
             $('.track-player .play').click();});
</script>

