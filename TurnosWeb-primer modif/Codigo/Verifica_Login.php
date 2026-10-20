<?php 

session_start();include("Config.php");

if (isset($_POST['CmdAceptar'])){
	//conecto
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
	//compruebo usr-pass
	$login = mysql_real_escape_string($_POST['TxtUsuario']);
	$pass = mysql_real_escape_string(trim($_POST['TxtPassword']));
	$existe=0;
	//compruebo que exista personal activo
	$query="SELECT * FROM usuarios WHERE Usuario <> '' and Password <> '' and Usuario='$login' and Password='".crypt($pass , 'otro@letra8')."' and (IdPerfil=1 or IdPerfil=5)" ;$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
	if(mysql_num_rows($rs)!=0){ 
			if($row['Bloqueado']!=0){$existe=0;$bloqueado=1;}//usuario bloqueado no ingresa
			if($row['Bloqueado']==0){
				$_SESSION["NombreUsuario"]=substr($row['Nombre'],0,25)." ".substr($row['Apellido'],0,25);$existe=1;$bloqueado=0;
			}
	} mysql_free_result($rs);	
	//desconecto
	mysql_close($conn); 	
	//verifico si logueo o no
	if($existe==1){
		$_SESSION["login"]=$login;
		$_SESSION["autentificado"]= "SI"; 
		$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
		$_SESSION["GLO_ValidaEmpresa"]='CmitTurnos 7634569823';
		$_SESSION["IdPerfilUser"]=5;
		$_SESSION["NivelArbol"]="";	
		include ("InitSession.php");//init variables que no se limpian	
		include ("LimpiarSession.php");//init variables que se limpian
		header("location:../Inicio.php");
	}else{
		if($bloqueado==1){header("Location:../LoginBloqueado.php?&msgE=La cuenta esta bloqueada");}
		if($bloqueado==0){header("Location:../InicioIntranet.php?&msgE=Verifique el usuario y la clave de acceso");}
	}
	
}


if (isset($_POST['CmdAyuda'])){	
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../LoginAyuda.php");
}

if (isset($_POST['CmdRegistrar'])){	
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../LoginRegistrar.php");
}	
	
?>

