<div class="window" id="random-track-list">
    <div class="header">Випадкові клубні треки</div>
    <ul>
    <?php foreach ($tracks as $t) : ?>
        <li>
        <a href="<?=Yii::app()->createUrl("/music/$t[id]/".Track::getTrackAlias($t['title']))?>"><?=substr($t['title'], 0, 26)?></a>
        </li>
    <?php endforeach; ?>
    </ul>    
</div>
