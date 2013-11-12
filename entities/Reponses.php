<?php

/**
 * Description of Reponses
 *
 * @author usrlocal
 */
class Reponses {

    private $json;
    private $id;
    private $erreur;
    private $etat;

    public function getJson() {
        return $this->json;
    }

    public function setJson($json) {
        $this->json = $json;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getErreur() {
        return $this->erreur;
    }

    public function setErreur($erreur) {
        $this->erreur = $erreur;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }

    public function __construct() {
        
    }

    public function initWithJsonIdErreurEtat($json, $id, $erreur, $etat) {
        $this->setJson($json);
        $this->setId($id);
        $this->setErreur($erreur);
        $this->setEtat($etat);
    }
    
    public function initWithJSON($json){
        $map = json_decode($json);
        $this->setId($map["id"]);
        $this->setErreur($map["er"]);
        $this->setEtat($map["et"]);
    }
    
    

}

?>
