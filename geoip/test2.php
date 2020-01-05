<?php
require_once 'vendor/autoload.php';

use MaxMind\Db\Reader;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET”);
header("Access-Control-Max-Age: 3600");


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$requestMethod = $_SERVER["REQUEST_METHOD"];



if ($uri[1] !== 'address') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

// the user id is, of course, optional and must be a number:
if (isset($uri[2])) {
    $ipAddress = $uri[2];
}

$ipAddress = '24.0.168.238';
$databaseFile = 'GeoIP2-City.mmdb';

$reader = new Reader($databaseFile);

print_r($reader->get($ipAddress))

$response['body']=json_encode($reader->get($ipAddress));
