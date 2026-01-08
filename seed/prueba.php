<?php

$autoLoadPath = dirname(__DIR__)."/vendor/autoload.php";
require_once($autoLoadPath);


$ipAddress = "192.168.20.200";
$antena = "1";
$subPuntoDeLectura = DataAccessManager::get("rfid_access_point")->getSubPuntoDeLectura($ipAddress, $antena);


//$puntoDeLectura = $subPuntoDeLectura->puntoDeLectura;
print_r($subPuntoDeLectura);
