<?php
require_once 'IDao.php';
/**
 * Description of Dao
 *
 * @author usrlocal
 */
class Dao implements IDao {
  
  private $serveur;
  
  public function init(){
    $adress = "172.20.82.172";
    $port = 10000;
    $this->serveur  = new Recorder();
    $this->serveur->setDao($this);
    $this->serveur->init($adress, $port);
    //$serveur->run();
    $this->serveur->start();//Will start a new Thread to execute the implemented run method 
  }
  
  public function addArduino($arduino) {
    
  }

  public function getArduinos() {
    
  }

  public function removeArduino($arduino) {
    
  }

  public function sendCommandes($idArduino, $commandes) {
    
  }

  public function sendCommandesJson($idArduino, $commandes) {
    
  }  //put your code here
}

?>
