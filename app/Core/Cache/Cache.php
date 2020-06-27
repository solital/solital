<?php

namespace Solital\Core\Cache;
use Psr\SimpleCache\CacheInterface;

class Cache implements CacheInterface
{
    private $value;
    private $ttl;

    public function __construct()
    {
        $this->value = dirname(__DIR__)."/Cache/tmp/";
        
    }

    public function get($key, $default = null)
    {
        $file_in_cache = $this->value.$key.".cache.php";

        if (file_exists($file_in_cache)) {
            $file_cache = file_get_contents($file_in_cache);
            $decoded = json_decode($file_cache, true);

            if ($decoded['expire_at'] < time() && $decoded['expire_at'] == null) {
                $this->delete($key);
            }

            print_r($decoded);
            exit;
        }
    }

    public function set($key, $value, $ttl = null)
    {
        $file_for_cache = $this->value.$key.".cache.php";

        $expire = null;

        if ($ttl instanceof DateInterval) {
            $expire = (new DateTime('now'))->add($ttl)->getTimeStamp();
        } else if (is_int($ttl)) {
            $expire = time() + $ttl;
        }

        $value['expire_at'] = $expire;
        $page = json_encode($value);

        $handle = fopen($file_for_cache, 'w');
        fwrite($handle, $page);
        fclose($handle);
    }

    public function delete($key)
    {
        $file_for_cache = $this->value.$key.".cache.php";

        if (file_exists($file_for_cache)) {
            unlink($file_for_cache);
        }
    }

    public function clear()
    {
        if(is_dir($$this->value)) {
            $directory = dir($this->value);

            while($file = $directory->read()) {
                if(($file != '.') && ($file != '..')) {
                    unlink($this->value.$file);
                }
            }
        
            $directory->close();
        }
    }

    public function has($key)
    {
        $file_in_cache = $this->value.$key.".cache.php";

        if (file_exists($file_in_cache)) {
            return true;
        } else {
            return false;
        }
    }

    public function getMultiple($keys, $default = null) {}
    public function setMultiple($values, $ttl = null) {}
    public function deleteMultiple($keys) {}
}