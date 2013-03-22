<div id="pageTitle" style="display: none"><?=$this->pageTitle?></div>
<div class="header">
            <p id="title">
                <b id="profile_online_lv" class="fl_r">
                    <? //$user->online   ?>      
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

