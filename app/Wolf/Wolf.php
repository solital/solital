<?php

namespace Solital\Wolf;
use Solital\Wolf\NotFoundException;

class Wolf 
{
    
    private static $header = ROOT.'/resources/view/header.php';
    private static $footer = ROOT.'/resources/view/footer.php'; 
    private static $view;
    private static $ext;
    private static $data = [];
    
    public static function loadView(string $view, array $data = null, string $ext = "php") 
    {
        $file = ROOT.'/resources/view/'.$view.'.'.$ext;
        
        if (isset($data)) {
            extract($data, EXTR_SKIP);
        }

        if (file_exists($file)) {
            include_once $file;
        } else {
            NotFoundException::alertMessage($view, $ext);
        }

        return __CLASS__;
    }

    public static function loadFile(string $asset) 
    {
        $css = '//'.$_SERVER['HTTP_HOST'].'/'.$asset;
        return $css;
    }
    
    public static function loadCss(string $asset) 
    {
        $css = '//'.$_SERVER['HTTP_HOST'].'/assets/_css/'.$asset;
        return $css;
    }
    
    public static function loadJs(string $asset) 
    {
        $js = '//'.$_SERVER['HTTP_HOST'].'/assets/_js/'.$asset;
        return $js;
    }
    
    public static function loadImg(string $asset) 
    {
        $img = '//'.$_SERVER['HTTP_HOST'].'/assets/_img/'.$asset;
        return $img;
    }

    public static function cache(string $file_name)
    {

        ob_start();

        $start = microtime(true);

        if (!is_dir(ROOT. "/resources/view/cache/")) {
            mkdir(ROOT."/resources/view/cache/", 0777, true);
        }

        $page = explode(".", $file_name);
        $cache_dir = ROOT."/resources/view/cache/".$page[0].".cache.php";
        
        $page_view = "";
        
        if (file_exists(self::$header)) {
            $page_view .= file_get_contents(self::$header);
        }
        
        $page_view .= file_get_contents(ROOT. "/resources/view/".$file_name);
        
        if (file_exists(self::$footer)) {
            $page_view .= file_get_contents(self::$footer);
        }
        
        if (file_exists($cache_dir) && filemtime($cache_dir) > time()-20) {
            echo 'from cache';
            readfile($cache_dir);
            #include_once($cache_dir);
            exit;
        }
        
        
        #$res = ob_get_contents();
        #var_dump($res);
        $handle = fopen($cache_dir, 'w');
        fwrite($handle, ob_get_contents());
        fclose($handle);
        
        ob_end_flush();
        
        $end = microtime(true);
        echo round($end-$start, 4);
        
    }
}
