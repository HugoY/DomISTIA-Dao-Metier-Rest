<?php
return array(
	//'name'=>'MyRestApi', // useless without view ? 
    'defaultController'=>'site',
	
	 'components' => array(
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				// REST patterns
				// route => pattern
				array('arduino/arduinos', 'pattern'=>'server-restServer/arduinos/', 'verb'=>'GET'),
				// http://localhost:8080/server-restServer/arduinos/blink/1/192.168.2.3/8/100/20/
				// Fait clignoter la led de la pin n° 8 de l'Arduino identifié par 192.168.2.3
				array('arduino/blink', 'pattern'=>'server-restServer/arduinos/blink/<idCommand>/<ip>/<pin>/<duree>/<temps>', 'verb'=>'GET'),
				//array('api/update', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
				//array('api/delete', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
				//array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'),
				// Other controllers
				//'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
    )
	

);