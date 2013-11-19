<?php

require_once 'dao/Recorder.php';
require_once 'dao/Dao.php';
require_once 'entities/Commande.php';

// ip : 192.168.2.1
// port : 100
// chaine renvoyée par Arduino {"id":"192.168.2.3","desc":"duemilanove","mac":"90:A2:DA:00:1D:A7","port":102}

ini_set("max_execution_time", 0);


try {
    $recordeur = new Recorder();
    $dao = new Dao($recordeur);
    $dao->init();
//$this->serveur->run();
    $recordeur->start(); //Will start a new Thread to execute the implemented run method 
} catch (DomotiqueException $e) {
    echo "DomotiqueException " . $e->getMessage();
}
echo "Je m'affiche alors que run est dans une boucle infinie\n";

while (true) {
    sleep(1);
    if (count($dao->getArduinos()) != 0) {
        echo "Une arduino c'est enregistré, on lui envoi un message\n";
        $commandes = new Commande();
        $commandes->initWithIdActionParametres("1", "cl", array("pin" => "9", "dur" => "100", "nb" => "10"));
        echo "La commande envoyée est : \n";
        var_dump($commandes->toJSON());
        //var_dump($dao->getArduinos());
        $tableauArduinos = $dao->getArduinos();
        $temp = array_values($tableauArduinos);
        $arduino = array_shift($temp);
        //var_dump($arduino);
        try {
            $rep = $dao->sendCommandes($arduino->getId(), $commandes);
            var_dump($rep);
        } catch (DomotiqueException $e) {
            echo "DomotiqueException " . $e->getMessage();
        }
        break;
    }
}
?>
