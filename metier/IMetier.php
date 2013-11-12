<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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
    //put your code here
    public function getArduino();
    public function pinRead($idCommande, $idArduino,$pin,$mode);


}

?>
