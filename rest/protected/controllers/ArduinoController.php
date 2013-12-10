<?php

require_once(dirname(__FILE__) . '/../../../metier/MetierSimulation.php');

class ArduinoController extends CController {

    public function actionIndex() {
        echo 'actionIndex';
    }

    public function actionArduinos() {
        // Couche métier
        $metier = new MetierSimulation();
        //var_dump($metier->getArduinos());
        $arduinoArray = array();         
        foreach ($metier->getArduinos() as $a){
            $arduinoArray[]=$a->toArray();
        }
        $reponse = ["data" => $arduinoArray];
        echo json_encode($reponse);
    }

    public function actionBlink() {
        echo "recu : server-rest/arduinos/blink/<" . $_GET['idCommand'] . ">/<" . $_GET['ip'] . ">/<" . $_GET['pin'] . ">/<" . $_GET['duree'] . ">/<" . $_GET['temps'] . ">";
    }

}
