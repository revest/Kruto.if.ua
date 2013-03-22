<?php
include 'phpQuery.php';
class VK {

//$cookie = "remixsid=$sid;";
    private static $email = "mega@kruto.if.ua";
    private static $pass = "krutofb2584";

    public static function get($link, $cookie) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);

        $otvet = curl_exec($ch);
        curl_close($ch);
       // echo "sadf", file_get_contents("http://m.vk.com/audio");
        return $otvet;
    }

    public static function get2($link, $cookie) {
        // Создаем поток
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' =>
                'User-Agent: Mozilla/5.0 (Windows NT 6.2; WOW64; rv:15.0) Gecko/20100101 Firefox/15.0.1\r\n' .
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n' .
                'Accept-Language: ru-ru,ru;q=0.8,en-us;q=0.5,en;q=0.3\r\n' .
                'Accept-Encoding: gzip, deflate\r\n' .
                'Connection: keep-alive\r\n' .
                'Cookie: remixlang=0; remixchk=5; remixflash=11.4.402; remixdt=-3600; remixseenads=2; vklang=1; remixno_chrome_bar=1; audio_vol=100; remixmdevice=1366/768/-/!!-!-; ' . VK::getSIDcache() . '\r\n'
            )
        );
        $context = stream_context_create($opts);
        $file = fopen('http://vk.com', 'r');
       echo $res = stream_get_contents($file);
        fclose($file);
        return $res;
    }

    public static function getSID($mail=null, $pass=null) {
        if (!isset($mail) || !isset($pass)) {
            $mail = Vk::$email;
            $pass = VK::$pass;
        }
        $headers = get_headers('http://login.vk.com/?act=login&email=' . urlencode($mail) . '&pass=' . urlencode($pass));

        foreach ($headers as $header)
            if (preg_match("/Set-Cookie: (remixsid=.*?);/", $header, $c))
                $remixid = $c[1];
        // var_dump($res);
        return $remixid;
    }

    public static function getSIDcache($mai=null, $pass=null) {

        $id = "sid";

       
       
            // устанавливаем значение $value заново, т.к. оно не найдено в кэше,
            $value = VK::getSID();
            // и сохраняем его в кэше для дальнейшего использования:
       //     Yii::app()->cache->set($id, $value, 60 * 60 * 4);
       

        return $value;
    }

    public static function searchTrack($query) {

        $query = str_replace(" ", "+", urlencode($query));
        $link = 'http://m.vk.com/audio?act=search&q=' . $query . '&cut=100';
        // $id = "searched";
        //  $value = Yii::app()->cache->get($id);
        //  if ($value === false) {
        $file = VK::get($link, VK::getSIDcache());

        $a = strpos($file, '<body');
        $b = strpos($file, '</body>');
        $file = substr($file, $a, $b - $a + 7);

        $doc = phpQuery::newDocument($file);
        $all = $doc->find('.audio_info');
        $Res = array();
        foreach ($all as $k => $el) {
            $pq = pq($el);
            $t = array();
            $t['id'] = $k;
            $t['duration'] = $pq->find('.dur span')->html();
            $t['title'] = $pq->find('.artist')->html() . " - " . $pq->find('.title')->html();
            $t['link'] = $pq->find('input[type=hidden]')->attr('value');
            $t['styles'] = "";
            $t = (object) $t;
            if (!in_array($t, $Res))
                $Res[] = $t;
            unset($t);
        }

        // устанавливаем значение $value заново, т.к. оно не найдено в кэше,
        //  $value = $Res;
        // и сохраняем его в кэше для дальнейшего использования:
        //Yii::app()->cache->set($id, $value, 60 * 60 * 4);
        // }

        Return $Res;
    }

}

var_dump(VK::searchTrack('tank1st'));
?>
