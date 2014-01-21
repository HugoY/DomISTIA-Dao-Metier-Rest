<?php

interface IDao {

    public function getArduinos();

    // public function addArduino($arduino);
    //public function removeArduino($idArduino);

    public function sendCommandes($idArduino, $commandes);

    public function sendCommandesJson($idArduino, $commandes);
}
