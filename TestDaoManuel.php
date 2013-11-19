<?php
require_once 'metier/Metier.php';
//require_once 'dao/Dao.php';

// ip : 192.168.2.1
// port : 100
// chaine renvoyée par Arduino {"id":"192.168.2.3","desc":"duemilanove","mac":"90:A2:DA:00:1D:A7","port":102}

ini_set("max_execution_time", 0);



$metier= new Metier();
while(count($metier->getArduinos())==0);
$arduinos=$metier->getArduinos();

 while(true){
$reponse=$metier->pinRead("1", "192.168.2.3", "9", "b"); //{"id":"2","ac":"pw","pa":{"pin":"7","mod":"b","val":"1"}}

var_dump($reponse);
echo "La réponse : ".$reponse->getJson()."\n";
 }

?>
