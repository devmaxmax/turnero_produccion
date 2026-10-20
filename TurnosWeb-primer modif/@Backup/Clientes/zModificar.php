<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}


if (isset($_POST[CmdAceptar])){
	if ((empty($_POST['TxtNombre'])) or (empty($_POST['TxtApellido']))  or (empty($_POST['TxtTel']))  or (empty($_POST['TxtRSF'])) or (empty($_POST['TxtDomiF']))  or (empty($_POST['TxtPciaF']))  ){
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;}		
		header("Location:Modificar.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016')."&Flag1=False&"."&msgE=Por favor complete los campos requeridos");
	}else{
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		//grabar los datos en la tabla
		$usr=mysql_real_escape_string($_POST['TxtUsuario']);
		$nom=mysql_real_escape_string(ltrim($_POST['TxtNombre']));
		$ap=mysql_real_escape_string(ltrim($_POST['TxtApellido']));
		$tel=mysql_real_escape_string(ltrim($_POST['TxtTel']));
		$rsf=mysql_real_escape_string(ltrim($_POST['TxtRSF']));
		$cuit=mysql_real_escape_string(ltrim($_POST['TxtCUITF']));
		$dom=mysql_real_escape_string(ltrim($_POST['TxtDomiF']));
		$pcia=mysql_real_escape_string(ltrim($_POST['TxtPciaF']));
		$nf=mysql_real_escape_string(ltrim($_POST['TxtNFF']));
		$rsp='';//mysql_real_escape_string($_POST['TxtRSPF']);
		$fpago=intval($_POST['ChkFP']);
		$bloq=intval($_POST['ChkBloq']); 
	    //update
		$query="UPDATE usuarios set Nombre='$nom',Apellido='$ap',Tel='$tel',RSF='$rsf',CUITF='$cuit',DomiF='$dom',PciaF='$pcia',NFF='$nf',RSPF='$rsp',FPago=$fpago,Bloqueado=$bloq   Where Usuario='$usr'"; 
		$rs=mysql_query($query,$conn);
		if ($rs){$feed="msgC="."Los datos se grabaron correctamente";}else{$feed="msgE="."Los datos NO se grabaron."; } 
		mysql_close($conn); 		
		header("Location:Modificar.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016')."&Flag1=True&".$feed);
	}		
}


elseif (isset($_POST[CmdVerRS])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:ModificarRS.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016')."&Flag1=True");	
}

elseif (isset($_POST[CmdAddRS])){	
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:AltaRS.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016'));
}


elseif (isset($_POST[CmdBorrarRS])){
	$query="Delete From usuariosclientes Where Id=".intval($_POST['TxtId']);
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);
	if ($rs){$feed="msgC="."Los datos se grabaron correctamente";}else{$feed="msgE="."No se grabó el cambio"; } 
	mysql_close($conn); 
	header("Location:Modificar.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016')."&Flag1=True&".$feed);
}


elseif (isset($_POST[CmdEnviarClave])){
	//busco bloq 
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	$usr=mysql_real_escape_string($_POST['TxtUsuario']);
	$query="SELECT Bloqueado From usuarios where Usuario='$usr'";$rs=mysql_query($query,$conn);
	$row=mysql_fetch_array($rs);if(mysql_num_rows($rs)!=0){$bloq= $row['Bloqueado'];}mysql_free_result($rs);	
	//enviar clave	
	if((intval($_POST['ChkBloq'])==0) and $bloq==0){	
		//genero nueva contraseña
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";$longitudCadena=strlen($cadena);$pass="";$longitudPass=8;
		for($i=1 ; $i<=$longitudPass ; $i++){$pos=rand(0,$longitudCadena-1);$pass .= substr($cadena,$pos,1);}		
		$clave=crypt($pass,'otro@letra8');//encripto
		//actualizo clave
		$query="UPDATE usuarios set Password='$clave' Where Usuario='$usr'";$rs=mysql_query($query,$conn);
		if($rs){
			//envio mail
			$a=$_POST['TxtUsuario'];$asunto='Clave de Acceso Sistema de Turnos CMIT';$adjunto='';$cuerpo='Su clave de acceso es: '.$pass;			
			$resultenvio=EnviarMail($a,$asunto,$cuerpo,$adjunto,$conn);
			if ($resultenvio==1){$feed="msgC="."Mail enviado";}else{$feed="msgE="."El envío falló, solicitar al usuario que seleccione ¿Olvidó su Contraseña? para reenviar la clave";}	
		}else{$feed="msgE="."No se grabó el cambio"; } 
	}else{$feed="msgE="."El Usuario no puede estar bloqueado para enviar Clave"; }
	mysql_close($conn); 
	header("Location:Modificar.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016')."&Flag1=True&".$feed);
}



elseif (isset($_POST[CmdCancelar])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../Clientes.php");	
}

?>


