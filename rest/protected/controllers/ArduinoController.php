<?php

require_once(dirname(__FILE__) . '/../../../metier/MetierSimulation.php');

class ArduinoController extends CController {

  private $metier;
  
  protected function beforeAction($action) {
    $this->metier = MetierSimulation::getInstance();
    return true;
  }

  public function actionIndex() {
    echo 'actionIndex';
  }

  public function actionArduinos() {
    // Couche métier
    $arduinoArray = array();
    foreach ($this->metier->getArduinos() as $a) {
      $arduinoArray[] = $a->toArray();
    }
    $reponse = ["data" => $arduinoArray];
    echo json_encode($reponse);
  }

  public function actionBlink() {
    echo "recu : server-rest/arduinos/blink/<" . $_GET['idCommand'] . ">/<" . $_GET['ip'] . ">/<" . $_GET['pin'] . ">/<" . $_GET['duree'] . ">/<" . $_GET['temps'] . ">";
  }

}
