<?php

global $_GLOBALS;

if (!is_array($_GLOBALS))
{
    $_GLOBALS = [];
}

$_GLOBALS["ENV_FILE_PATH"] = (dirname(__FILE__, 1))."/../.secret/env.php"; 
$_GLOBALS["GTK_REPO_ROOT"] = (dirname(__FILE__, 1))."/../.secret/env.php";

date_default_timezone_set('America/Santo_Domingo');


global $_GTK_SUPER_GLOBALS;

if (!isset($_GTK_SUPER_GLOBALS))
{   
    /*
    $_GTK_SUPER_GLOBALS = [
        'get'     => $_GET     ?? [],
        'post'    => $_POST    ?? [],
        'server'  => $_SERVER  ?? [],
        'cookie'  => $_COOKIE  ?? [],
        'session' => $_SESSION ?? [],
        'files'   => $_FILES   ?? [],
        'env'     => $_ENV     ?? [],
    ];
    */

    $_GTK_SUPER_GLOBALS = [
        $_GET     ?? [],
        $_POST    ?? [],
        $_SERVER  ?? [],
        $_COOKIE  ?? [],
        $_SESSION ?? [],
        $_FILES   ?? [],
        $_ENV     ?? [],
    ];

    // $myObject->render(...$_GTK_SUPER_GLOBALS);
}


if (!function_exists('gtk_log'))
{
    function gtk_log($toLog)
    {
        error_log($toLog);
    }
}
