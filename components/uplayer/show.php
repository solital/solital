<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'vendor/autoload.php';

use Source\Upload\Upload as Upload;

$up = new Upload('Images');
$res = $up->uploadFile('arquivos', ['png', 'jpg']);

var_dump($res);