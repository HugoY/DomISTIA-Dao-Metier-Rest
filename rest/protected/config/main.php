<?php
return array(
	//'name'=>'MyRestApi', // useless without view ? 
    'defaultController'=>'site',
	
	 'components' => array(
		'urlManager'=>array(
			'urlFormat'=>'path',
      'showScriptName'=>false,
			'rules'=>array(
				// REST patterns
				// route => pattern
				array('arduino/arduinos', 'pattern'=>'server-restServer/arduinos/', 'verb'=>'GET'),
				// http://localhost:8080/server-restServer/arduinos/blink/1/192.168.2.3/8/100/20/
				// Fait clignoter la led de la pin n° 8 de l'Arduino identifié par 192.168.2.3
				array('arduino/blink', 'pattern'=>'server-restServer/arduinos/blink/<idCommand>/<ip>/<pin>/<duree>/<nbIter>', 'verb'=>'GET'),
				array('arduino/read', 'pattern'=>'server-restServer/arduinos/pinRead/<idCommand>/<ip>/<pin>/<mode>', 'verb'=>'GET')
				// Other controllers
				//'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
    )
	

);