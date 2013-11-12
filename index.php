<?php
require_once 'metier/Metier.php';
//require_once 'dao/Dao.php';

// ip : 192.168.2.1
// port : 100
// chaine renvoyée par Arduino {"id":"192.168.2.3","desc":"duemilanove","mac":"90:A2:DA:00:1D:A7","port":102}

ini_set("max_execution_time", 0);

/*
$recordeur  = new Recorder();
$dao = new Dao($recordeur);

$dao->init();
//$this->serveur->run();
$recordeur->start(); //Will start a new Thread to execute the implemented run method 

echo "Je m'affiche alors que run est dans une boucle infinie\n";*/

$metier= new Metier();

$arduinos=$metier->getArduinos();
echo "J'ai ajouté l'arduino : ";
foreach ( $arduinos as $a) {
        echo $a->toString()."\n";
    }
 
 $reponse=$metier->pinRead("1", "1", "13", "b");
  


?>
