<?php

// get the config
require_once('app/config.php');
// get the stats model
require_once('app/StatsModel.php');
// new up the stats model
$StatsModel = new StatsModel;
$stats = $StatsModel->getAll();
// send the responce as JSON 
header("HTTP/1.1 200 OK");
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");

$json_responce = json_encode($stats);
echo $json_responce;
