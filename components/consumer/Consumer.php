<?php

namespace Component\Consumer;

class Consumer 
{

    private $url;

    public function __construct(string $url) 
    {
        $this->url = $url;
    }

    public function get(string $token = null, bool $decode = false, string $accept = "application/json", string $contentType = "application/json") 
    {
        $header = [
            'Content-Type: ' . $contentType,
            'Accept: ' . $accept,
            'Authorization: Bearer ' . $token
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $res = curl_exec($ch);
        curl_close($ch);
        $decoded = json_decode($res, true);

        if ($res === false) {
            echo curl_error($ch);
            die();
        }

        if ($decode == true) {
            return $decoded;
        } else {
            return $res;
        }
    }

    public function post(array $data, string $token = null, string $accept = "application/json", string $contentType = "application/json") 
    {
        $header = [
            'Content-Type: ' . $contentType,
            'Accept: ' . $accept,
            'Authorization: Bearer ' . $token
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        curl_close($ch);

        if ($res === false) {
            echo curl_error($ch);
            die();
        }

        return $res;
    }

    public function put(array $data, string $token = null, string $accept = "application/json", string $contentType = "application/json") 
    {
        $header = [
            'Content-Type: ' . $contentType,
            'Accept: ' . $accept,
            'Authorization: Bearer ' . $token
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($ch);
        curl_close($ch);

        if ($res === false) {
            echo curl_error($ch);
            die();
        }

        return $res;
    }

    public function delete(string $token = null, string $accept = "application/json", string $contentType = "application/json") 
    {
        $header = [
            'Content-Type: ' . $contentType,
            'Accept: ' . $accept,
            'Authorization: Bearer ' . $token
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        $res = curl_exec($ch);
        curl_close($ch);

        if ($res === false) {
            echo curl_error($ch);
            die();
        }

        return $res;
    }

}
