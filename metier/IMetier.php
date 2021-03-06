<?php

/**
 *
 * @author BIROT
 * 
 * public interface IMetier {
  // liste des arduinos
  public List<Arduino> getArduinos();
  // lecture d'une pin
  public Reponse pinRead(String idCommande, String idArduino, int pin, String mode);
  // écriture d'une pin
  public Reponse pinWrite(String idCommande, String idArduino, int pin, String mode,int val);
  // faire clignoter une led
  public void faireClignoterLed(String idCommande, String idArduino, int pin, int millis, int nbIter);
  // envoyer une suite de commandes Json à un Arduino
  public List<String> sendCommandesJson(String idArduino, List<String> commandes);
  // envoyer une suite de commandes à un Arduino
  public List<Reponse> sendCommandes(String idArduino, List<Commande> commandes);
  }
 */

interface IMetier {
    // liste des arduinos
    public function getArduinos();
    //lecture pin
    public function pinRead($idCommande, $idArduino,$pin,$mode);
    //ecriture pin
    public function pinWrite($idCommande, $idArduino,$pin,$mode,$val);
    //faire clignoter une led
    public function faireClignoterLed($idCommande, $idArduino,$pin,$millis,$nbIter);
    // envoyer une suite de commandes Json à un Arduino
    public function sendCommandesJson($idArduino, $commandes);
    // envoyer une suite de commandes à un Arduino
    public function sendCommandes($idArduino, $commandes);


}

?>
