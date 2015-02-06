<?php

use Doctrine\ORM\EntityManager,
Doctrine\ORM\Configuration,
Doctrine\DBAL\Types\Type;;

class Doctrine {

	/**
	 * EntityManager instance
	 */
	private static $em = false;

	/**
	 * Get EntityManager instance
	 */
	public static function instance() {
		if(!self::$em) {
			self::$em = self::init();
		}

		return self::$em;
	}

	public static function init() {

		$configObject = Kohana::$config->load('doctrine');

		$cache = new \Doctrine\Common\Cache\ArrayCache;

		$cache->setNamespace($configObject->get('cache_prefix'));

		$config = new Configuration;
		$config->setMetadataCacheImpl($cache);
		$config->setQueryCacheImpl($cache);

		$config->setResultCacheImpl($cache);

		$config->setMetadataDriverImpl($config->newDefaultAnnotationDriver(APPPATH . 'classes/model'));

		$config->setProxyDir(Kohana::$cache_dir . '/doctrine/proxies');
		$config->setProxyNamespace('Proxies');

		if (Kohana::$environment == Kohana::DEVELOPMENT) {
			$config->setAutoGenerateProxyClasses(true);
		} else {
			$config->setAutoGenerateProxyClasses(false);
		}

		if($configObject->get('customStringFunctions')) {
			foreach($configObject->get('customStringFunctions') as $name => $class) {
				$config->addCustomStringFunction($name, $class);
			};
		}

		if($configObject->get('customNumericunctions')) {
			foreach($configObject->get('customNumericunctions') as $name => $class) {
				$config->addCustomNumericFunction($name, $class);
			};
		}

		if($configObject->get('customDatetimeFunctions')) {
			foreach($configObject->get('customDatetimeFunctions') as $name => $class) {
				$config->addCustomDatetimeFunction($name, $class);
			};
		}


		if($configObject->get('customMappingTypes')) {
			foreach($configObject->get('customMappingTypes') as $name => $class) {
				Type::addType($name, $class);
			};
		}

		$em = EntityManager::create($configObject->get('connection'), $config);

		return $em;
	}
}
