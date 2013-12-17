<?php

require_once __DIR__.'\ThreadDao.php';
require_once __DIR__.'\..\entities/Arduino.php';
require_once __DIR__.'\..\entities/DomotiqueException.php';

/**
 * Description of Recorder : 
 * Enregistre les cartes Arduinos cherchant à se connecter
 */
class Recorder extends ThreadDao {

    private $dao;
    private $socket = null; //La socket "maître" sur laquelle le serveur écoute
    private $client = null; //Contiendra l'id de chaque nouvelle connexion

    public function __construct() {
        echo "<br>Constructeur RECORDER<br>";
    }

    public function setDao($dao) {
        $this->dao = $dao;
    }

    public function init($address, $port) {
        echo "init\n";
        if (!$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new DomotiqueException("Impossible de créer socket: [$errorcode] $errormsg \n");
        }
        //on lie la ressource sur laquelle le serveur va écouter
        if (!socket_bind($this->socket, $address, $port)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new DomotiqueException("Impossible de binder la socket: [$errorcode] $errormsg \n");
        }
        //On prépare l'écoute
        if (!socket_listen($this->socket)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new DomotiqueException("Impossible de listen la socket: [$errorcode] $errormsg \n");
        }
    }

    public function run() {
       
        
        while (true) {
            echo "attente client arduino";
            //Le code se bloque jusqu'à ce qu'une nouvelle connexion cliente soit établie
            if (!$this->client = socket_accept($this->socket)) {
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);
                throw new DomotiqueException("Erreur avec socket_accept: [$errorcode] $errormsg \n");
            }            
            $this->recordArduino();
            return;
            //sleep(1);
        }
    }

    private function recordArduino() {
        echo "recordArduino\n";
        // PHP_NORMAL_READ => arduino / PHP_BINARY_READ => pc
        if (!$buf = socket_read($this->client, 2048, PHP_NORMAL_READ)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new DomotiqueException("Could not read: [$errorcode] $errormsg \n");
        }

        echo "\nL'arduino voulant s'enregistrer a envoyer : " . $buf . "\n\n";
        $parsedRecordDemand = json_decode($buf);
        $arduino = new Arduino($parsedRecordDemand->{'id'}, $parsedRecordDemand->{'desc'}, $parsedRecordDemand->{'mac'}, $parsedRecordDemand->{'id'}, $parsedRecordDemand->{'port'});
        $this->dao->addArduino($arduino);
        echo "<br>recordArduino<br>";
        var_dump($this->dao->getArduinos());
    }

}

?>
