<? include("../Codigo/Config.php");include("../Codigo/Funciones.php");

if (isset($_POST[CmdAceptar])){
	if ( (empty($_POST['TxtUsuario'])) or ($_POST['TxtValida1']!=$_POST['TxtValida2']) ){
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
		if(($_POST['TxtValida1']!=$_POST['TxtValida2'])){
		header("Location:../LoginBloqueado.php?&msgE=Por favor revise el código de validación aleatorio");}
		else{header("Location:../LoginBloqueado.php?&msgE=Por favor complete la dirección de correo electrónico");}		
	}else{	
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);		
		//compruebo que exista  usr
		$login = mysql_real_escape_string($_POST['TxtUsuario']);
		$query="SELECT * FROM usuarios WHERE Usuario <> '' and Usuario='$login'" ;$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
		if(mysql_num_rows($rs)!=0){ $existe=1;}else{$existe=0;} mysql_free_result($rs);	
		//envía mail a MailToAlertas(facturacion@)
		$asunto='Solicitud recuperacion de cuenta';$adjunto='';$cuerpo=$_POST['TxtUsuario'].' ha solicitado recuperar su cuenta bloqueada.';
		$resultenvio=EnviarMailAlerta($asunto,$cuerpo,$adjunto,$conn);
		if ($resultenvio==1){$feed="msgC="."Mail enviado. Su pedido será tramitado por CMIT";}
		else{$feed="msgE="."El envío falló, por favor intente nuevamente";}			
		//desconecto
		mysql_close($conn); 	
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}
		header("Location:../LoginBloqueado.php?".$feed);		
	}		
}



elseif (isset($_POST[CmdCancelar])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../InicioIntranet.php");
}




?>


