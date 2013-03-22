<?php $this->beginContent('//layouts/main'); ?>
<div class="column_right" style="float: left" >
    <div id="ya_share" class="window" data-yashareL10n="uk"></div> 

    <div class="window">        
        <?
        $pathToShoutBox = 'tools/chat';
        require_once $pathToShoutBox . "/shoutbox.inc.php";
        ?>
    </div>

</div>
<div class="span-15">
    <div class="window">        
        <div id="content">
            <div class="header">
                <p id="title">
                    <b id="profile_online_lv" class="fl_r">
                    <? //$user->online    ?>      
                    </b>
                    <?php if (isset($this->breadcrumbs)): ?>
                        <?php
                        $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links' => $this->breadcrumbs,
                        ));
                        ?><!-- breadcrumbs -->
<?php endif ?>
                </p>
            </div>	
<?php echo $content; ?>           
        </div>    
        <div class="window" style=""><div id="vk_comments"></div> </div>
    </div><!-- content -->
</div>

<div class="column_right">

        <? if (!empty($this->menu) && isset(Yii::app()->user->id)) : ?>
        <div id="sidebar" class="window" >
            <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title' => 'Operations',
            ));
            $this->widget('zii.widgets.CMenu', array(
                'items' => $this->menu,
                'htmlOptions' => array('class' => 'operations'),
            ));
            $this->endWidget();
            ?>
        </div><!-- sidebar -->
    <? endif ?>
<? $this->Widget("application.widgets.RandomTrackList"); ?>
    <div class="window"> <div id="vk_groups"></div></div>
    
 
</div>
<?php $this->endContent(); ?>