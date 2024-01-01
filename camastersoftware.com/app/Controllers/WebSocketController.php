<?php
namespace App\Controllers;

class WebSocketController extends BaseController
{
    public function startServer() {
        $command = 'php ../../public_htmlserver.php'; // Replace with the path to your server.php file

        // Execute the command to start the WebSocket server
        exec($command, $output, $returnCode);

        if ($returnCode === 0) {
            echo "WebSocket server started successfully!";
        } else {
            echo "Failed to start WebSocket server.";
        }
    }
}
