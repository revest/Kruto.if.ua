<div id="music">
    <?php
    $this->breadcrumbs = array(
        'Клубна музика' => array('/music'),
        $model->title
    );


    $this->pageKeywords = tm('Download') . ", " . tm('free') . ", " . tm('Club music') . ", " . preg_replace("/( - )/", ', ', $model->title) . ", " . $model->styles;
    $this->pageTitle = $model->title . $model->styles;
    $this->pageDescription = $this->pageKeywords;

    $this->menu = array(
        array('label' => 'List Track', 'url' => array('index')),
        array('label' => 'Create Track', 'url' => array('create')),
        array('label' => 'Update Track', 'url' => array('update', 'id' => $model->id)),
        array('label' => 'Delete Track', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => 'Manage Track', 'url' => array('admin')),
    );
    global $STYLES;

    if (!isset($id_prev))
        $id_prev = "";
    if (!isset($id_next))
        $id_next = "";

    if (isset($_SESSION['playlist']))
        $key = array_search($model->id, $_SESSION['playlist']);
    if (isset($_SESSION['playlist'][$key - 1]))
        $id_prev = $_SESSION['playlist'][$key - 1];
    if (isset($_SESSION['playlist'][$key + 1]))
        $id_next = $_SESSION['playlist'][$key + 1];
//var_dump($_SESSION['playlist']);
    ?>
    <div class="track-view">
        <h1 class="title"><?php echo tm('Download') . " " . tm('free') . " " . $model->title ?></h1>
        <div class="cover">
            <img class="case" src="<?= Yii::app()->baseUrl . '/images/vinil3.png' ?>" border="0"/>
            <img class="track-cover" src="<?= $model->cover ?>"/>
        </div>    
        <div>
            <div id="navigation" class="fl_l">        
                <?
                $this->renderPartial('//widjet/track-player', array('id' => '',
                    'title' => $model->title,
                    'preview_link' => $model->files[0]->link,
                    'prev_id' => $id_prev,
                    'next_id' => $id_next,
                    'id' => $model->id
                ))
                ?>           
            </div>
            <div class="track-find">
                <h3 class="fl_l" style="width: 120px;"><?= tm('Find Track') ?>:</h3>

                <a noajax="true"  href="http://vk.com/audio?q=<?= urlencode($model->title) ?>"      title="ВКонтакте" target="_blank" rel="nofollow">
                    <image src="<?= Yii::app()->baseUrl ?>/images/icon/vk_icon.gif"/>
                </a>
                <a noajax="true"  href="http://www.google.com.ua#q=<?= urlencode($model->title) ?>" title="Google" target="_blank" rel="nofollow">
                    <image src="<?= Yii::app()->baseUrl ?>/images/icon/google_icon.gif"/>
                </a>
                <a noajax="true"  href="http://www.yandex.ru/yandsearch?text=<?= urlencode($model->title) ?>"  title="Яндекс" target="_blank" rel="nofollow">
                    <image src="<?= Yii::app()->baseUrl ?>/images/icon/yandex_icon.gif"/>
                </a>
            </div>

        </div>
        <hr/>
        <div>
            <? if (!empty($model->text)) : ?>
                <div class="text window"> 
                    <?php echo CHtml::encode($model->text) ?>
                </div>        
            <? endif ?>

            <div class="info">   
                <div class="data fl_l" style="width: 50%">
                    <h3><?= tm('Details') ?></h3>                
                    <b><?= tm('Author') ?></b> <?php echo CHtml::encode($model->author->username); ?> <br/>                
                    <b><?= tm('Styles') ?></b> <?php echo CHtml::encode($model->styles); ?><br/>
                    <b><?= tm('Date') ?>:</b> <?= CHtml::encode($model->date); ?> &nbsp;
                    <? if (isset($model->date_relize)): ?>
                        <b><?= tm('Relize Date') ?>:</b> <?php echo CHtml::encode($model->date_relize); ?>
                    <? endif; ?>                                       
                </div>                   
            </div>   
        </div>
    </div>
</div>

<script type="text/javascript">    
    $(function(){
        if(!player.Track.preview)
             setTimeout(function(){$('.track-player .play-load').click()},1000);
    });
</script>