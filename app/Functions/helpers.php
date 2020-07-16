<?php

use Solital\Core\Http\Uri;
use Solital\Core\Http\Request;
use Solital\Core\Http\Response;
use Solital\Core\Http\UploadedFile;
use Solital\Core\Http\ServerRequest;
use Solital\Core\Course\Course as Course;

/**
 * @param string|null $name
 * @param string|array|null $parameters
 * @param array|null $getParams
 * @return \Solital\Http\Uri
 * @throws \InvalidArgumentException
 */
function url(?string $name = null, $parameters = null, ?array $getParams = null): Uri
{
    return Course::getUri($name, $parameters, $getParams);
}

/**
 * @return \Solital\Http\Response
 */
function response(): Response
{
    return Course::response();
}

/**
 * @return \Solital\Http\Request
 */
function request(): Request
{
    return Course::request();
}

/**
 * Get input class
 * @param string|null $index Parameter index name
 * @param string|null $defaultValue Default return value
 * @param array ...$methods Default methods
 * @return \Solital\Http\Input\InputHandler|array|string|null
 */
function input($index = null, $defaultValue = null, ...$methods)
{
    if ($index !== null) {
        return request()->getInputHandler()->value($index, $defaultValue, ...$methods);
    }

    return request()->getInputHandler();
}

/**
 * Upload a file
 * @param string
 */
function uploadFile($file): UploadedFile
{
    $upload = new UploadedFile($file);
    return $upload;
}

/**
 * Creates an instance of the ServerRequest class
 * @param array $headers
 * @param mixed $protocol
 * @return ServerRequest
 */
function serverRequest(array $headers = null, $protocol = null): ServerRequest
{
    if (request()->getParamsInput()) {
        $queryParams = request()->getParamsInput();
    } else {
        $queryParams = [];
    }

    $method = request()->getMethod();
    $uri = request()->getUri()->getHost();
    $body = "php://input";
    $serverParams = $_SERVER;
    $cookieParams = $_COOKIE; 
    #$queryParams = request()->getParamsInput();
    $uploadedFiles = $_FILES;
    $headers = [];
    $protocol = '1.1';

    $server = new ServerRequest($method, $uri, $body, $serverParams, 
    $cookieParams, $queryParams, $uploadedFiles, $headers, $protocol);
    
    return $server;
}

/**
 * @param string $url
 * @param int|null $code
 */
function redirect(string $url, ?int $code = null): void
{
    if ($code !== null) {
        response()->httpCode($code);
    }

    response()->redirect($url);
    exit;
}

/**
 * Get current csrf-token
 * @return string|null
 */
function csrf_token(): ?string
{
    $baseVerifier = Course::router()->getCsrfVerifier();
    if ($baseVerifier !== null) {
        return $baseVerifier->getTokenProvider()->getToken();
    }

    return null;
}

/**
 * Show result pre-formatted
 * @param mixed $value
 */
function pre($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

/**
 * @param $value
 * @return string
 */
function pass_hash(string $value, int $cost = 10): string
{
    return password_hash($value, PASSWORD_DEFAULT, ["cost" => $cost]);
}

/**
 * @param $value
 * @param string $hash
 * @return bool
 */
function pass_verify($value, string $hash): bool
{
    if (password_verify($value, $hash)) {
        return true;
    } else {
        return false;
    }
}