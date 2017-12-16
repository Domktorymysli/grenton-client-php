<?php

use Domktorymysli\Grenton\Cli\AppContainer;
use Domktorymysli\Grenton\Command\CluFunctionCommand;
use Domktorymysli\Grenton\Tools\PropertiesLoaderImpl;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require __DIR__ . '/../../vendor/autoload.php';

$logger = new Monolog\Logger('simple-client');
$logger->pushHandler(new StreamHandler('hello_world.log', Logger::INFO));
$propertiesLoader = new PropertiesLoaderImpl();
$appContainer = new AppContainer($propertiesLoader, $logger);

$command = new CluFunctionCommand("192.168.1.1", "hello_world", []);
$propertiesFile = __DIR__ . '/../properties-dist.xml';

try {
    echo "Wysylanie wiadomosci: {$command->getCommand()}\n";
    $response = $appContainer->getApi($propertiesFile)->send($command);
    echo "Odebrano wiadomosc: {$response->getBody()}\n";
} catch (\Exception $e) {
    $appContainer->getLogger()->error($e);
    echo "Wystapil blad: {$e->getMessage()}";
}
