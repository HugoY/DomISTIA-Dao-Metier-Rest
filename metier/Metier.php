<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'IMetier.php';
require_once 'dao/Recorder.php';
require_once 'dao/Dao.php';


class Metier implements IMetier{
    
    private $dao;
    
    function _construct(){
        $recordeur  = new Recorder();
        $this->dao = new Dao($recordeur);

        $this->dao->init();
        $recordeur->start();//Will start a new Thread to execute the implemented run method                 
    }


    public function faireClignoterLed($idCommande, $idArduino, $pin, $millis, $nbIter) {
        $commande = new Commandes();
        $parametres = array(
            "nb" => $nbIter,
            "dur" => $millis, 
            "pin" => $pin,
        );
        $commande->initWithIdActionParametres($idCommande, "pr", $parametres);
        //on ajoute dans un tableau
        
        $this->sendCommandes($idArduino, array($commande));
                
    }

    public function getArduinos() {
        $this->dao->getArduinos();                        
    }

    public function pinRead($idCommande, $idArduino, $pin, $mode) {
        $commande = new Commandes();
        $parametres = array(
            "pin" => $pin,
            "mod" => $mode, 
        );
        $commande->initWithIdActionParametres($idCommande, "pr", $parametres);
        //on ajoute dans un tableau
        
        return $this->sendCommandes($idArduino, array($commande));
        
        
    }

    public function pinWrite($idCommande, $idArduino, $pin, $mode, $val) {
        $commande = new Commandes();
        $parametres = array(
            "pin" => $pin,
            "mod" => $mode,
            "val" => $val,
        );
        $commande->initWithIdActionParametres($idCommande, "pw", $parametres);
        //on ajoute dans un tableau
        
        return $this->sendCommandes($idArduino, array($commande));
        
    }

    public function sendCommandes($idArduino, $commandes) {
        return $this->dao->sendCommandes($idArduino, $commandes);
        
    }

    public function sendCommandesJson($idArduino, $commandes) {
        return $this->dao->sendCommandesJson($idArduino, $commandes);
    }    
}
?>
