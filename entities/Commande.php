<?php

/**
 * Description of Commandes
 *
 * @author usrlocal
 */
class Commande {

    private $id;
    private $action;
    private $parametres; // parametre est un tableau!
    private $map; // A quoi sert map ?? 

    public function __construct() {
    }

    public function initWithIdActionParametres($id, $action, $parametres) {
        $this->setId($id);
        $this->setAction($action);
        $this->setParametres($parametres);
        $this->map = array(
            "id" => $id,
            "ac" => $action,
            "pa" => $parametres
        );
    }
   
    public function initWithJSON($json){
        $map = json_decode($json);
        $this->setId($map["id"]);
        $this->setAction($map["ac"]);
        $this->setParametres($map["pa"]);
    }

    public function toJSON(){
        $map = array("id" => $this->id, "ac" => $this->action, "pa" => $this->parametres);
        return json_encode($map)."\n";
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getAction() {
        return $this->action;
    }

    public function setAction($action) {
        $this->action = $action;
    }

    public function getParametres() {
        return $this->parametres;
    }

    public function setParametres($parametres) {
        $this->parametres = $parametres;
    }

    public function getMap() {
        return $this->map;
    }

    public function setMap($map) {
        $this->map = $map;
    }
}

?>
