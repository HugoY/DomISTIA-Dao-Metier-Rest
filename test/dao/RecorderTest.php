<?php

require_once './../../dao/Recorder.php';
require_once './../../dao/Dao.php';

/*
 * Test de la partie serveur d'enregistrement de la couche DAO
 * Le client est un vrai Arduino
 * Une arduino se connecte on connait la chaine qu'elle envoi 
 * {"id":"192.168.2.3","desc":"duemilanove","mac":"90:A2:DA:00:1D:A7","port":102}
 * On vérifie que l'arduino a été correctement ajoutée
 */

class RecorderTest extends PHPUnit_Framework_TestCase {

    private $recordeur;
    private $dao;

    protected function setUp() {
        $this->recordeur = new Recorder();
        $this->dao = new Dao($this->recordeur);
        $this->dao->init();
        $this->recordeur->start();
    }

    protected function tearDown() {
        
    }

    public function testEnregistrement() {
        var_dump($this->dao->getArduinos());
        $this->assertEquals(1, count($this->dao->getArduinos()));
    }

}
