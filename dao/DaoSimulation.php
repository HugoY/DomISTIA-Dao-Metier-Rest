<?php
require_once 'entities/Arduino.php';
require_once 'entities/Reponse.php';
require_once 'entities/Commande.php';
require_once 'IDao.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DaoSimulation implements IDao{
    
    private $lesArduinos;
    
    public function __construct() {
        $this->lesArduinos=array();
    }
    
    public function addArduino($arduino) {
        $this->lesArduinos[]=$arduino;
        
    }

    public function getArduinos() {
       return $this->lesArduinos; 
        
    }

    public function removeArduino($arduino) {
        
    }

    public function sendCommandes($idArduino, $commandes) {
        
        $reponse= new Reponse();
         var_dump($commandes);
        
        $reponse->initWithJSON("{\"id\":\"1\",\"er\":\"100\",\"et\":{}}");
        return $reponse;
        
    }

    public function sendCommandesJson($idArduino, $commandes) {
        
    } 
   
}
?>
