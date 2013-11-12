<?php
require_once 'IDao.php';
/**
 * Description of Dao
 *
 * @author usrlocal
 */

class SharedArray extends Stackable {
    public function __construct($array) {
        $this->merge($array);
    }

    public function run(){}
}

class Dao extends Stackable implements IDao {
 
  // dictionnaire des arduinos
    public $lesArduinos;
    private $serveurEnregistrement;
  
  public function __construct($recorder){
      $this->serveurEnregistrement = $recorder;
      $this->lesArduinos = new SharedArray(array());
  }
    
  public function init(){
    $adress = "192.168.2.1"; //172.20.82.172
    $port = 100;

    $this->serveurEnregistrement->setDao($this);
    $this->serveurEnregistrement->init($adress, $port);

  }
  
  public function run(){}
  
  public function addArduino($arduino) {
    $this->lesArduinos[]=$arduino;
    //var_dump($this->lesArduinos);
  }

  public function echoArduinos(){
   echo "Liste des arduinos enregistrées pour le moment : \n";
   foreach ($this->lesArduinos as $a) {
        echo $a->toString()."\n";
    }
  }
  
  public function getArduinos() {
      return $this->lesArduinos;
  }

  public function removeArduino($arduino) {
    
  }

  public function sendCommandes($idArduino, $commandes) {
    $arduino = $this->lesArduinos[$idArduino];
  }

  public function sendCommandesJson($idArduino, $commandes) {
    // encore un test
  }
}

?>
