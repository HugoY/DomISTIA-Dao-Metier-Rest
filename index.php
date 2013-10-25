<?php
// ip : 192.168.2.1
// port : 100
// chaine renvoyer par Arduino {"id":"192.168.2.3","desc":"duemilanove","mac":"90:A2:DA:00:1D:A7","port":102}
require_once 'dao/Recorder.php';
$adress = "172.20.82.103";
$port = 10000;
ini_set("max_execution_time",0);
$serveur  = new Recorder();
$serveur->init($adress, $port);
$serveur->run();

echo "Je m'affiche alors que run est dans une boucle infinie";
?>
