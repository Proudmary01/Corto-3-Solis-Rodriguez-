<?php

// If there is no constant defined called __CONFIG__, do not load this file 
if(!defined('__CONFIG__')) {
	exit('You do not have a config file');
}

class DB {

	protected static $con;

	private function __construct() {

		try {
			$serverName = "HP1000\JOSUSOLS"; //serverName\instanceName

			// Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
			// La conexión se intentará utilizando la autenticación Windows.
			$connectionInfo = array( "Database"=>"ControlProyectos");
			self::$con = sqlsrv_connect( $serverName, $connectionInfo);

			if( !self::$con ) {
			     //echo "Conexión establecida.<br />";
				echo "Conexión no se pudo establecer.<br />";
			     die( print_r( sqlsrv_errors(), true));
			}

			/*self::$con = new PDO( 'mysql:charset=utf8mb4;host=localhost;port=3306;dbname=login_course', 'root', '' );
			self::$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			self::$con->setAttribute( PDO::ATTR_PERSISTENT, false );
			self::$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);*/
		} catch (PDOException $e) {
			echo "Could not connect to database."; exit;
		}

	}


	public static function getConnection() {

		if (!self::$con) {
			new DB();
		}

		return self::$con;
	}
}

?>
