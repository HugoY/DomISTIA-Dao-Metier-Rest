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
                "etat" => new stdClass(),
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
        //récupère le post
        $commandes = file_get_contents('php://input');
        //décode du json. On obtient un tableau
        $commandedecodes = json_decode($commandes);       
        if  (json_last_error() != JSON_ERROR_NONE){
            $reponseArray = array("message" => json_last_error_msg(),
                "erreur" => json_last_error());
            echo json_encode($reponseArray);
            return ;
        }
        $lescommandes = array();
        //on parcourt le tableau décodé pour ajouté chaque commande dans un autre tableau
        for ($i = 0; $i < count($commandedecodes); $i++) {
            //on code en json les élément du tableaux
            if (!is_array($commandedecodes)) {
                $reponseArray = array("message" => "veuillez mettre dans un tableau",
                "erreur" => "10");
                echo json_encode($reponseArray);
                return ;
            }

            $laCommande = json_encode($commandedecodes[$i]);
            $lescommandes[] = $laCommande;
        }
        try {
            $reponse = $this->metier->sendCommandesJson($_GET['ip'], $lescommandes);
            $reponse2 = array();
            foreach ($reponse as $a) {
                $reponse2[] = json_decode($a);
            }
            $reponseArray = array("data" => $reponse2);
        } catch (Exception $e) {
            //echo "catch";
            $reponseArray = array("message" => $e->getMessage(),
                "erreur" => $e->getCode()
            );
        }
        echo json_encode($reponseArray);
    }

}
