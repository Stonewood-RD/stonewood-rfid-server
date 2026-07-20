<?php

// Cargar autoloader si no está cargado (necesario para Dotenv)
if (!class_exists('Dotenv\Dotenv')) {
    $autoloadPath = dirname(__DIR__) . '/vendor/autoload.php';
    if (file_exists($autoloadPath)) {
        require_once $autoloadPath;
    }
}

use Dotenv\Dotenv;

// Cargar variables de entorno desde archivo .env
// El archivo .env está en la raíz de la carpeta stonewood-app/
// Desde stonewood-app/.secret/env.php necesitamos subir 1 nivel para llegar a la raíz de stonewood-app
// stonewood-app/.secret/env.php -> stonewood-app/.secret -> stonewood-app (raíz de stonewood-app)
$envPath = dirname(__DIR__.'../');
$envFile = $envPath . '/.env';

// Verificar que el archivo .env existe
if (!file_exists($envFile)) {
    error_log("ERROR: No se encontró el archivo .env en: $envFile");
    error_log("Buscando en: $envPath");
    throw new Exception("El archivo .env no existe en: $envFile. Por favor, créalo en la raíz de stonewood-app/");
}

try {
    $dotenv = Dotenv::createImmutable($envPath);
    $dotenv->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {
    error_log("ERROR al cargar .env: " . $e->getMessage());
    throw new Exception("Error al cargar el archivo .env: " . $e->getMessage());
} catch (\Exception $e) {
    error_log("ERROR inesperado al cargar .env: " . $e->getMessage());
    throw $e;
}



//---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------
//--- 
//--- RFID DB Config
//--- 
//---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------
global $_GLOBALS;

if (!$_GLOBALS)
{
	$_GLOBALS = [];
}


$rfidDBHost		= $_ENV['RFID_DB_HOST'];
$rfidDBUser     = $_ENV['RFID_DB_USER'];
$rfidDBPassword = $_ENV['RFID_DB_PASSWORD'];
//base de datos de produccion
//$rfidDBName	    = "sesrfid2";
//base de dato de prueba
$rfidDBName	    = $_ENV['RFID_DB_NAME'];
$rfidConnectionString = "mysql:host=$rfidDBHost;dbname=$rfidDBName";
$rfidConnectionOptions = [
    PDO::ATTR_PERSISTENT => true, 
    // PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION	
];

$_GLOBALS["DataAccessManager_DB_CONFIG"]["rfidDB"] = [
    "connectionString"  => $rfidConnectionString,
    "userName"          => $rfidDBUser,
    "password"          => $rfidDBPassword,
	"connectionOptions" => $rfidConnectionOptions,
];





//---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------
//--- 
//---  Test Old Stone DB Config
//--- 
//---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------

$pruebaPDOUser 			   = $_ENV['OLD_STONE_DB_USER'];
$pruebaPDOPassword         = $_ENV['OLD_STONE_DB_PASSWORD'];


//$pruebaDatabaseName	   		= 'StwdDataBase';
$pruebaDatabaseName	   		= $_ENV['OLD_STONE_DB_NAME'];
//$pruebaDatabaseName	   		= 'StwdDataBase_Prueba_G_de_Oleo';
$pruebaServerAddress       = $_ENV['OLD_STONE_DB_SERVER'];
$pruebaConnectionString    = "sqlsrv:Server=$pruebaServerAddress;Database=$pruebaDatabaseName;Encrypt=false;TrustServerCertificate=True;"; 


$pruebaPdoConnectionOptions = [
    PDO::ATTR_PERSISTENT => true, 
    // PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION	
];


$_GLOBALS["DataAccessManager_DB_CONFIG"]["oldStoneDB"] = [
    "connectionString"  => $pruebaConnectionString,
    "userName"          => $pruebaPDOUser,
    "password"          => $pruebaPDOPassword,
	"connectionOptions" => $pruebaPdoConnectionOptions,
];


//---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------
//--- 
//--- Sqlite Config APP
//--- 
//---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------

$db_path = "sqlite:".dirname(__FILE__)."/AppStonewood-Production.db";

$_GLOBALS["db_path"] = $db_path;
$GLOBALS["db_path"]  = $db_path;

$_GLOBALS["DataAccessManager_DB_CONFIG"]["db"] = [
  "connectionString"  => $pruebaConnectionString,
    "userName"          => $pruebaPDOUser,
    "password"          => $pruebaPDOPassword,
	"connectionOptions" => $pruebaPdoConnectionOptions,
];

$_GLOBALS["DataAccessManager_DB_CONFIG"]["appDB"] = [
    "connectionString"  => $pruebaConnectionString,
    "userName"          => $pruebaPDOUser,
    "password"          => $pruebaPDOPassword,
	"connectionOptions" => $pruebaPdoConnectionOptions,
];


//---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------
//--- 
//--- Sqlite Config RFIDV2
//--- 
//---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------

$db_path = "sqlite:".dirname(__FILE__)."/RFID-Production.db";

$_GLOBALS["db_path"] = $db_path;
$GLOBALS["db_path"]  = $db_path;

$_GLOBALS["DataAccessManager_DB_CONFIG"]["rfid_v_2"] = [
    "connectionString"  => $rfidConnectionString,
    "userName"          => $rfidDBUser,
    "password"          => $rfidDBPassword,
	"connectionOptions" => $rfidConnectionOptions,
];

//---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------
//--- 
//--- Sqlite Config RAWRFID
//--- 
//---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------

$db_path = "sqlite:".dirname(__FILE__)."/RAW-rfidDB.db";

$_GLOBALS["db_path"] = $db_path;
$GLOBALS["db_path"]  = $db_path;

$_GLOBALS["DataAccessManager_DB_CONFIG"]["raw_rfid_db"] = [
    "connectionString"  => $rfidConnectionString,
    "userName"          => $rfidDBUser,
    "password"          => $rfidDBPassword,
	"connectionOptions" => $rfidConnectionOptions,
];



 $_GLOBALS["AVERIAS_UPLOAD_PATH"] = $_SERVER["DOCUMENT_ROOT"] . '/public/uploads/averias/';
 $_GLOBALS["CONTENEDORES_UPLOAD_PATH"] = $_SERVER["DOCUMENT_ROOT"] . '/public/uploads/contenedores/';




//$_GLOBALS["REPORT_VEHICULO_EN_PUNTO_URL"] = "http://nginx-web/vehiculoEnPunto/process.php?token=GTK123456";
$_GLOBALS["REPORT_VEHICULO_EN_PUNTO_URL"] = "http://app.stonewood.local/vehiculoEnPunto/process.php?token=GTK123456";