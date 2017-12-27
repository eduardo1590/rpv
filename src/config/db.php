<?php 
class db{
	 // Variables de conexión
	private $dbhost="127.0.0.1";
    private $dbuser="root";
    private $dbpass="";
    private $dbname="demo_recarga";

    //conectar
    public function conectar(){
    	$conexion_mysql = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $conexionDB = new PDO($conexion_mysql, $this->dbuser, $this->dbpass);
            $conexionDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Esta linea arregla la codificacion sino no aparecen en la salida en JSON quedan NULL
            $conexionDB -> exec("set names utf8");
            return $conexionDB;
    }
}

?>