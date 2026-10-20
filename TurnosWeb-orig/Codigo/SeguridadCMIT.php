<?php 
//Inicio la sesión
if(!isset($_SESSION)) { session_start(); } 

//comprueba empresa logueada 
if($_SESSION["GLO_ValidaEmpresa"]!='Cmit 4145656963'){
		header('Location:'.'http://' . $_SERVER['HTTP_HOST'] . '/TurnosWebCMIT.php');//envio a la página de autentificacion     
		session_destroy(); // destruyo la sesión
		exit();//ademas salgo de este script   
}else{
	//comprueba usuario autentificado
	if ($_SESSION["autentificado"] != "SI") { 	  
		  header('Location:'.'http://' . $_SERVER['HTTP_HOST'] . '/TurnosWebCMIT.php');//envio a la página de autentificacion    
		exit();}//ademas salgo de este script   
	else {
		 //calculamos el tiempo transcurrido
		$fechaGuardada = $_SESSION["ultimoAcceso"];
		$ahora = date("Y-n-j H:i:s");
		$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
	
		//comparamos el tiempo transcurrido en segundos
		 if($tiempo_transcurrido >= 3800) {
		 //si pasaron x minutos 
		  header('Location:'.'http://' . $_SERVER['HTTP_HOST'] . '/TurnosWebCMIT.php');//envio a la página de autentificacion    
		  //sino, actualizo la fecha de la sesión
		  session_destroy(); // destruyo la sesión
		}else {
		$_SESSION["ultimoAcceso"] = $ahora;
	   } 
	}	
}
?>
