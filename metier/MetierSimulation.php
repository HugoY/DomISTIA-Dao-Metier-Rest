<?php

/**
 * Description of MetierSimulation
 *
 * @author Hugo
 */
require_once 'IMetier.php';
require_once(dirname(__FILE__) . '/../entities/Arduino.php');

class MetierSimulation implements IMetier {
    
    private $arduinos = array();
    
    public function __construct() {
        $arduino = new Arduino("192.168.2.3", "duemilanove", "90:A2:DA:00:1D:A7", "192.168.2.3", 102);
        $arduino2 = new Arduino("192.168.2.4", "uno", "80:B3:EB:11:2E:B8", "192.168.2.4", 102);
        $this->arduinos[$arduino->getId()] = $arduino;
        $this->arduinos[$arduino2->getId()] = $arduino2;
    }
    
    public function faireClignoterLed($idCommande, $idArduino, $pin, $millis, $nbIter) {
        
    }

    public function getArduinos() {
        return $this->arduinos;
    }

    public function pinRead($idCommande, $idArduino, $pin, $mode) {
        
    }

    public function pinWrite($idCommande, $idArduino, $pin, $mode, $val) {
        
    }

    public function sendCommandes($idArduino, $commandes) {
        
    }

    public function sendCommandesJson($idArduino, $commandes) {
        
    }

}
