<?
$lang_arr['uk'] = 'Українська';
$lang_arr['ru'] = 'Русский';
$lang_arr['en'] = 'English';
?>
<div id="lang-changer" class="fl_l">
    <? foreach ($lang_arr as $l => $l_name): ?>
        <a noajax="true" href="?lang=<?=$l?>" onclick="setCookiesLang('<?=$l?>')">
            <img src="<?= Yii::app()->baseUrl ?>/images/icon/flag_<?= $l ?>.png" alt="<?= $l_name ?>" title="<?= $l_name ?>"/>
        </a>
    <? endforeach; ?>
</div>

