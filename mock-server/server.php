<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

$mock = [
  'teamname' => '隊伍 1',
  'under_attack' => (rand(0, 1) === 1 ? true : false),
  'ddos' => (rand(0, 1) === 1 ? rand(0, 100) : 0),
  'score' => rand(0, 100),
  'alive_web' => (rand(0, 1) === 1 ? true : false),
  'alive_erp' => (rand(0, 1) === 1 ? true : false),
  'alive_sslvpn' => (rand(0, 1) === 1 ? true : false),
  'bandwidth' => rand(0, 100),
  'energy' => rand(0, 100),
  'wifi' => rand(0, 100)
];

echo json_encode($mock);