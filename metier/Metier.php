<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'IMetier.php';
require_once 'dao/Recorder.php';
require_once 'dao/Dao.php';
require_once 'entities/Arduino.php';
require_once 'entities/Commande.php';

class Metier implements IMetier{
    
    private $dao;
    
    public function __construct(){
    
        $recordeur  = new Recorder();
        $this->dao = new Dao($recordeur);

        $this->dao->init();
//$this->serveur->run();
        $recordeur->start();
        //$this->dao = new DaoSimulation();

       
      
    }


    public function faireClignoterLed($idCommande, $idArduino, $pin, $millis, $nbIter) {
        $commande = new Commande();
        $parametres = array(
            "nb" => $nbIter,
            "dur" => $millis, 
            "pin" => $pin,
        );
        $commande->initWithIdActionParametres($idCommande, "cl", $parametres);
        //on ajoute dans un tableau
        
        $this->sendCommandes($idArduino, array($commande));
                
    }

    public function getArduinos() {
       return $this->dao->getArduinos();                        
    }

    public function pinRead($idCommande, $idArduino, $pin, $mode) {
        $commande = new Commande();
        $parametres = array(
            "pin" => $pin,
            "mod" => $mode, 
        );
        $commande->initWithIdActionParametres($idCommande, "pr", $parametres);
        //on ajoute dans un tableau
        
        return $this->sendCommandes($idArduino, $commande);
        
        
    }

    public function pinWrite($idCommande, $idArduino, $pin, $mode, $val) {
        $commande = new Commande();
        $parametres = array(
            "pin" => $pin,
            "mod" => $mode,
            "val" => $val,
        );
        $commande->initWithIdActionParametres($idCommande, "pw", $parametres);
        //on ajoute dans un tableau
        
        $reponses= $this->sendCommandes($idArduino, array($commande));
        
        return $reponses[0];
        
    }

    public function sendCommandes($idArduino, $commandes) {
        return $this->dao->sendCommandes($idArduino, $commandes);
        
    }

    public function sendCommandesJson($idArduino, $commandes) {
        return $this->dao->sendCommandesJson($idArduino, $commandes);
    }    
}
?>
