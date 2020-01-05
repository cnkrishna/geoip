<?php
require_once 'vendor/autoload.php';
use MaxMind\Db\Reader;
srand(0);
$reader = new Reader('GeoIP2-City.mmdb');
$count = 50000;
$startTime = microtime(true);
for ($i = 0; $i < $count; ++$i) {
    $ip = long2ip(rand(0, pow(2, 32) - 1));
    $t = $reader->get($ip);
    
    $ipArray = array('latitude' => $t["location"]["latitude"],
                     'longitude' => $t["location"]["longitude"]);

      
  
    echo json_encode($ipArray)."\n";;
    if ($i % 1000 === 0) {
        echo $i . ' ' . $ip . "\n";
        // print_r($t);
    }
}
$endTime = microtime(true);
$duration = $endTime - $startTime;
echo 'Requests per second: ' . $count / $duration . "\n";
