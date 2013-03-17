<?php
return array (
		'' => 'Home/main/index',
		'/' => 'Home/main/index',
		
		'admin' =>'Admin/main/main',
		
		'register' => 'UserCenter/register/register',
		'login' => 'UserCenter/login/login',
		'logout' => 'UserCenter/login/logout',
		'account' => 'UserCenter/login/login',
		
		'<controller:\w+>/<id:\d+>' => '<controller>/view',
		'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
		'<controller:\w+>/<action:\w+>' => '<controller>/<action>' 
);