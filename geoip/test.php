<?php
require_once 'vendor/autoload.php';

use MaxMind\Db\Reader;


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$requestMethod = $_SERVER["REQUEST_METHOD"];

// everything else results in a 404 Not Found
if ($uri[1] !== 'address') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$ipAddress = '24.0.168.236';

// the user id is, of course, optional and must be a number:
if (isset($uri[2])) {
    $ipAddress = $uri[2];
}



$databaseFile = 'GeoIP2-City.mmdb';

$reader = new Reader($databaseFile);

// get returns just the record for the IP address
//print_r($reader->get($ipAddress));

// getWithPrefixLen returns an array containing the record and the
// associated prefix length for that record.
//print_r($reader->getWithPrefixLen($ipAddress));

$t = $reader->get($ipAddress);
    
$ipArray = array('latitude' => $t["location"]["latitude"],'longitude' => $t["location"]["longitude"]);


//$response['body']=$ipArray;
header('Content-Type: application/json');
echo json_encode($ipArray);


