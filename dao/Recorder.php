<?php

require_once 'ThreadDao.php';
require_once 'entities/Arduino.php'; // util ?

// To Do : Création de Thread, implémenter IThreadDao

/**
 * Description of Recorder : 
 * Enregistre les cartes Arduinos cherchant à se connecter
 * 
 * @author usrlocal
 */
class Recorder extends ThreadDao {

  private $dao;
  private $socket = null; //La socket "maître" sur laquelle le serveur écoute
  private $client = null; //Contiendra l'id de chaque nouvelle connexion

  public function __construct(){
  }
  
  public function setDao($dao) {
    $this->dao = $dao;
  }

  public function init($address, $port) {
    $this->ip=$address; 
    echo "init\n";
    $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    socket_bind($this->socket, $address, $port) or die($this->destroy(null)); //on lie la ressource sur laquelle le serveur va écouter
    socket_listen($this->socket); //On prépare l'écoute
  }

  public function run() {
    echo "run\n";
    while(true){
        $this->client = socket_accept($this->socket); //Le code se bloque jusqu'à ce qu'une nouvelle connexion cliente soit établie
        $this->recordArduino();
        //sleep(5);
        //socket_close($this->client); // et non pas $this-> socket
        //echo "socket_close:client\n";
    }
  }

  private function recordArduino() {
    echo "recordArduino\n";
    $buf = socket_read($this->client, 2048, PHP_NORMAL_READ);  // PHP_NORMAL_READ => arduino / PHP_BINARY_READ => pc
    echo "\nL'arduino voulant s'enregistrer à envoyer : " . $buf . "\n\n";
    // Parser la chaine 
    $parsedRecordDemand = json_decode($buf);
    $arduino = new Arduino($parsedRecordDemand->{'id'},
                           $parsedRecordDemand->{'desc'},
                           $parsedRecordDemand->{'mac'},
                           $this->ip, // Pas sur
                           $parsedRecordDemand->{'port'});
    $this->dao->addArduino($arduino);
    //$this->dao->echoArduinos();
   //var_dump($this->dao->getArduinos());
    // Socket close ? 
  }

}

?>
