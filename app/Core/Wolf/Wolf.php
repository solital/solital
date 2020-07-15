<?php

namespace Solital\Core\Wolf;
use Solital\Core\Wolf\WolfCache;
use Solital\Core\Exceptions\NotFoundException;

class Wolf extends WolfCache
{
    /**
     * @param string $view
     * @param array $data
     * @param string $ext
     */
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

    /**
     * @param string @asset
     */
    public static function loadFile(string $asset)
    {
        $css = '//'.$_SERVER['HTTP_HOST'].'/'.$asset;
        return $css;
    }
    
    /**
     * @param string @asset
     */
    public static function loadCss(string $asset) 
    {
        $css = '//'.$_SERVER['HTTP_HOST'].'/assets/_css/'.$asset;
        return $css;
    }
    
    /**
     * @param string @asset
     */
    public static function loadJs(string $asset) 
    {
        $js = '//'.$_SERVER['HTTP_HOST'].'/assets/_js/'.$asset;
        return $js;
    }
    
    /**
     * @param string @asset
     */
    public static function loadImg(string $asset) 
    {
        $img = '//'.$_SERVER['HTTP_HOST'].'/assets/_img/'.$asset;
        return $img;
    }
}
