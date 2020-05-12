<?php

namespace Wolf;
use Wolf\NotFoundException;

class Wolf 
{
    
    private static $header = ROOT.'/resources/view/header.php';
    private static $footer = ROOT.'/resources/view/footer.php'; 
    
    public static function loadDevView(string $view, array $key = null, string $ext = "php") 
    {
        
        if (file_exists(ROOT.'/resources/'.$view.'.'.$ext)) {
            include_once ROOT.'/resources/'.$view.'.'.$ext;
        } else {
            NotFoundException::alertMessage($view, $ext);
            die();
        }
    }
    
    public static function loadView(string $view, array $key = null, bool $header_footer = true, string $ext = "php") 
    {
        
        if ($header_footer == true) {
            if (file_exists(self::$header)) {
                include_once self::$header;
            }    
        }
        
        if (file_exists(ROOT.'/resources/view/'.$view.'.'.$ext)) {
            include_once ROOT.'/resources/view/'.$view.'.'.$ext;
        } else {
            NotFoundException::alertMessage($view, $ext);
            die();
        }
        
        if ($header_footer == true) {
            if (file_exists(self::$footer)) {
                include_once self::$footer;
            }
        }
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
    
    public static function loadHeader(string $header) 
    {
        $load = '//'.$_SERVER['HTTP_HOST'].'/'.$header;
        return $load;
    }
    
    public static function loadFooter(string $footer) 
    {
        $load = '//'.$_SERVER['HTTP_HOST'].'/'.$footer;
        return $load;
    }
}
