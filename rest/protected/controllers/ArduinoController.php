<?php
header("Access-Control-Allow-Origin: *"); // Pour que ça fonctionne avec les appel ajax (goupe voisin deumié)
//require_once(dirname(__FILE__) . '/../../../metier/MetierSimulation.php');
require_once(dirname(__FILE__) . '/../../../metier/Metier.php');
require_once (dirname(__FILE__) . '/../../../entities/DomotiqueException.php');

class ArduinoController extends CController {

  private $metier;

  protected function beforeAction($action) {    
    $this->metier = Metier::getInstance();
    return true;
  }

  public function actionIndex() {
    echo 'actionIndex';
  }

  public function actionArduinos() {
    $arduinoArray = array();

    foreach ($this->metier->getArduinos() as $a) {
      $arduinoArray[] = $a->toArray();
    }
    $reponse = ["data" => $arduinoArray];
    echo json_encode($reponse);
  }

  public function actionBlink() {
    try {
      $this->metier->faireClignoterLed($_GET['idCommand'], $_GET['ip'], $_GET['pin'], $_GET['duree'], $_GET['nbIter']);
      $reponse = array("id" => $_GET['idCommand'],
          "erreur" => "0",
          "etat" => "{}",
          "json" => NULL
      );
      $reponseArray = array("data" => $reponse);
    } catch (DomotiqueException $e) {
      $reponseArray = array("message" => utf8_encode($e->getMessage()),
          "erreur" => $e->getCode()
      );
    }

    echo json_encode($reponseArray);
  }

  public function actionRead() {
    try {
      $reponse = $this->metier->pinRead($_GET['idCommand'], $_GET['ip'], $_GET['pin'], $_GET['mode']);
      $reponse2 = array("id" => $reponse->getId(),
          "erreur" => $reponse->getErreur(),
          "etat" => $reponse->getEtat(),
          "json" => NULL
      );
      $reponseArray = array("data" => $reponse2);
    } catch (Exception $e) {
      $reponseArray = array("message" => utf8_encode($e->getMessage()),
          "erreur" => $e->getCode()
      );
    }

    echo json_encode($reponseArray);
  }

  public function actionWrite() {
    try {
      $reponse = $this->metier->pinWrite($_GET['idCommand'], $_GET['ip'], $_GET['pin'], $_GET['mode'], $_GET['valeur']);
      $reponse2 = array("id" => $reponse->getId(),
          "erreur" => $reponse->getErreur(),
          "etat" => $reponse->getEtat(),
          "json" => NULL
      );
      $reponseArray = array("data" => $reponse2);
    } catch (Exception $e) {
      $reponseArray = array("message" => utf8_encode($e->getMessage()),
          "erreur" => $e->getCode()
      );
    }

    echo json_encode($reponseArray);
  }

  public function actionCommande() {
    
    $commande = file_get_contents('php://input');
    try {
      $reponse = $this->metier->sendCommandesJson($_GET['ip'], $commande);
      $reponse2 = array("id" => $reponse->getId(),
          "erreur" => $reponse->getErreur(),
          "etat" => $reponse->getEtat(),
          "json" => NULL
      );
      $reponseArray = array("data" => $reponse2);
    } catch (Exception $e) {
      $reponseArray = array("message" => $e->getMessage(),
          "erreur" => $e->getCode()
      );
    }

    echo json_encode($reponseArray);    
    
  }
}
