<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: content-type");

function nrand($mean, $sd){
    $x = mt_rand()/mt_getrandmax();
    $y = mt_rand()/mt_getrandmax();
    return (int)(sqrt(-2*log($x))*cos(2*pi()*$y)*$sd + $mean);
}

$mock = [
  'teamname' => '隊伍 1',
  'under_attack' => (rand(0, 1) === 1 ? true : false),
  'ddos' => (rand(0, 1) === 1 ? nrand(50, 20) : 0),
  'score' => nrand(50,20),
  'alive_web' => (rand(0, 1) === 1 ? true : false),
  'alive_erp' => (rand(0, 1) === 1 ? true : false),
  'alive_sslvpn' => (rand(0, 1) === 1 ? true : false),
  'bandwidth' => nrand(500, 300),
  'energy' => nrand(500, 200),
  'wifi' => nrand(25, 10)
];

$mock2 = [
  'teamname' => '隊伍 1',
  'under_attack' => true,
  'ddos' => true,
  'score' => nrand(50,20),
  'alive_web' => false,
  'alive_erp' => false,
  'alive_sslvpn' => false,
  'bandwidth' => nrand(50,20),
  'energy' => nrand(50,20),
  'wifi' => nrand(50,20)
];

echo json_encode($mock);
