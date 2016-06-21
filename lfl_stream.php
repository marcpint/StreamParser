<?php
/**
 * eMarketing
 *
 * @author		    : E&M Consulting Limitada
 * @software		: eMarketing
 * @copyright		: Copyright 2010-2016, E&M Consulting Limitada
 * @package         : Sistema de Gestión de Marketing 
 * @filesource      : carga_parque.php,v1.00.0.1 2012 -  E&M Consulting Limitada
 * @access          :
 * @license         :
 * /*********************************************************************************
 *
 *                            TERMINOS DE USO Y CONDICIONES
 *
 * La aplicación eMarketing es propiedad intelectual de E&M Consulting Limitada
 * La licencia de uso está concedida al usuario final de la aplicación el cual no
 * puede ceder, copiar, distribuir o vender la aplicación sin concentimiento escrito
 * de E&M Consulting Limitada.
 *
 * El registro de la propiedad Intelectual de eMarketing, así como la marca eMarketing, el código PHP, iconos, 
 * estilos, código HTML , código javascript, está en trámite.
 *
 *
 * El Codigo de este paquete es propiedad de : E&M Consulting Limitada
 *
 * eMarketing es propiedad de : Gerencia de Publicidad y Medios - Movistar
 * 
 * Queda estrictamente prohibida la copia , eliminacion y/o modificación del código PHP, iconos, estilos, código HTML , 
 * código javascript de este sistema y todo lo relacionado con el modelo físico y lógico de la base de datos.
 *
 * (c)2010-2016-2016 - Todos los derechos reservados
 *
 ********************************************************************************/
include realpath(dirname(__FILE__)).'/cntConfig.php';
include realpath(dirname(__FILE__)).'/clsUtil.php';
include realpath(dirname(__FILE__)).'/dao.php';

$util = new clsUtil();
$dao  = new dao("postgresql_local");

$directorio = "tmp/";
$archivo = $directorio . basename($_FILES["uploaded_file"]["name"]);


if (move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $archivo))
{

}else{
        echo "Error: No se pudo copiar el archivo.";
        die();
}


$time_start = microtime(true);

if ($env == 'PROD'){
  if(!$util->validarArchivo($_FILES['uploaded_file']['name'])){
    die();
  }
  $siguienteregistro = $util->obtenerSiguienteRegistro();
}
$handle = fopen($_FILES['uploaded_file']['name'], 'r');

$stSQL = "";
if ($handle) {
 while($name=stream_get_line($handle,$maxBytesLectura,"\n")){
 
    if ($env == 'PROD'){
	$area=substr($name,0,3);
	$num_com=substr($name,3,8);
	$ps=substr($name,11,10);
	$desc_ps=substr($name,21,30);
	$fiv=substr($name,51,10);
	$ffv=substr($name,61,10);
	$oc=substr($name,71,10);
	$desc_oc=substr($name,81,30);
	$fiv_oc=substr($name,111,10);
	$ffv_oc=substr($name,121,10);
	$reg=substr($name,131,1);    
    }else{
	$name = '002020106480000006026PLAN PREFERIDO TVD            2012-06-162012-06-250000000002BAJA SIN CARGO                2012-06-259999-01-01P';
 	$area=substr($name,0,3);
	$num_com=substr($name,3,8);
	$ps=substr($name,11,10);
	$desc_ps=substr($name,21,30);
	$fiv=substr($name,51,10);
	$ffv=substr($name,61,10);
	$oc=substr($name,71,10);
	$desc_oc=substr($name,81,30);
	$fiv_oc=substr($name,111,10);
	$ffv_oc=substr($name,121,10);
	$reg=substr($name,131,1);   
    }


                                      
	$stSQL.="INSERT INTO $tabla_registros (area,  num_com,  ps,  desc_ps,  fiv,  ffv,  oc,  desc_oc,  fiv_oc,  ffv_oc) VALUES ($area,$num_com,$ps,'$desc_ps','$fiv','$ffv',$oc,'$desc_oc','$fiv_oc','$ffv_oc');";
		
        if($cont > $intFlush){
	  $dao->ejecutarQuery($stSQL);
	  $util->outputProgress($i, $cantidadLineas, $_FILES['uploaded_file']['name'],$util->tsFromMicrotime($time));
	  ob_flush();
	  flush();
	  $cont = 0;
	  $stSQL = "";
        }
        $i++;
        $cont++;
        unset($name);
        $time_end = microtime(true);
        $time = $time_end - $time_start;
    }
    if($cont > 0){
	  $dao->ejecutarQuery($stSQL);
	  $util->outputProgress($i, $cantidadLineas, $_FILES['uploaded_file']['name'],$util->tsFromMicrotime($time));
	  ob_flush();
	  flush();
	  $cont = 0;
	  $stSQL = "";    
    }
    fclose($handle);
    ob_end_flush();
    unset($dao);
}  
?>