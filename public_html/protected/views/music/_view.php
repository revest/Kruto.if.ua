<?//для сылочной перехода у view
$_SESSION['playlist'][]=$data->id;
?>
<div class="track">	
    <? if (empty($data->cover)) $data->cover =  Yii::app()->baseUrl."/images/nocover.jpg"; ?>
    <div class="cover fl_l">
        <?php echo CHtml::link(CHtml::image(CHtml::encode($data->cover)), array('view', 'id' => $data->id, 'track_alias'=>  Track::getTrackAlias($data->title))); ?>        
    </div>	
    <div class="data fl_l">           
        <div class="title">
             <?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id' => $data->id, 'track_alias'=> $data->trackAlias)); ?>                  
        </div>
        
        <div class="style">
             <?php echo CHtml::encode($data->styles); ?>
        </div>    
        
        <?php if (!empty($data->author)) : ?>
            <b><?php echo CHtml::encode('Author'); ?>:</b>
            <?php echo CHtml::encode($data->author->username),"&nbsp;|&nbsp;"; ?>            
        <? endif; ?>

        <?php if (!empty($data->duration)) : ?>
            <b><?php echo CHtml::encode("Тривалість"); ?>:</b>
            <?php echo CHtml::encode($data->duration), "&nbsp;|&nbsp;"; ?>            
        <? endif; ?>
            
      <?php if (!empty($data->previews)) : ?>      
              <b><?php echo CHtml::encode('переглядів'); ?>:</b>
            <?php echo CHtml::encode($data->previews),"&nbsp;|&nbsp;"; ?>
       <? endif; ?>     
      
<?php if (!empty($data->date)) : ?>   
        <b><?php echo CHtml::encode('Дата загрузки'); ?>:</b>
        <?php echo CHtml::encode($data->date),"&nbsp;|&nbsp;"; ?>
        <br />
        <? endif; ?>  
    </div>
</div>
<hr/>