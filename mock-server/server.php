<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: content-type");

function purebell($min,$max,$std_deviation,$step=1) {
  $rand1 = (float)mt_rand()/(float)mt_getrandmax();
  $rand2 = (float)mt_rand()/(float)mt_getrandmax();
  $gaussian_number = sqrt(-2 * log($rand1)) * cos(2 * M_PI * $rand2);
  $mean = ($max + $min) / 2;
  $random_number = ($gaussian_number * $std_deviation) + $mean;
  $random_number = round($random_number / $step) * $step;
  if($random_number < $min || $random_number > $max) {
    $random_number = purebell($min, $max,$std_deviation);
  }
  return $random_number;
}

$mock = [
  'teamname' => '隊伍 1',
  'under_attack' => (rand(0, 1) === 1 ? true : false),
  'ddos' => (rand(0, 1) === 1 ? purebell(0, 100, 20) : 0),
  'score' => purebell(0, 100, 20),
  'alive_web' => (rand(0, 1) === 1 ? true : false),
  'alive_erp' => (rand(0, 1) === 1 ? true : false),
  'alive_sslvpn' => (rand(0, 1) === 1 ? true : false),
  'bandwidth' => purebell(0, 100, 20),
  'energy' => purebell(0, 100, 20),
  'wifi' => purebell(0, 100, 20)
];

$mock2 = [
  'teamname' => '隊伍 1',
  'under_attack' => true,
  'ddos' => true,
  'score' => purebell(0, 100, 20),
  'alive_web' => false,
  'alive_erp' => false,
  'alive_sslvpn' => false,
  'bandwidth' => purebell(0, 100, 20),
  'energy' => purebell(0, 100, 20),
  'wifi' => purebell(0, 100, 20)
];

echo json_encode($mock);
