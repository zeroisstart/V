<?php

return array (
		'user' => array (
				// enable cookie-based authentication
				'class' => 'application.components.WebUser',
				'allowAutoLogin' => true 
		),
		'Folder' => array (
				'class' => 'components.System.Folder' 
		),
		'clientScript' => array (
				// 'class'=>'ext.dwz.DClientScript',
				'class' => 'components.System.ClientScript' 
		),
		// uncomment the following to enable URLs in path-format
		'urlManager' => array (
				'urlFormat' => 'path',
				'showScriptName' => false,
				//'caseSensitive'=>false,
				'rules' => require 'routes.php' 
		),
		// uncomment the following to use a MySQL database
		'db' => array (
				'connectionString' => 'mysql:host=localhost;dbname=',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8' 
		),
		/*'errorHandler' => array (
				'errorAction' => 'Top/error' 
		),*/
		'log' => array (
				'class' => 'CLogRouter',
				'routes' => array (
						array (
								'class' => 'CFileLogRoute',
								'levels' => 'error, warning' 
						) 
				) 
		),
		'switchDB' => array (
				'class' => 'application.components.System.switchDB' 
		),
		'text' => array (
				'class' => 'application.components.TextComponent' 
		) 
);