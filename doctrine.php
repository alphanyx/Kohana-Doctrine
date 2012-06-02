<?php
define('SUPPRESS_REQUEST', true);

include __DIR__ . "/../../public/index.php";

$em = Doctrine::instance();

$cli = new \Symfony\Component\Console\Application('Doctrine Command Line Interface', Doctrine\Common\Version::VERSION);
$cli->setCatchExceptions(true);
$helperSet = $cli->getHelperSet();

$helpers = array(
	'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
	'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em),
	'dialog' => new \Symfony\Component\Console\Helper\DialogHelper(),
);

foreach ($helpers as $name => $helper) {
	$helperSet->set($helper, $name);
}

$cli->addCommands(array(

));

\Doctrine\ORM\Tools\Console\ConsoleRunner::addCommands($cli);

$cli->run();

