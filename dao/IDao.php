<?php

/**
 *
 * @author usrlocal
 */
interface IDao {
/*
 * // liste des Arduinos
public Collection<Arduino> getArduinos();
// ajout d'un arduino
public void addArduino(Arduino arduino);
// suppression d'un arduino
public void removeArduino(String idArduino);
// envoyer une suite de commandes à un Arduino
public List<Reponse> sendCommandes(String idArduino, List<Commande> commandes);
// envoyer une suite de commandes Json à un Arduino
public List<String> sendCommandesJson(String idArduino, List<String> commandes);
 */
  
  public function getArduinos();
  public function addArduino($arduino);
  public function removeArduino($arduino);
  public function sendCommandes($idArduino, $commandes);
  public function sendCommandesJson($idArduino, $commandes);
}

?>
