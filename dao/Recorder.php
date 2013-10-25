<?php

require_once 'IThreadDao.php';
// To Do : Création de Thread, implémenter IThreadDao

/**
 * Description of Recorder : 
 * Enregistre les cartes Arduinos cherchant à se connecter
 * 
 * @author usrlocal
 */
class Recorder implements IThreadDao {

  private $dao;
  private $maxArduinos = 10;
  private $arduinos = array();
  private $socket = null; //La socket "maître" sur laquelle le serveur écoute
  private $client = null; //Contiendra l'id de chaque nouvelle connexion
  private $denied; //Contient un message à afficher lorsqu'une connexion est refusée
  private $log = 1; //0=afficher les infos sur l'écran, 1=enregistrer les log dans un fichier
  private $logfile = 'DomotiqueServerLog.log'; //Nom du fichier log où stocker les infos
  private $fp_log; //Ressource du fichier log
// A supprimer ? 
  private $html; //Contient l'en-tête html à envoyer à chaque nouveau client
  private $Already_In_use; //Si un pseudo est déjà pris, envoyer ce message au client avant de refuser sa connexion
// Pas compris 
  private $write_type = 0; //1->MAJ liste connectés+message 2->envoi d'un message 3->ne pas reformatter le message

  public function setDao($dao) {
    $this->dao = $dao;
  }

  public function init($address, $port) {
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
    sleep(5);
    socket_close($this->client); // et non pas $this-> socket
    echo "socket_close:client\n";
    }
  }

  private function recordArduino() {
    echo "recordArduino\n";
    $buf = socket_read($this->client, 2048, PHP_BINARY_READ);  // PHP_NORMAL_READ => arduino / PHP_BINARY_READ => pc
    echo "L'arduino voulant s'enregistrer à envoyer : " . $buf . "\n";
  }

}

?>
