<?php

class clsUtil
{
    /**
    * Output time diff between two microtime set true.
    *
    * @param $mtDiff microtime Diferencia en microtime
    */
    function obtenerSiguienteRegistro()
    {
	
    }
    
    /**
    * Output time diff between two microtime set true.
    *
    * @param $mtDiff microtime Diferencia en microtime
    */
    function validarArchivo($file_name)
    {
	  $limitedext = array(".xls", ".xlsx",".txt");
          if (strlen($file_name) > 0)
    	     {
           	
           		
                    $ext = strrchr($file_name, '.') ;
                    
                     
                	if (!in_array(strtolower($ext), $limitedext))
                	{
                			echo "Documento: ($file_name) tiene una extensión incorrecta <br>" ;
                			return false;
                	}
                	else
                	{
                	return true;
                	}
                }	
    }
    
    
    
    /**
    * Output time diff between two microtime set true.
    *
    * @param $mtDiff microtime Diferencia en microtime
    */
    function tsFromMicrotime($mtDiff)
    {
      $hours = (int)($minutes = (int)($seconds = (int)($milliseconds = (int)($mtDiff * 1000)) / 1000) / 60) / 60;
      //return $hours.':'.($minutes%60).':'.($seconds%60).(($milliseconds===0)?'':'.'.rtrim($milliseconds%1000, '0'));
      return round($hours, 0, PHP_ROUND_HALF_DOWN).':'.round(($minutes%60), 0, PHP_ROUND_HALF_DOWN).':'.round(($seconds%60), 0, PHP_ROUND_HALF_DOWN);
    }
    
    /**
    * Output div with progress.
    *
    * @param $lnActual    integer   Actual linea en proceso
    * @param $lnTotal     integer   Total de lineas segun config
    * @param $flArchivo   String    Nombre archivo procesado
    * @param $mtTiempo    microtime Tiempo transcurrido (formateado)
    */
    function outputProgress($lnActual, $lnTotal, $flArchivo, $mtTiempo) {
	$str_div = "
    <div style='position: absolute;z-index:$lnActual;background:#FFF;'>
      <table border=1>
	      <tr>
		<td colspan='2' align='center'>$flArchivo</td>
	      </tr>
	      <tr>
		<td align='center'>Status</td><td align='center'>a procesar</td>
	      </tr>
	      <tr>
		<td align='center'>Importando...</td><td align='center'>$lnTotal</td>
	      </tr>
	      <tr>
		<td align='center'>Insertados</td><td>Tiempo</td>
	      </tr>	  
	      <tr>
		<td align='center'>$lnActual</td><td align='center'>$mtTiempo</td>
	      </tr>	  
	      <tr>
		<td colspan='2' align='center'>$lnActual / $lnTotal</td>
	      </tr>	  
	      <tr>
		<td colspan='2' align='center'>".round($lnActual / $lnTotal * 100)."%</td>
	      </tr>	  
      </table>
    </div>    
	";
	echo $str_div;
    
}     
}
?>