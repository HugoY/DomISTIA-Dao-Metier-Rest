<?php

require_once __DIR__ . '\IDao.php';
require_once __DIR__ . '\..\entities/Arduino.php';
require_once __DIR__ . '\..\entities/Reponse.php';
require_once __DIR__ . '\..\KLogger\KLogger.php';

class Dao implements IDao {

    private $lesArduinos;
    private $log;

    public function __construct() {
        $this->log = KLogger::instance();
        $this->log->logInfo('Constructeur DAO');
    }

    public function getArduinos() {
        $address = "172.20.82.173";
        $port = 100;

        //Creation de la socket
        $sock = $this->socketCreate();
        //Connexion au serveur
        $this->socketConnectToArduino($sock, $address, $port);
        //Ecriture du paquet vers le serveur d'enregistrement
        $mapJSON = json_encode(array("from" => "dao"));
        $mapJSON .= "\n";
        if (!socket_write($sock, $mapJSON, 2048)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new DomainException("Could not write: [$errorcode] $errormsg \n");
        }
        $this->log->logInfo("Message write successfully");
        // Attendre une réponse 
        $answer = $this->socketReadAnswerFromArduino($sock);
        //Fermeture de la connexion
        socket_close($sock);

        $parsedAnswer = json_decode($answer);

        foreach ($parsedAnswer as $arduinoDecode) {
            $arduino = new Arduino($arduinoDecode->{'id'}, $arduinoDecode->{'description'}, $arduinoDecode->{'mac'}, $arduinoDecode->{'id'}, $arduinoDecode->{'port'});
            $this->lesArduinos[$arduino->getId()] = $arduino;
        }
        return $this->lesArduinos;
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
        $this->log->logInfo("Socket created \n");
        return $sock;
    }

    protected function socketConnectToArduino($sock, $arduinoIp, $arduinoPort) {
        if (!socket_connect($sock, $arduinoIp, $arduinoPort)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new DomotiqueException("Could not connect: [$errorcode] $errormsg \n");
        }
        $this->log->logInfo("Connection established");
    }

    protected function socketReadAnswerFromArduino($sock) {
        if (!$buf = socket_read($sock, 2048, PHP_NORMAL_READ)) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode);
            throw new DomotiqueException("Could not read: [$errorcode] $errormsg \n");
        }
        $this->log->logInfo("La réponse : " . $buf );
        return $buf;
    }

    protected function sendOneCommande($idArduino, $commande) {
        // Ici on est un client qui envoi $commandes (converti en json) sur l'arduino défini par $idArduino
        $this->log->logInfo("SendCommandes");
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
        $this->log->logInfo("Message write successfully \n");
        // Attendre une réponse 
        $answer = $this->socketReadAnswerFromArduino($sock);
        //Fermeture de la connexion
        socket_close($sock);
        $reponse = new Reponse();
        $reponse->initWithJSON($answer);
        return $reponse;
    }

    protected function sendOneCommandeJson($idArduino, $commandeJson) {
        $this->log->logInfo("SendCommandesJson");
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
        $this->log->logInfo("Message write successfully");
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
