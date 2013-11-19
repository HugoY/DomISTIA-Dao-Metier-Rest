<?php

require_once __DIR__ . '\IDao.php';
require_once __DIR__ . '\..\entities/Arduino.php';
require_once __DIR__ . '\..\entities/Reponse.php';

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

    public function removeArduino($idArduino) {
        unset($this->lesArduinos[$idArduino]);
    }

    protected function socketCreate() {
        if (!$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new DomotiqueException("Impossible de créer socket: [$errorcode] $errormsg \n");
        }
        echo "Socket created \n";
        return $sock;
    }

    protected function socketConnectToArduino($sock, $arduinoIp, $arduinoPort) {
        if (!socket_connect($sock, $arduinoIp, $arduinoPort)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new DomotiqueException("Could not connect: [$errorcode] $errormsg \n");
        }
        echo "Connection established \n";
    }

    protected function socketReadAnswerFromArduino($sock) {
        if (!$buf = socket_read($sock, 2048, PHP_NORMAL_READ)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new DomotiqueException("Could not read: [$errorcode] $errormsg \n");
        }
        echo "La réponse : " . $buf . "\n";
        return $buf;
    }

    protected function sendOneCommande($idArduino, $commande) {
        // Ici on est un client qui envoi $commandes (converti en json) sur l'arduino défini par $idArduino
        echo "SendCommandes\n";
        $arduino = $this->lesArduinos[$idArduino];
        //Creation de la socket
        $sock = $this->socketCreate();
        //Connexion au serveur
        $this->socketConnectToArduino($sock, $arduino->getIp(), $arduino->getPort());
        //Ecriture du paquet vers le serveur
        if (!socket_write($sock, $commande->toJSON(), 2048)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new DomainException("Could not write: [$errorcode] $errormsg \n");
        }
        echo "Message write successfully \n";
        // Attendre une réponse 
        $answer = $this->socketReadAnswerFromArduino($sock);
        //Fermeture de la connexion
        socket_close($sock);
        $reponse = new Reponse();
        $reponse->initWithJSON($answer);
        return $reponse;
    }

    protected function sendOneCommandeJson($idArduino, $commandeJson) {
        echo "SendCommandesJson\n";
        $arduino = $this->lesArduinos[$idArduino];
        //Creation de la socket
        $sock = $this->socketCreate();
        //Connexion au serveur
        $this->socketConnectToArduino($sock, $arduino->getIp(), $arduino->getPort());
        //Ecriture du paquet vers le serveur
        if (!socket_write($sock, $commandeJson, 2048)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);

            die("Could not write: [$errorcode] $errormsg \n");
        }
        echo "Message write successfully \n";
        // Attendre une réponse 
        $answer = $this->socketReadAnswerFromArduino($sock);
        //Fermeture de la connexion
        socket_close($sock);
        return $answer;
    }

    public function sendCommandes($idArduino, $commandes) {
        $reponses = array();
        foreach ($commandes as $commande) {
            $reponses[] = $this->sendOneCommande($idArduino, $commande);
           
        }
        return $reponses;
    }

    public function sendCommandesJson($idArduino, $commandesJson) {
        $reponses = array();
        foreach ($commandesJson as $commandeJson) {
            $reponses[] = $this->sendOneCommandeJson($idArduino, $commandeJson);
        }
        return $reponses;
    }
}

?>
