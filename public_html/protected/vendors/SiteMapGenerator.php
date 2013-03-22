<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteMapGenerator
 *
 * @author Stas
 */
class SiteMapGenerator {

    public static function sitemap_url_gen($url, $lastmod = '', $changefreq = '', $priority = '') {
        // http://petrenco.com/php.php?txt=119
        $search = array('&', '\'', '"', '>', '<');
        $replace = array('&amp;', '&apos;', '&quot;', '&gt;', '&lt;');
        $url = str_replace($search, $replace, $url);
        $lastmod = (empty($lastmod)) ? '' : '
     <lastmod>' . $lastmod . '</lastmod>';
        $changefreq = (empty($changefreq)) ? '' : '
     <changefreq>' . $changefreq . '</changefreq>';
        $priority = (empty($priority)) ? '' : '
     <priority>' . $priority . '</priority>';
        $res = '
   <url>
     <loc>' . $url . '</loc>' . $lastmod . $changefreq . $priority . '
   </url>';
        return $res;
    }
    
}

?>
