<?php

$autoLoadPath = dirname($_SERVER["DOCUMENT_ROOT"])."/vendor/autoload.php";
require_once($autoLoadPath);

doOrCatchAndReport(function() {
    $page = new ImpinjSpeedwayConnectRFIDEndpointPage();
    global $_GTK_SUPER_GLOBALS;
    echo $page->render(...$_GTK_SUPER_GLOBALS);
});
