<?php

// include Yii bootstrap file
defined('YII_DEBUG') or define('YII_DEBUG',true);
require_once(dirname(__FILE__) . '/../framework/yii.php');
$config = dirname(__FILE__) . '/protected/config/main.php';

// Couche métier
/*if (apc_exists('app:couche_metier') !== false) {
    $metier = apc_get('app:couche_metier');
} else {
    try {
        $metier = new Metier();
    } catch (DomotiqueException $e) {
        echo"L'erreur suivante s'est produite : " . $e->getMessage();
        exit();
    }
    apc_store('app:couche_metier', $metier);
}*/


// create a Web application instance and run
Yii::createWebApplication($config)->run();
