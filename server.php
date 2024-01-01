<?php
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\StatusHandler;

require_once 'ratchet/src/Server/IoServer.php';
require_once 'ratchet/src/Http/HttpServer.php';
require_once 'ratchet/src/WebSocket/WsServer.php';

require_once '../ca_super.com/app/Controllers/StatusHandler.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new StatusHandler()
        )
    ),
    8080 // WebSocket server port, adjust as needed
);

$server->run();

?>
