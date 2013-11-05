<?php
require_once 'dao/Recorder.php';
require_once 'dao/Dao.php';

// ip : 192.168.2.1
// port : 100
// chaine renvoyée par Arduino {"id":"192.168.2.3","desc":"duemilanove","mac":"90:A2:DA:00:1D:A7","port":102}

ini_set("max_execution_time",0);

$dao = new Dao();

$dao->init();

echo "Je m'affiche alors que run est dans une boucle infinie";
?>
