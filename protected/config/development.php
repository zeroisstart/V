<?php
return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
        array(
        'components' => array(
            'db' => array(
		        'connectionString' => 'mysql:host=localhost;dbname=pingfan',
            	'tablePrefix'      =>'tbl_',
		        'emulatePrepare'   => true,
		        'username'         => 'root',
		        'password'         => '1',
		        'charset'          => 'utf8',
		        'enableProfiling'  => true,
	        )
	    ) 
    )
);

