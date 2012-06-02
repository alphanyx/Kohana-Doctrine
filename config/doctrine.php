<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'connection' => array(
		'driver'   => 'pdo_mysql',
		'dbname'   => 'kohana',
		'host'     => '127.0.0.1',
		'user'     => 'root',
		'password' => 'root',
		'charset' => 'UTF8',
		'driverOptions' => array(
			'charset' => 'UTF8'
		),
	),
	'cache_prefix' => '',
	'customStringFunctions' => array(),
	'customNumericFunctions' => array(),
	'customDatetimeFunctions' => array(),
	'customMappingTypes' => array(),
);
