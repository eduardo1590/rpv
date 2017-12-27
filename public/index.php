<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

//CREAR LAS RUTAS PARA LOS CLIENTES
require "../src/rutas/usuarios.php";

$app->run();

/*function getConnection() {
    $dbhost="127.0.0.1";
    $dbuser="root";
    $dbpass="";
    $dbname="demo_recarga";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

function obtenerSaldo($request) {
	$usr = json_decode($request->getBody());
    $telefono = $request->getAttribute('telefono');
    $sql = "SELECT saldo FROM usuarios WHERE telefono = ".$telefono;
    try {
        $stmt = getConnection()->query($sql);
        $employees = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
		echo json_encode($usr);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function actualizarSaldo($request) {
    $usr = json_decode($request->getBody());
    $telefono = $request->getAttribute('telefono');
    $sql = "UPDATE usuarios SET saldo=:saldo WHERE telefono=:telefono";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam("saldo", $usr->saldo);
        $stmt->bindParam("telefono", $telefono);
        $stmt->execute();
        $db = null;
        echo json_encode($usr);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

$corsOptions = array(
    "origin" => "*",
    "exposeHeaders" => array("Content-Type", "X-Requested-With", "X-authentication", "X-client"),
    "allowMethods" => array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS')
);
$cors = new \CorsSlim\CorsSlim($corsOptions);
*/
?>