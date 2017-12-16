<?php

use Domktorymysli\Grenton\Cli\AppContainer;
use Domktorymysli\Grenton\Cli\ExecCommand;
use Domktorymysli\Grenton\Tools\PropertiesLoaderImpl;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\Console\Application;

require __DIR__ . '/../../vendor/autoload.php';

$logger = new Monolog\Logger('simple_client');
$logger->pushHandler(new StreamHandler('simple_client.log', Logger::INFO));
$propertiesLoader = new PropertiesLoaderImpl();
$appContainer = new AppContainer($propertiesLoader, $logger);
$application = new Application('simple_client', '1.0');

$application->addCommands([
    new ExecCommand($appContainer, 'grenton:exec'),
]);

$application->run();
