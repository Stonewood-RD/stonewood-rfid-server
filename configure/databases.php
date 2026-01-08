<?php

global $_GLOBALS;

$dataAccessorConstructions = [];

$dataAccessorConstructions = array_merge($dataAccessorConstructions,  
    $_GLOBALS["STONEWOOD_LIB_DATA_ACCESS_CONSTRUCTIONS"], $_GLOBALS["CONEXION_RFID_CONSTRUCTIONS"]);

$_GLOBALS["DataAccessManager_dataAccessorConstructions"] = $dataAccessorConstructions;

$dataAccessorModifierFile = dirname(__DIR__)."/.secret/dataAccessorModifiers.php";

if (file_exists($dataAccessorModifierFile))
{
    require_once($dataAccessorModifierFile);
}
