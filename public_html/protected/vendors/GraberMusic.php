<?php 

class GraberMusic {

    public $Styles; // array 'id'=>'name' of Styles in table Style

    public function __construct($Styles) {
        $this->Styles = $Styles;
    }

    //get id in $Styles  of $style
    public function getStyleId($style, $Styles=null) {       
       global $STYLES;
        if(count($STYLES>1)){
           $Styles = $STYLES;
       }
       else
        if (is_null($Styles))
            $Styles = $this->Styles;
       // $style = str_replace("/", "\/", $style);
        $e = explode("/", $style);
       $style= trim($e[0]);
        foreach ($Styles as $id => $name) {            
          if (preg_match("/".$style."/", $name))
                return $id;
        }
        //  return $this->unknown_style_id;
        return 100;
    }
/////////////////////////////////////////////////////////////////////////////////////    
    public function parseTracks($site=null, $page=null, $style_id=null){
        if(is_null($site)) $site="ct";
        $page      = (int)  $page;
        //$style_id = (int)  $styles_id;
        if($page<1) $page=1;
        
        if($site=="ck"){         
         $url = "http://clubkings.eu/mp3_download/p". $page;
         $Tracks =  $this->parseTracksCK2();
        }
        elseif($site=="ct"){
            $url = 'http://clubtone.net/load/club_music/2-'.$page.'-2';
          $Tracks =  $this->parseTracksCT($url);
        }
                return $Tracks;        
    }

    public function parseTracksCK($page=null) {        
        if (is_null($page))
            $page = 1;
        else $page = (int)$page;

        $url = "http://clubkings.eu/mp3_download/p" . $page;
        $file = SPHP::file_get_cache($url);
        $regu = '/<p.*?onclick="infoplayer\(.(http:\/\/www([0-9]{0,3}).zippyshare.com\/v\/([0-9]*?)\/file.html).*?.>(.*?)<\/p>\r\n.*?<p class="category">(.*?)<\/p>/';
        if (preg_match_all($regu, $file, $reg))
            ;

        /////////////////////////////////////
        $tracks = array(); ///tracklist;

        foreach ($reg[1] as $key => $value) {
            $track = new GTrack;
            $track->number = $key;
            $track->title = $reg[4][$key];
            $track->link = $reg[1][$key];
            $track->bitrate = 320;
            $track->styles = $reg[5][$key];
            $track->sourceSite = 'http://clubkinks.eu';
            $track = $this->setStyleId($track);

            $Tracks[] = $track;
        }

        return $Tracks;
    }

    ///New Parser
    public function parseTracksCK2($url) {
        //$site_track="http://clubkings.eu/mp3_download/";               
        //$file = file_get_contents($url);
        $file = SPHP::file_get_cache($url);
        $Tracks = array();
        $a = strpos($file, '<div id="container">');
        $b = strpos($file, '<div id="footer">');
        
        $file = substr($file, $a,$b-$a);
        
        $doc = phpQuery::newDocument($file);
        
        $regu = '/<p class="category">(.*?)<\/p>/';
        if(preg_match_all($regu, $file, $res));
        
        $allEnteries = $doc->find('.player');              
        foreach ($allEnteries as $k => $el) {
            $pq = pq($el); // Это аналог $ в jQuery                        
            $track = new GTrack(); 
            $track->number = $k;
            $track->styles = $res[1][$k];
            $track->style_id = $this->getStyleId($track->styles);
            $track->link = $pq->attr('id');
            $A = $pq->find('a');
           //$a = pq($A[]);
           
            $track->title = $A->attr('title');
            $track->source = 'http://clubkings.eu/';  
            $track->source .= $A->attr('href');
            
            $track->bitrate = 320;
            
            $Tracks[] = $track;
        }

        return $Tracks;
    }

    public function parseTracksCK_cache($page) {
        $cache_dir = 'protected/data/cache-ck/';
        $cache_file = $cache_dir . $page . ".cache";
        $cache_time = 3600;

        if (file_exists($cache_file)) {
            $modif_time = time() - filemtime($cache_file);
        } else {
            $modif_time = $cache_time + 100;
        }

        if ($modif_time < $cache_time) {
            $traks = SPHP::file_get_var($cache_file);
            return $traks;
        } else {
            $traks = $this->get_tracksCK($page);
            SPHP::file_put_var($traks, $cache_file);
            return $traks;
        }
    }

    //return array of track from list Clubtone
    public function parseTracksCT($filename) {
        //  Yii::import('application.vendors.phpQuery');
        $doc = phpQuery::newDocument(SPHP::file_get_cache($filename));
        $allEnteries = $doc->find('#allEntries>div');

        $Tracks = array();
        $i=0;
        foreach ($allEnteries as $el) {
            $pq = pq($el); // Это аналог $ в jQuery            
            //var wich contains info of grabed track. it must be parsed
            $info = $pq->find('> table.eBlock div.eDetails >table>tr>td')->html();

            $track = new GTrack();
            $track->title = $pq->find('.eTitle > a')->html();
            $track->source = $pq->find('.eTitle > a')->attr('href');
            $track = $this->parseInfoCT($track, $info);            
            $track->number = $i++;
            $track->title = htmlspecialchars_decode($track->title);
            $track->source = $track->source;
            $Tracks[] = $track;
        }
 
        return $Tracks;
    }
    
    public function parseTrackCT($filename) {
        //  Yii::import('application.vendors.phpQuery');        
        $file = file_get_contents($filename);
        //&file=http://www66.zippyshare.com/downloadMusic?key=78172530xx
        $reg = '/http:\/\/www(\d*?)\.zippyshare.com\/downloadMusic\?key=(\d*?)xx/';
        if(preg_match($reg, $file, $res)){
            $link = "http://www$res[1].zippyshare.com/v/$res[2]/file.html";
       // $track = new GTrack;
        $track->link = $link; 
        //$track->link2 = SHTML::getZippyPreview($link);        
        $track->preview = $res[0];
        
        return $track;} else return false;
     }

    /**     * ****************  CLUB TONE PARSING  ************************* */
    //set IDs of style and sub style from grabed $styles
    public function setStyleId($Track) {
        // get array of grab styles
        $Styles = explode(",", $Track->styles);
        //var_dump($Styles);
        //if we have seted Styles
        if (isset($Styles[0])) {
            $Track->style_id = $this->getStyleId($Styles[0]);
            //for sub_style
            if (isset($Styles[1])) {
                $Track->subStyle_id = $this->getStyleId($Styles[1]);
            }
        }
        return $Track;
    }
    
 
    /* //get id in $Styles  of $style
      public function getStyleId($style){
      if(!empty($this->Styles)){
      return $this->getStyleId($style, $this->Styles);
      }
      return false;
      }
     */

    //parse info of club tone track and
    public function parseInfoCT(GTrack $Track, $info) {
        //parsing of title and cover        
        //$info = $Track->info;
        ///parsing of general info
        $regexp = '/<img alt="(.*?)" src="(http:\/\/clubtone.net\/.*?\.jpg)"/';
        if (preg_match($regexp, $info, $res)) {
            $Track->title = $res[1];
            $Track->cover = $res[2];
        }

        $regexp = '/<strong>(.*?)<\/strong>\s?(.*?)\s?(?=\<strong>)/s';
        preg_match_All($regexp, $info, $res);

        //$res[1] - вертає назву поля $res[2] - значення
        foreach ($res[0] as $k => $r) {
            if ($res[1][$k] == "Стили:") {
                $Track->styles = strip_tags($res[2][$k]);
                $Track = $this->setStyleId($Track);
            } elseif ($res[1][$k] == "Формат:")
                $Track->bitrate = str_replace("kbps", '', strip_tags($res[2][$k]));
            elseif ($res[1][$k] == "Размер:")
                $Track->size = str_replace("Мб", '', strip_tags($res[2][$k]));
            elseif ($res[1][$k] == "Дата релиза:")
                $Track->date_relize = strip_tags($res[2][$k]);
        }

        return $Track;
    }
    
    

}

?>
