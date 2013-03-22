<?php

class SPHP {

    public static function file_put_var($var, $filename) {
        $textarray = base64_encode(serialize($var));
        $f = fopen($filename, "a+");
        flock($f, LOCK_EX);
        ftruncate($f, 0);
        fwrite($f, $textarray);
        fflush($f);
        flock($f, LOCK_UN);
        fclose($f);
    }

    public static function file_get_var($filename) {
        return unserialize(base64_decode(implode("", file($filename))));
    }

    public static function file_get_cache($filename, $cache_time=3600) {
        $cache_dir = 'protected/data/cache-sphp/';
        $cache_file = $cache_dir . substr(md5($filename), 0, 15) . ".cache";

        if (file_exists($cache_file)) {
            $modif_time = time() - filemtime($cache_file);
        } else {
            $modif_time = $cache_time + 100;
        }
        //если время изменение меньше установленого
        if ($modif_time < $cache_time) {
            //получаем кеш
            //  echo "get cache";
            //$file = file_get_contents($cache_file);
            $file = SPHP::file_get_var($cache_file);
        } else {//иначе кешируем
            $file = file_get_contents($filename);
            //$file= "sd";
            //   echo "   put cache   ";
            // file_put_contents($file, $cache_file);
            SPHP::file_put_var($file, $cache_file);
            // echo error_get_last();
        }
        return $file;
    }

    public static function convert_str_charset($str, $enc = "utf-8") {
        if (strlen($str) == 0) {
            return $str;
        }
        $str_ = @iconv("utf-8", "windows-1251", $str);
        if (in_array(strtolower($enc), array("utf", "utf8", "utf-8", "utf 8", "utf_8"))) {
            if (strlen($str_) == 0) { /* была ошибка при перекодировании, значит исходная строка в windows-1251 */
                return iconv("windows-1251", "utf-8", $str);
            } else { /* начальная строка уже в utf-8 */
                return $str;
            }
        } else {
            if (strlen($str_) == 0) { /* была ошибка при перекодировании, значит исходная строка уже в windows-1251 */
                return $str;
            } else { /* начальная строка в utf-8, возвращаем перекодированную строку */
                return $str_;
            }
        }
    }
    
   public static function url_exists($url) {
    if (@fopen($url, "r")) {
        return true;
    } else {
        return false;
    }
}

public static function url_exists2($url){
                $handle   = curl_init($url);
                if (false === $handle)
                {
                        return false;
                }
                curl_setopt($handle, CURLOPT_HEADER, false);
                curl_setopt($handle, CURLOPT_FAILONERROR, true);  // this works
                curl_setopt($handle, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15") ); // request as if Firefox
                curl_setopt($handle, CURLOPT_NOBODY, true);
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);
                $connectable = curl_exec($handle);
                ##print $connectable;
                curl_close($handle);
                return $connectable;
}


}

?>
