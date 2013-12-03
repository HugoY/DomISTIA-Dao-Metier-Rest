<?php
class ArduinoController extends CController
{
  public function actionIndex()
    {
		echo 'actionIndex';
    }   
	
public function actionArduinos()
{
echo 'Les arduinos';
}

public function actionBlink(){
	echo "recu : server-rest/arduinos/blink/<".$_GET['idCommand'].">/<".$_GET['ip'].">/<".$_GET['pin'].">/<".$_GET['duree'].">/<".$_GET['temps'].">";
}

}