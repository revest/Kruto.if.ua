<?php

class RandomTrackList extends CWidget {

    public function init() {
        parent::init();
        $sql = "select id, title from track order BY RAND() limit 20";             
        
        $value = Yii::app()->cache->get("random tracklist");
        if ($value === false) {
            $value =  Yii::app()->db->createCommand($sql)->queryAll();// устанавливаем значение $value заново, т.к. оно не найдено в кэше,
            // и сохраняем его в кэше для дальнейшего использования:
            //Yii::app()->cache->delete("random tracklist");
             Yii::app()->cache->set("random tracklist",$value, 30);
        }
        $this->render("application.widgets.view.RandomTrackList", array('tracks' => $value));
    }

    public function run() {
        parent::run();
    }

}

?>
