<?php
namespace App\Controllers;


// $filePath = '../public_html/ratchet/src/Ratchet/Server/IoServer.php';

// if (file_exists($filePath)) {
//     echo "The file '$filePath' exists.";
// } else {
//     echo "The file '$filePath' does not exist.";
// }
// $directoryPath = '../public_html/ratchet/src/Ratchet/';

// if (is_dir($directoryPath)) {
//     $directories = scandir($directoryPath);

//     // Remove . and .. from the directory listing
//     $directories = array_diff($directories, ['.', '..']);

//     if (count($directories) > 0) {
//         echo "Directories in '$directoryPath': <br>";
//         foreach ($directories as $directory) {
//             if (is_dir($directoryPath . $directory)) {
//                 echo $directory . "<br>";
//             }
//         }
//     } else {
//         echo "No directories found in '$directoryPath'.";
//     }
// } else {
//     echo "The path '$directoryPath' is not a directory or does not exist.";
// }

// die();


require_once '../public_html/ratchet/src/Ratchet/Server/IoServer.php';
require_once '../public_html/ratchet/src/Ratchet/Http/HttpServer.php';
require_once '../public_html/ratchet/src/Ratchet/WebSocket/WsServer.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Libraries\Chat;



class Server extends BaseController
{
	public function index()
	{
		$server = IoServer::factory(
			new HttpServer(
				new WsServer(
					new Chat()
				)
			),
			8080
		);
	
// 		$db = db_connect();
// 		$builder  =$db->table('connections');
// 		$builder->where(['c_id >' => 0])->delete();

		$server->run();

	}

	//--------------------------------------------------------------------

}