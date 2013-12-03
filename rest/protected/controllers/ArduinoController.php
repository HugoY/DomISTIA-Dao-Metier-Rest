<?php

require_once(dirname(__FILE__) . '/../../../metier/MetierSimulation.php');

class ArduinoController extends CController {

    public function actionIndex() {
        echo 'actionIndex';
    }

    public function actionArduinos() {
        // Couche métier
        /*if (apc_exists('app:couche_metier') !== false) {
            $metier = apc_get('app:couche_metier');
        } else {
            try {
                $metier = new Metier();
            } catch (DomotiqueException $e) {
                echo"L'erreur suivante s'est produite : " . $e->getMessage();
                exit();
            }
            apc_store('app:couche_metier', $metier);
        }*/
        $metier = new MetierSimulation();
        //var_dump($metier->getArduinos());
        $arduinoArray = array(); 
        foreach ($metier->getArduinos() as $a){
            $arduinoArray[]=$a->toArray();
        }
        echo json_encode($arduinoArray);
    }

    public function actionBlink() {
        echo "recu : server-rest/arduinos/blink/<" . $_GET['idCommand'] . ">/<" . $_GET['ip'] . ">/<" . $_GET['pin'] . ">/<" . $_GET['duree'] . ">/<" . $_GET['temps'] . ">";
    }

}
