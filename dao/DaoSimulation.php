<?php
require_once 'entities/Arduino.php';
require_once 'entities/Reponses.php';
require_once 'entities/Commandes.php';
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
        
        $reponse= new Reponses();
        
        $reponse->initWithJSON($json);
        return $reponse;
        
    }

    public function sendCommandesJson($idArduino, $commandes) {
        
    } 
   
}
?>
