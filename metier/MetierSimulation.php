<?php

/**
 * Description of MetierSimulation
 *
 * @author Hugo
 */
require_once 'IMetier.php';
require_once(dirname(__FILE__) . '/../entities/Arduino.php');
require_once(dirname(__FILE__) . '/../entities/Reponse.php');

class MetierSimulation implements IMetier {

  private static $_instance = null;

  public static function getInstance() {
    if (is_null(self::$_instance)) {
      self::$_instance = new MetierSimulation();
    }
    return self::$_instance;
  }

  private $arduinos = array();

  private function __construct() {
    $arduino = new Arduino("192.168.2.3", "duemilanove", "90:A2:DA:00:1D:A7", "192.168.2.3", 102);
    $arduino2 = new Arduino("192.168.2.4", "uno", "80:B3:EB:11:2E:B8", "192.168.2.4", 102);
    $this->arduinos[$arduino->getId()] = $arduino;
    $this->arduinos[$arduino2->getId()] = $arduino2;
  }

  
    public function faireClignoterLed($idCommande, $idArduino, $pin, $millis, $nbIter) {
      if (!array_key_exists($idArduino,$this->arduinos)){
      
        throw new DomotiqueException("L'arduino [".$idArduino."] n'existe pas",103);
      }
      
        
    }


  public function getArduinos() {
    return $this->arduinos;
  }


    public function pinRead($idCommande, $idArduino, $pin, $mode) {
        if (!array_key_exists($idArduino,$this->arduinos)){
       
        throw new DomotiqueException("L'arduino [".$idArduino."] n'existe pas",105);
      }
      $reponse= new Reponse();
      $reponse->initWithJson("{\"id\":\"".$idArduino."\",\"er\":\"0\",\"et\":{}}");
     
      return $reponse;
    }


  public function pinWrite($idCommande, $idArduino, $pin, $mode, $val) {
    if (!array_key_exists($idArduino,$this->arduinos)){
       
        throw new DomotiqueException("L'arduino [".$idArduino."] n'existe pas",105);
      }
      $reponse= new Reponse();
      $message = "{\"id\":\"".$idCommande."\",\"er\":\"0\",\"et\":{}}";
     // echo $message."\n";
     // $reponse->initWithJson($message);
      
      $reponse->setId($idCommande);
      $reponse->setEtat("{}");
      $reponse->setErreur("0");
      
      var_dump($reponse);
     
      return $reponse;
    
  }

  public function sendCommandes($idArduino, $commandes) {
    
  }

  public function sendCommandesJson($idArduino, $commandes) {
    
  }

}
