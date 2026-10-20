<?php 
//Inicio la sesion
if(!isset($_SESSION)) { session_start(); } 

//comprueba empresa logueada 
if($_SESSION["GLO_ValidaEmpresa"]!='CmitTurnos 5534569823'){
		header('Location:'.'http://' . $_SERVER['HTTP_HOST'] . '/TurnosWeb.php');//envio a la pagina de autentificacion     
		session_destroy(); // destruyo la sesion
		exit();//ademas salgo de este script   
}else{
	//comprueba usuario autentificado
	if ($_SESSION["autentificado"] != "SI") { 	  
		  header('Location:'.'http://' . $_SERVER['HTTP_HOST'] . '/TurnosWeb.php');//envio a la pagina de autentificacion    
		exit();}//ademas salgo de este script   
	else {
		 //calculamos el tiempo transcurrido
		$fechaGuardada = $_SESSION["ultimoAcceso"];
		$ahora = date("Y-n-j H:i:s");
		$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
	
		//comparamos el tiempo transcurrido en segundos
		 if($tiempo_transcurrido >= 1800) {//media hora
		 //si pasaron x minutos 
		  header('Location:'.'http://' . $_SERVER['HTTP_HOST'] . '/TurnosWeb.php');//envio a la pagina de autentificacion    
		  //sino, actualizo la fecha de la sesion
		  session_destroy(); // destruyo la sesion
		}else {
		$_SESSION["ultimoAcceso"] = $ahora;
	   } 
	}	
}
?>
