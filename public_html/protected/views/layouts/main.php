<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?= CHtml::encode($this->pageTitle); ?></title>	
        <meta name="keywords" content="<?= $this->pageKeywords ?>" />
        <meta name="description" content="<?= CHtml::encode($this->pageDescription); ?>" />         
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="<?= Yii::app()->language ?>" />
        <?php Yii::app()->dynamicRes->registerCssFile(Yii::app()->request->baseUrl . '/css/screen.css'); ?>
        <?php //Yii::app()->dynamicRes->registerCssFile(Yii::app()->request->baseUrl . '/css/print.css'); ?>
        <?php Yii::app()->dynamicRes->registerCssFile(Yii::app()->request->baseUrl . '/tools/chat/shoutbox.css'); ?>
        <?php Yii::app()->dynamicRes->registerCssFile(Yii::app()->request->baseUrl . '/css/main.css'); ?>
        <?php Yii::app()->dynamicRes->registerCssFile(Yii::app()->request->baseUrl . '/css/form.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/track.css'); ?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/scontent.css'); ?>


        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->
        <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/icon/favicon.gif" />
        <?php /* echo CGoogleApi::init(); ?>
          <script type="text/javascript"> google.load("jquery","1.3.2"); </script>
         */ ?> 
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
        <script type="text/javascript" src="http://userapi.com/js/api/openapi.js?23"></script>
        <script type="text/javascript">
            window.baseUrl = '<?= Yii::app()->baseUrl; ?>';
            if(location.hash!="")
                location.href=location.hash.replace('#','');
            /**    for achor page linking**/      
          
            function getPlayer(preview){
                var string = '<?= SHTML::player('{link}') ?>';
                return string.replace("{link}",preview);
            }
            

            Yash = new Ya.share({
                element: 'ya_share',
                elementStyle: {
                    'type': 'button',
                    'quickServices': ['vkontakte','facebook','twitter','lj','odnoklassniki','moimir','yaru',]
                }
          
            });

        </script>                             
        <script type="text/javascript" src="<?= Yii::app()->request->baseUrl . "/js/main.js" ?>"></script>


    </head>
    <body style="background-image: url(<?= Yii::app()->baseUrl . "/images/fon.jpg" ?>)">
        <div class="container" id="page">
            <div id="header1" class="window">
                <? //$this->renderPartial('//widjet/lang-changer')?> 
                <div id="mainPlayer">
                    <? $this->renderPartial('//widjet/krutoPlayer') ?>
                </div>
                <div class="clear"></div>
            </div><!-- header -->

            <div id="mainmenu" class="window">
                <?php /*
                  //if ($this->beginCache("main-menu", array('duration' => 3600 * 24))) {
                  $this->widget('zii.widgets.CMenu', array(
                  'items' => array(
                  array('label' => tm('Home'), 'url' => array('/music')),
                  array('label' => tm('About Us'), 'url' => array('/site/page', 'view' => 'about')),
                  array('label' => tm('Feetback'), 'url' => array('/site/contact')),
                  array('label' => tm('Search'), 'url' => array('/site/yasearch')),
                  //    array('label' => 'Пошук музики', 'url' => array('/site/msearch')),
                  //   array('label' => 'Вхід', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                  //   array('label' => 'Користувач', 'url' => array('/user'), 'visible' => !Yii::app()->user->isGuest),
                  //   array('label' => 'Вихід (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                  ),
                  ));
                  //  $this->endCache();
                  //} */
                ?>

         
                    <ul id="">
                        <li><a href="/music"><?=tm('Home')?></a></li>
                        
                        <li><a href="/site/contact"><?=tm('Feetback')?></a></li>
                        <li><a href="/site/yasearch"><?=tm('Search')?></a></li>
                    </ul>            
            </div><!-- mainmenu -->

            <?php echo $content; ?>
            <div class="clear"></div>


            <div id="footer" class="window">
                <div><a href="<?= Yii::app()->createUrl("site/page", array('view' => 'partners')) ?>">Партнёры</a></div>
                Copyright &copy; <?php echo date('Y'); ?> by Kruto.if.ua<br/>
                All Rights Reserved.<br/>
            </div><!-- footer -->

            <noscript><div><img src="//mc.yandex.ru/watch/17021788" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

        </div><!-- page -->

    </body>
</html>
<? Yii::app()->dynamicRes->saveScheme(); ?>