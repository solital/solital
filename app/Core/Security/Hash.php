<?php

namespace Solital\Core\Security;

class Hash
{
    /**
     * @var string
     */
    private static $decoded;

    /**
     * Generates an encrypted key
     * @param string $value
     * @param string $time
     */
    public static function encrypt(string $value, string $time = '+1 hour')
    {
        $date = new \DateTime(date('Y-m-d H:i'));
        $date->modify($time);
        $res = $date->format('Y-m-d H:i');
        
        $data = [
            'value' => $value,
            'expire_at' => $res
        ];

        $key = openssl_encrypt(json_encode($data), "AES-128-CBC", SECRET, 0, SECRET_IV);
        $key = base64_encode($key);

        return $key;
    }

    /**
     * Decrypts a key
     * @param string $key
     */
    public static function decrypt(string $key)
    {
        $decode = base64_decode($key);
        $decode = openssl_decrypt($decode, "AES-128-CBC", SECRET, 0, SECRET_IV);
        
        self::$decoded = $decode;
        
        return __CLASS__;
    }

    /**
     * Checks the value of the encrypted key
     */
    public static function value()
    {
        $json = json_decode(self::$decoded, true);

        return $json['value'];
    }

    /**
     * Checks if the key is still valid
     */
    public static function isValid()
    {
        $json = json_decode(self::$decoded, true);

        if ($json['expire_at'] < date("Y-m-d H:i:s")) {
            return false;
        } else {
            return true;
        }
    }
}
