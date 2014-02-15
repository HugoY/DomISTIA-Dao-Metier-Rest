<?php
//$target = 'C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\DomISTIA-Dao-Metier-Rest\rest';

//$link = 'C:\Program Files (x86)\EasyPHP-DevServer-13.1VC11\data\localweb\server-restServer';

/*if(!file_exists($link)){
  symlink($target, $link);
}*/

// include Yii bootstrap file
defined('YII_DEBUG') or define('YII_DEBUG', true);
require_once(dirname(__FILE__) . '/../framework/yii.php');
$config = dirname(__FILE__) . '/protected/config/main.php';
// create a Web application instance and run
Yii::createWebApplication($config)->run();
