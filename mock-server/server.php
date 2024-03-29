<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: content-type");

function nrand($mean, $sd) {
    $x = mt_rand()/mt_getrandmax();
    $y = mt_rand()/mt_getrandmax();
    return (int)(sqrt(-2*log($x))*cos(2*pi()*$y)*$sd + $mean);
}

$mock = [
  'teamname' => 'Team Name',
  'under_attack' => (rand(0, 1) === 1 ? true : false),
  'ddos' => (rand(0, 1) === 1 ? nrand(50, 20) : 0),
  'score' => nrand(50,20),
  'alive_web' => (rand(0, 1) === 1 ? true : false),
  'alive_erp' => (rand(0, 1) === 1 ? true : false),
  'alive_sslvpn' => (rand(0, 1) === 1 ? true : false),
  'bandwidth' => nrand(50 * 1000000, 1 * 1000000),
  'energy' => nrand(50, 2),
  'wifi' => nrand(2, 0)
];

echo json_encode($mock);
