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

    public function run() {
        
    }

}

class Dao extends Stackable implements IDao {

    // dictionnaire des arduinos
    public $lesArduinos;
    private $serveurEnregistrement;

    public function __construct($recorder) {
        $this->serveurEnregistrement = $recorder;
        $this->lesArduinos = new SharedArray(array());
    }

    public function init() {
        $adress = "192.168.0.16"; //172.20.82.172
        $port = 10000;

        $this->serveurEnregistrement->setDao($this);
        $this->serveurEnregistrement->init($adress, $port);
    }

    public function run() {
        
    }

    public function addArduino($arduino) {
        $this->lesArduinos[] = $arduino;
        //var_dump($this->lesArduinos);
    }

    public function echoArduinos() {
        echo "Liste des arduinos enregistrées pour le moment : \n";
        foreach ($this->lesArduinos as $a) {
            echo $a->toString() . "\n";
        }
    }

    public function getArduinos() {
        return $this->lesArduinos;
    }

    public function removeArduino($arduino) {
        
    }

    public function sendCommandes($idArduino, $commandes) {
        // Ici on est un client qui envoi $commandes (converti en json) sur l'arduino défini par $idArduino
        
        $arduino = $this->lesArduinos[$idArduino];        
        //Creation de la socket
        $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('Création de socket refusée');
        //Connexion au serveur
        socket_connect($sock, $arduino->ip, $arduino->port) or die('Connexion impossible');
        //Ecriture du paquet vers le serveur
        socket_write($sock, $commandes->toJSON(), 500);// 500 ?
        // Attendre une réponse 
        $input = socket_read($client, 500);
        echo $input;
        //Fermeture de la connexion
        socket_close($sock);
        
    }

    public function sendCommandesJson($idArduino, $commandes) {
        // encore un test
    }

}

?>
