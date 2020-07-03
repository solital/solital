<?php

namespace Solital\Core\Wolf;
use Solital\Core\Wolf\Wolf;
use Solital\Core\Wolf\WolfCache;
use Solital\Core\Exceptions\NotFoundException;


class Wolf extends WolfCache
{
    
    private static $header = ROOT.'/resources/view/header.php';
    private static $footer = ROOT.'/resources/view/footer.php';
    private static $view;
    private static $ext;
    private static $data;

    public static function loadView(string $view, array $data = null, string $ext = "php") 
    {
        $file = ROOT.'/resources/view/'.$view.'.'.$ext;

        if (strpos($view, "/")) {
            $file = ROOT.'/resources/'.$view.'.'.$ext;
        }

        self::$file_cache = self::$cache_dir.$view."-".date('Ymd')."-".self::$time.".cache.php";
        
        if (isset($data)) {
            extract($data, EXTR_SKIP);
        }

        if (file_exists(self::$file_cache)) {
            include_once self::$file_cache;
            exit;
        }
        
        if (file_exists($file)) {
            if (self::$time != null) {
                ob_start();
            }

            include $file;
            
            if (self::$time != null) {
                $res = ob_get_contents();
                ob_flush();
                file_put_contents(self::$file_cache, $res);
            }
        } else {
            NotFoundException::WolfNotFound($view, $ext);
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
}
