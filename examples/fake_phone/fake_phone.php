<?php

use Domktorymysli\Grenton\Cli\AppContainer;
use Domktorymysli\Grenton\Command\CluRawCommand;
use Domktorymysli\Grenton\Tools\PropertiesLoaderImpl;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require __DIR__ . '/../../vendor/autoload.php';

$logger = new Logger('fake-phone');
$logger->pushHandler(new StreamHandler('fake_phone.log', Logger::INFO));
$propertiesLoader = new PropertiesLoaderImpl();
$appContainer = new AppContainer($propertiesLoader, $logger);

$command = new CluRawCommand("req:192.168.2.100:00e741:SYSTEM:clientRegister(\"192.168.2.100\",4000,100,{{DOUT_6848,0}})");

$propertiesFile = __DIR__ . '/../properties-dist.xml';

try {
    echo "Wysylanie wiadomosci: {$command->getCommand()}\n";
    $response = $appContainer->getApi($propertiesFile)->send($command);
    echo "Odebrano wiadomosc: {$response->getBody()}\n";
} catch (\Exception $e) {
    $appContainer->getLogger()->error($e);
    echo "Wystapil blad: {$e->getMessage()}\n";
}

set_time_limit(0);
ob_implicit_flush();

$address = "192.168.2.100";
$port = 4000;

if (($sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)) === false) {
    die("socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n");
}

if (socket_bind($sock, $address, $port) === false) {
    die("socket_bind() failed: reason: " . socket_strerror(socket_last_error($sock)) . "\n");
}

echo "Nasłuchiwanie na {$address}:{$port}\n";
echo "Ctrl+c aby zakończyć\n";

do {

    $r = socket_recv($sock, $buf, 2048, 0);

    echo "{$buf}\n"; // zakodowana odpowiedź.

} while (true);
