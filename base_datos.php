<?php
class baseDatos{
	protected $servidor;
	private $_link;
	public function __construct($servidor){
		$bases_datos = array("postgresql_local" => array("driver" => "pgsql","host" => "localhost", "bdname" => "mario_file", "user" => "postgres", "pass" => "postgres")); //hp
		//$bases_datos = array("postgresql_local" => array("driver" => "pgsql","host" => "localhost", "bdname" => "msoto", "user" => "msoto", "pass" => "msoto")); //lenovo

		if (@$bases_datos[$servidor]["driver"]=="pgsql"){

		    $link = pg_connect("host=".$bases_datos[$servidor]["host"]." port=5432 user=".$bases_datos[$servidor]["user"]." dbname=".$bases_datos[$servidor]["bdname"]." password=".$bases_datos[$servidor]["pass"]);
		    if (!$link) {
			die('error conectando a PGSQL'.$bases_datos[$servidor]["host"]);
		    }
		    pg_set_client_encoding($link, "LATIN1");	


		}
		$this->_link;
	}

	public function __destruct()
	{
		try {
			if($this->_link){
				pg_close($this->_link);
			}
		} catch (Exception $e) {

		}
	}
}
?>
