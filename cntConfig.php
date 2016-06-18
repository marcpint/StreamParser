<?php
$i = 0;				//Contador archivos 	
$cont = 0;			//Contador Intervalo flush

$intFlush = 5000; 		//Intervalo de actualizacion a pantallla en cantidad de registros.
$maxBytesLectura = 65535; 	//Largo maximo para busqueda de fin de linea.

$cantidadLineas = 10700; 	//Cantidad estimada de lineas por archivo. default 16 millones.

$env = 'PROD';			//[DEV,PROD]
$tabla_registros = 'television.parque';		//nombe [esquema].[tabla]
$vaciar_tabla = true;		//Vacia la tabla al comenzar el script.


?>