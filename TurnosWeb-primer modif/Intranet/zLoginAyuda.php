<? include("../Codigo/Config.php");include("../Codigo/Funciones.php");

if (isset($_POST['CmdAceptar'])){
	if ( (empty($_POST['TxtUsuario'])) or ($_POST['TxtValida1']!=$_POST['TxtValida2']) ){
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
		if(($_POST['TxtValida1']!=$_POST['TxtValida2'])){
		header("Location:../LoginAyuda.php?&msgE=Por favor revise el codigo de validacion aleatorio");}
		else{header("Location:../LoginAyuda.php?&msgE=Por favor complete la direccion de correo electronico");}		
	}else{	
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);		
		//compruebo que exista  usr
		$login = mysql_real_escape_string($_POST['TxtUsuario']);
		$query="SELECT * FROM usuarios WHERE Usuario <> '' and Usuario='$login' and Bloqueado=0" ;$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
		if(mysql_num_rows($rs)!=0){ $existe=1;}else{$existe=0;} mysql_free_result($rs);		
		//si existe genero clave y envio mail
		if($existe==1){
			//genero nueva clave
			$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";$longitudCadena=strlen($cadena);$pass="";$longitudPass=8;
			for($i=1 ; $i<=$longitudPass ; $i++){$pos=rand(0,$longitudCadena-1);$pass .= substr($cadena,$pos,1);}
			//encripto y hago update
			$clave=crypt($pass,'otro@letra8');$query="UPDATE usuarios set Password='$clave' Where Usuario='$login'";$rs=mysql_query($query,$conn);
			if($rs){
				//envio mail a usuario
				$a=$_POST['TxtUsuario'];$asunto='Clave de Acceso Sistema de Turnos CMIT';$adjunto='';
				include("../Includes/zMailCuerpoI.php");
				$cuerpo .='Su nueva clave de acceso es: '.$pass;
				include("../Includes/zMailCuerpoF.php");
				$resultenvio=EnviarMailUsuario($a,$asunto,$cuerpo,$adjunto,$conn);
				if ($resultenvio==1){$feed="msgC="."Recibira en este mail su nueva clave de acceso";}else{$feed="msgE="."El envio fallo, por favor intente nuevamente";}
			}else{$feed="msgE="."El cambio de clave fallo, por favor intente nuevamente";}//$rs dio false
		}else{$feed="msgE="."La direccion de EMail no esta registrada";}//$existe==0
		//desconecto
		mysql_close($conn); 	
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}
		header("Location:../InicioIntranet.php?".$feed);
		
	}		
}



elseif (isset($_POST['CmdCancelar'])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../InicioIntranet.php");
}




?>


