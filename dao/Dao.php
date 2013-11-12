<?php

require_once 'IDao.php';
require_once 'entities/Reponse.php';

/**
 * Description of Dao
 *
 * @author usrlocal
 */
class SharedArray extends Stackable {

    public function __construct($array) {
        $this->merge($array);
    }

    public function run() {
        
    }

}

class Dao extends Stackable implements IDao {

    // dictionnaire des arduinos
    private $lesArduinos;
    private $serveurEnregistrement;

    public function __construct($recorder) {
        $this->serveurEnregistrement = $recorder;
        $this->lesArduinos = new SharedArray(array());
    }

    public function init() {
        $adress = "192.168.2.1"; //172.20.82.172
        $port = 100;

        $this->serveurEnregistrement->setDao($this);
        $this->serveurEnregistrement->init($adress, $port);
    }

    public function run() {
        
    }

    public function addArduino($arduino) {
        $this->lesArduinos[$arduino->getId()] = $arduino;
    }

    public function showArduinos() {
        echo "Liste des arduinos enregistrées pour le moment : \n";
        foreach ($this->lesArduinos as $a) {
            echo $a->toString() . "\n";
        }
    }

    public function getArduinos() {
        return (array) $this->lesArduinos;
    }

    public function removeArduino($arduino) {
        
    }

    public function sendCommandes($idArduino, $commandes) {
        echo "Send Command\n";
        // Ici on est un client qui envoi $commandes (converti en json) sur l'arduino défini par $idArduino

        $arduino = $this->lesArduinos[$idArduino];
        //Creation de la socket
        if (!$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);

            die("Couldn't create socket: [$errorcode] $errormsg \n");
        }
        echo "Socket created \n";
        //Connexion au serveur

        if (!socket_connect($sock, $arduino->getIp(), $arduino->getPort())) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);

            die("Could not connect: [$errorcode] $errormsg \n");
        }
        echo "Connection established \n";
        //Ecriture du paquet vers le serveur
        if (!socket_write($sock, $commandes->toJSON(), 2048)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);

            die("Could not write: [$errorcode] $errormsg \n");
        }
        echo "Message write successfully \n";
        // Attendre une réponse 
        if (!$input = socket_read($sock, 2048, PHP_NORMAL_READ)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);

            die("Could not read: [$errorcode] $errormsg \n");
        }
        echo "La réponse : " . $input;
        //Fermeture de la connexion
        socket_close($sock);
        $reponse = new Reponse();
        $reponse->initWithJSON($input);
        return $reponse;
    }

    public function sendCommandesJson($idArduino, $commandes) {
        // encore un test
    }

}

?>
