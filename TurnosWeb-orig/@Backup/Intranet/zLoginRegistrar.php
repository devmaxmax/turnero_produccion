<? include("../Codigo/Config.php");include("../Codigo/Funciones.php");

if(!isset($_SESSION)) { session_start(); } 

if (isset($_POST[CmdAceptar])){
	// valida datos requeridos y captcha
	if ((empty($_POST['TxtUsuario'])) or (empty($_POST['TxtNombre'])) or (empty($_POST['TxtApellido'])) or (empty($_POST['TxtTel'])) or ($_POST['TxtValida1']!=$_POST['TxtValida2'])  or (empty($_POST['TxtRSF'])) or (empty($_POST['TxtDomiF']))  or (empty($_POST['TxtPciaF'])) ){	
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
		if(($_POST['TxtValida1']!=$_POST['TxtValida2'])){
		header("Location:../LoginRegistrar.php?&msgE=Por favor revise el código de validación aleatorio");}
		else{header("Location:../LoginRegistrar.php?&msgE=Por favor complete los datos requeridos");}
	}else{	
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		//grabar los datos en la tabla
		$usr=mysql_real_escape_string(ltrim($_POST['TxtUsuario']));
		$nom=mysql_real_escape_string(ltrim($_POST['TxtNombre']));
		$ap=mysql_real_escape_string(ltrim($_POST['TxtApellido']));
		$tel=mysql_real_escape_string(ltrim($_POST['TxtTel']));
		$fa=FechaMySql(date("d-m-Y"));
		$rsf=mysql_real_escape_string(ltrim($_POST['TxtRSF']));
		$cuit=mysql_real_escape_string(ltrim($_POST['TxtCUITF']));
		$dom=mysql_real_escape_string(ltrim($_POST['TxtDomiF']));
		$pcia=mysql_real_escape_string(ltrim($_POST['TxtPciaF']));
		$nf=mysql_real_escape_string(ltrim($_POST['TxtNFF']));
		$rsp='';
		//genero nueva contraseña
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";$longitudCadena=strlen($cadena);$pass="";$longitudPass=8;
		for($i=1 ; $i<=$longitudPass ; $i++){$pos=rand(0,$longitudCadena-1);$pass .= substr($cadena,$pos,1);}		
		$clave=crypt($pass,'otro@letra8');//encripto
		//inserto el usuario bloqueado bloqueado=1 bloqueo manual, bloqueado=2 bloqueo alta usuario
		$query="INSERT INTO usuarios (Usuario,Password,Nombre,Apellido,Tel,FechaA,RSF,CUITF,DomiF,PciaF,NFF,RSPF,IdPerfil,FPago,Bloqueado,Riesgo) VALUES ('$usr','$clave','$nom','$ap','$tel','$fa','$rsf','$cuit','$dom','$pcia','$nf','$rsp',5,0,2,0)";//cliente
		$rs=mysql_query($query,$conn);
		if ($rs){
			$feed="msgC="."Su pedido será tramitado por CMIT";			
			//envía mail a MailToAlertas(facturacion@)
			$asunto='Solicitud alta de usuario';$adjunto='';
			$cuerpo='<BODY><FONT FACE="arial"><small>El Usuario '.$_POST['TxtUsuario'].', Empresa '.$_POST['TxtRSF'].', ha solicitado ser dado de alta en el sistema de turnos.<BR> Fue registrado automáticamente y quedó en estado bloqueado.</FONT></BODY>';
			$resultenvio=EnviarMailAlerta($asunto,$cuerpo,$adjunto,$conn);
		}else{$feed="msgE="."No se grabó el cambio. Verifique si el EMail ya fue registrado."; } 
		//desconecto
		mysql_close($conn); 	
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}
		header("Location:../InicioIntranet.php?".$feed);
		
	}		
}



elseif (isset($_POST[CmdCancelar])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../InicioIntranet.php");
}




?>


