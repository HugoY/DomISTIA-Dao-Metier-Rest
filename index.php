<?php

require_once 'metier/Metier.php';
require_once "entities/DomotiqueException.php";
//require_once 'dao/Dao.php';
// ip : 192.168.2.1
// port : 100
// chaine renvoyée par Arduino {"id":"192.168.2.3","desc":"duemilanove","mac":"90:A2:DA:00:1D:A7","port":102}

ini_set("max_execution_time", 0);


try {
    $metier =  Metier::getInstance();
} catch (DomotiqueException $e) {
    echo"L'erreur suivante s'est produite : " . $e->getMessage();
    exit();
}
//on attend au moins un arduino
while (count($metier->getArduinos()) == 0);

$arduinos = $metier->getArduinos();
echo "Index.php\n";
var_dump($arduinos);
/*
foreach ($arduinos as $a) {

//écriture sur la pin 9 en digital
    $reponse = $metier->pinWrite("1", $a->getId(), "9", "b", "1"); //{"id":"2","ac":"pw","pa":{"pin":"7","mod":"b","val":"1"}}

    echo "La réponse : " . $reponse->getJson() . "\n";
//écriture analogique a
    $reponse1 = $metier->pinWrite("2", $a->getId(), "3", "a", "120"); //{"id":"3","ac":"pw","pa":{"pin":"2","mod":"a","val":"120"}}
    echo "La réponse : " . $reponse1->getJson() . "\n";

//ecriture avec mauvais mode
    try {
         $reponse2 = $metier->pinWrite("2", $a->getId(), "2", "x", "120");
         echo "La réponse : " . $reponse2->getJson() . "\n";
    } catch (DomotiqueException $e1) {
        echo "L'erreur suivante s'est produite : ".$e1->getMessage(). "\n";
    }
    //ecriture en a avec mauvaise valeur
    try {
         $reponse3 = $metier->pinWrite("3", $a->getId(), "2", "a", "290");
         echo "La réponse : " . $reponse3->getJson() . "\n";
    } catch (DomotiqueException $e1) {
        echo "L'erreur suivante s'est produite : ".$e1->getMessage(). "\n";
    }
    //ecriture en b avec mauvaise valeur
    try {
         $reponse4 = $metier->pinWrite("3", $a->getId(), "2", "b", "9");
         echo "La réponse : " . $reponse4->getJson() . "\n";
    } catch (DomotiqueException $e1) {
        echo "L'erreur suivante s'est produite : ".$e1->getMessage(). "\n";
    }
    //ecriture avec mauvaise pin 
     try {
         $reponse5 = $metier->pinWrite("3", $a->getId(), "23", "b", "1");
         echo "La réponse : " . $reponse5->getJson() . "\n";
    } catch (DomotiqueException $e1) {
        echo "L'erreur suivante s'est produite : ".$e1->getMessage(). "\n";
    }
    
    //lecture en b
    $reponse6=$metier->pinRead("7",$a->getId(),"9", "b");
    //lecture en a 
    $reponse7=$metier->pinRead("7",$a->getId(),"2", "a");
    //lecture avec mauvais mode
    try {
      $metier->pinRead("2", $a->getId(), "2", "x");
       
    } catch (DomotiqueException $e1) {
        echo "L'erreur suivante s'est produite : ".$e1->getMessage(). "\n";
    }
    //lecture en a avec mauvais pin 
    try {
      $metier->pinRead("2", $a->getId(), "6", "a");
       
    } catch (DomotiqueException $e1) {
        echo "L'erreur suivante s'est produite : ".$e1->getMessage(). "\n";
    }
    //lecture en b avec mauvaise pin 
    try {
      $metier->pinRead("2", $a->getId(), "16", "b");
       
    } catch (DomotiqueException $e1) {
        echo "L'erreur suivante s'est produite : ".$e1->getMessage(). "\n";
    }
    //faire clignoter 
    $metier->faireClignoterLed("9", $a->getId(), "9","100", "10");
    //faireClignoter avec milis faux 
    try {
      $metier->faireClignoterLed("10", $a->getId(), "9","-4", "10");
       
    } catch (DomotiqueException $e1) {
        echo "L'erreur suivante s'est produite : ".$e1->getMessage(). "\n";
    }
    
    //faireClignoter avec nbiter faux 
    try {
      $metier->faireClignoterLed("10", $a->getId(), "9","4", "-10");
       
    } catch (DomotiqueException $e1) {
        echo "L'erreur suivante s'est produite : ".$e1->getMessage(). "\n";
    }
    //
    $laCommande="{\"id\":\"2\",\"ac\":\"pw\",\"pa\":{\"pin\":\"7\",\"mod\":\"b\",\"val\":\"1\"}}";
    $metier->sendCommandesJson($a->getId(), array($laCommande));
    
}*/
?>
