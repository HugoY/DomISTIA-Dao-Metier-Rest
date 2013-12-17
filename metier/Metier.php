<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'IMetier.php';
require_once dirname(__FILE__) . '/../dao/Recorder.php';
require_once dirname(__FILE__) . '/../dao/Dao.php';
require_once dirname(__FILE__) . '/../entities/Arduino.php';
require_once dirname(__FILE__) . '/../entities/Commande.php';
require_once dirname(__FILE__) . '/../entities/DomotiqueException.php';

class Metier implements IMetier {
    
    private static $_instance = null;

  public static function getInstance() {
    if (is_null(self::$_instance)) {
      self::$_instance = new Metier();
    }
    return self::$_instance;
  }

  private $dao;

  private function __construct() {

      echo "<br>Constructeur METIER<br>";
    $recordeur = new Recorder(); 
    $this->dao = new Dao($recordeur);
    $this->dao->init();    
    $recordeur->start();
  }

  public function faireClignoterLed($idCommande, $idArduino, $pin, $millis, $nbIter) {
    if (!array_key_exists($idArduino,$this->getArduinos())){
        throw new DomotiqueException("L'arduino [".$idArduino."] n'existe pas",103);
      }
    //on regarde la valeur de la pin
    if (intval($pin) < 1 || intval($pin) > 13) {
      throw new DomotiqueException("La valeur de la pin[" . $pin . "] doit être compris entre [1,13]");
    }
    //vérification de la durée
    if (intval($millis) < 1) {
      throw new DomotiqueException("La valeur de la durée [" . $millis . "] doit être supérieur à 0");
    }
    //vérification nbIter
    if (intval($nbIter) < 1) {
      throw new DomotiqueException("La valeur du nombre d'itération [" . $millis . "] doit être supérieur à 0");
    }

    $commande = new Commande();
    $parametres = array(
        "nb" => $nbIter,
        "dur" => $millis,
        "pin" => $pin,
    );
    $commande->initWithIdActionParametres($idCommande, "cl", $parametres);
    //on ajoute dans un tableau

    $this->sendCommandes($idArduino, array($commande));
  }

  public function getArduinos() {
    var_dump($this->dao->getArduinos());
    return $this->dao->getArduinos();
  }

  public function pinRead($idCommande, $idArduino, $pin, $mode) {
    if (!array_key_exists($idArduino,$this->getArduinos())){
        throw new DomotiqueException("L'arduino [".$idArduino."] n'existe pas",103);
      }
    //On regarde que le mode correspond à a ou b
    if (strcmp($mode, "a") != 0 && strcmp($mode, "b") != 0) {
      throw new DomotiqueException("La valeur [" . $mode . "] du mode doit être \" a \" (analogique) ou \" b \" (binaire)");
    }
    //on regarde la valeur de la pin dans le cas de la lecture a
    if (strcmp($mode, "a") == 0) {
      if (intval($pin) < 0 || intval($pin) > 5) {
        throw new DomotiqueException("La valeur de la pin[" . $pin . "]doit etre comprise entre [0,5]");
      }
    } else {
      if (intval($pin) < 1 || intval($pin) > 13) {
        throw new DomotiqueException("La valeur de la pin[" . $pin . "] doit être compris entre [0,13]");
      }
    }


    $commande = new Commande();
    $parametres = array(
        "pin" => $pin,
        "mod" => $mode,
    );
    $commande->initWithIdActionParametres($idCommande, "pr", $parametres);
    //on ajoute dans un tableau

    $reponses = $this->sendCommandes($idArduino, array($commande));

    return $reponses[0];
  }

  public function pinWrite($idCommande, $idArduino, $pin, $mode, $val) {
    if (!array_key_exists($idArduino,$this->getArduinos())){
        throw new DomotiqueException("L'arduino [".$idArduino."] n'existe pas",103);
      }
    //On regarde que le mode correspond à a ou b
    if (strcmp($mode, "a") != 0 && strcmp($mode, "b") != 0) {
      throw new DomotiqueException("La valeur [" . $mode . "] du mode doit être \" a \" (analogique) ou \" b \" (binaire)");
    }

    //on regarde la valeur de la pin
    if (intval($pin) < 0 || intval($pin) > 13) {
      throw new DomotiqueException("La valeur de la pin[" . $pin . "] doit être compris entre [0,13]");
    }
    //on regarde valeur
    if (strcmp($mode, "a") == 0) {
      if (intval($val) < 0 || intval($val) > 255) {
        throw new DomotiqueException("en mode analogique, la valeur doit être dans l'intervalle [0,255].");
      }
    } else {
      if (intval($val) < 0 || intval($val) > 1) {
        throw new DomotiqueException("en mode binaire, la valeur doit être 0 ou 1");
      }
    }
    $commande = new Commande();
    $parametres = array(
        "pin" => $pin,
        "mod" => $mode,
        "val" => $val,
    );
    $commande->initWithIdActionParametres($idCommande, "pw", $parametres);
    //on ajoute dans un tableau

    $reponses = $this->sendCommandes($idArduino, array($commande));

    return $reponses[0];
  }

  public function sendCommandes($idArduino, $commandes) {
    if (!array_key_exists($idArduino,$this->getArduinos())){
        throw new DomotiqueException("L'arduino [".$idArduino."] n'existe pas",103);
      }
    return $this->dao->sendCommandes($idArduino, $commandes);
  }

  public function sendCommandesJson($idArduino, $commandes) {
    if (!array_key_exists($idArduino,$this->getArduinos())){
        throw new DomotiqueException("L'arduino [".$idArduino."] n'existe pas",103);
      }
    return $this->dao->sendCommandesJson($idArduino, $commandes);
  }

}

?>
