<?php
include "base_datos.php";

class dao {

    protected $servidor;
    private $_gLink;

    public function __construct($servidor) {
        $_gLink = new baseDatos($servidor);
        $this->_gLink;
    }

    public function __destruct() {
        unset($this->_gLink);
        unset($this->servidor);
    }
    /*
    public function consultarUltimoRegistro() {
        $res = pg_query("SELECT area, num_com, ps FROM parque order by id desc limit 1;");
        return $res;
    }
    */
    
    public function ejecutarQuery($qry) {
        $res = pg_query($qry);
        return $res;
    }
}
