<?php

$filename = 'http://cs6223.userapi.com/u22869121/audio/01b4cf0bd25c.mp3';

// файл, который мы проверяем

function url_exists($url) {
    if (@fopen($url, "r")) {
        return true;
    } else {
        return false;
    }
}

function file_download($filename, $mimetype='application/octet-stream') {
    if ($f = @fopen($filename, "r")) {

        //всі заголовки перенаправляємо із vk

        foreach (get_headers($filename) as $header)
            header($header, true);
        
        header('Content-type: '.$mimetype, true);
        header('Content-Disposition: attachment; filename="fname.mp3"');
        //fpassthru($f);
       
        header('Location: '.$filename, true);
        
        // Закрываем файл
        fclose($f);
    } else {
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        header('Status: 404 Not Found');
    }
}

file_download($filename);
//echo "asd";
?>

