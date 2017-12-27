<?php 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Obtener todos los usuarios
$app->get('/api/usuarios', function(Request $request, Response $response){
    $consulta = "SELECT * FROM usuarios";
    try{
        // Instanciar la base de datos
        $db = new db();

        // Conexión
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $usuarios = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        //Exportar y mostrar en formato JSON
        echo json_encode($usuarios);

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Obtener saldo de un usuario
$app->get('/api/saldo/{telefono}', function(Request $request, Response $response){

    //$usr = json_decode($request->getBody());
    $telefono = $request->getAttribute('telefono');
    $consulta = "SELECT saldo FROM usuarios WHERE telefono = ".$telefono;
    try {
    	// Instanciar la base de datos
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $usuarios = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
		echo json_encode($usuarios);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});

//Obtener rol de un usuario
$app->get('/api/rol/{telefono}', function(Request $request, Response $response){

    //$usr = json_decode($request->getBody());
    $telefono = $request->getAttribute('telefono');
    $consulta = "SELECT saldo,tipo FROM usuarios INNER JOIN roles ON usuarios.rol_id = roles.idTipo WHERE usuarios.telefono = ".$telefono;
    try {
    	// Instanciar la base de datos
        $db = new db();
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $usuarios = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;
		echo json_encode($usuarios);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
});


// Agregar Cliente
/*$app->post('/api/clientes/agregar', function(Request $request, Response $response){
    $nombre = $request->getParam('nombre');
    $apellidos = $request->getParam('apellidos');
    $telefono = $request->getParam('telefono');
    $email = $request->getParam('email');
    $direccion = $request->getParam('direccion');
    $ciudad = $request->getParam('ciudad');
    $departamento = $request->getParam('departamento');


    $consulta = "INSERT INTO clientes (nombre, apellidos, telefono, email, direccion, ciudad, departamento) VALUES
    (:nombre, :apellidos, :telefono, :email, :direccion, :ciudad, :departamento)";
    try{
        // Instanciar la base de datos
        $db = new db();

        // Conexión
        $db = $db->conectar();
        $stmt = $db->prepare($consulta);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos',  $apellidos);
        $stmt->bindParam(':telefono',      $telefono);
        $stmt->bindParam(':email',      $email);
        $stmt->bindParam(':direccion',    $direccion);
        $stmt->bindParam(':ciudad',       $ciudad);
        $stmt->bindParam(':departamento',      $departamento);
        $stmt->execute();
        echo '{"notice": {"text": "Cliente agregado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});*/


// Actualizar Cliente
$app->put('/api/saldo/actualizar/{telefono}', function(Request $request, Response $response){
    $telefono= $request->getAttribute('telefono');
    $saldo = $request->getParam('saldo');

    $consulta = "UPDATE usuarios SET saldo = :saldo WHERE telefono = ".$telefono;


    try{
        // Instanciar la base de datos
        $db = new db();

        // Conexion
        $db = $db->conectar();
        $stmt = $db->prepare($consulta);
        $stmt->bindParam(':saldo', $saldo);
        $stmt->execute();
        echo '{"notice": {"text": "Saldo actualizado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


// Borrar cliente
/*$app->delete('/api/clientes/borrar/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $sql = "DELETE FROM clientes WHERE id = $id";
    try{
        // Instanciar la base de datos
        $db = new db();

        // Conexion
        $db = $db->conectar();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Cliente borrado"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});*/
?>