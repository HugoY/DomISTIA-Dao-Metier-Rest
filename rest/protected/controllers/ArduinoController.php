<?php

require_once(dirname(__FILE__) . '/../../../metier/MetierSimulation.php');
require_once (dirname(__FILE__) .'/../../../entities/DomotiqueException.php');

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
        
        $metier = new MetierSimulation();
        //var_dump($metier->getArduinos());
        try{
          $metier->faireClignoterLed($_GET['idCommand'] , $_GET['ip'], $_GET['pin'], $_GET['duree'],$_GET['nbIter']);
          $reponse=array("id"=>$_GET['idCommand'],
                          "erreur"=>"0",
                          "etat"=> array(),
                          "json"=>NULL             
              
              );
          $reponseArray=array("data"=>$reponse);
        }catch(Exception $e){
          $reponseArray=array("message"=>$e->getMessage(),
                          "erreur"=>$e->getCode()
              
              );
        }
        
        echo json_encode($reponseArray);
       
    }
    
    public function actionRead() {
        
        $metier = new MetierSimulation();
        //var_dump($metier->getArduinos());
        try{
          $reponse=$metier->pinRead($_GET['idCommand'] , $_GET['ip'], $_GET['pin'], $_GET['mode']);
          $reponseArray=array("data"=>$reponse->getJson());
        }catch(Exception $e){
          $reponseArray=array("message"=>$e->getMessage(),
                          "erreur"=>$e->getCode()
              
              );
        }
        
        echo json_encode($reponseArray);
       
    }

}
