<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

if (isset($_POST['CmdAceptar'])){
	// valida datos requeridos y captcha
	if ((empty($_POST['TxtUsuario'])) or (empty($_POST['TxtNombre'])) or (empty($_POST['TxtApellido'])) or (empty($_POST['TxtTel']))  or (empty($_POST['TxtRSF']))  or (empty($_POST['TxtDomiF']))  or (empty($_POST['TxtPciaF'])) ){	
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
		GLO_feedback(3);header("Location:../LoginRegistrarCMIT.php");
	}else{
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}	
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
		$rsp='';//mysql_real_escape_string($_POST['TxtRSPF']);
		$fpago=intval($_POST['ChkFP']);
		if($fpago==0){$riesgo=1;}else{$riesgo=0;}//si es ctdo es riesgo
		//genero nueva clave
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";$longitudCadena=strlen($cadena);$pass="";$longitudPass=8;
		for($i=1 ; $i<=$longitudPass ; $i++){$pos=rand(0,$longitudCadena-1);$pass .= substr($cadena,$pos,1);}		
		$clave=crypt($pass,'otro@letra8');//encripto
		//insert
		$query="INSERT INTO usuarios (Usuario,Password,Nombre,Apellido,Tel,FechaA,RSF,CUITF,DomiF,PciaF,NFF,RSPF,IdPerfil,FPago,Bloqueado,Riesgo,SA,DiasSA,FechaSA,FechaBL) VALUES ('$usr','$clave','$nom','$ap','$tel','$fa','$rsf','$cuit','$dom','$pcia','$nf','$rsp',5,$fpago,0,$riesgo,0,0,'0000-00-00','0000-00-00')";//cliente
		$rs=mysql_query($query,$conn);
		if ($rs){
			//envio mail a Usuario
			$a=$_POST['TxtUsuario'];$asunto='Clave de Acceso Sistema de Turnos CMIT';$adjunto='';
			include("../Includes/zMailCuerpoI.php");			
			$cuerpo .='Su clave de acceso es: '.$pass;
			include("../Includes/zMailCuerpoF.php");	
			$resultenvio=EnviarMailUsuario($a,$asunto,$cuerpo,$adjunto,$conn);
			if ($resultenvio==1){GLO_feedback(15);}
			else{$_SESSION['GLO_msgE']="El envio fallo, solicitar al usuario que seleccione Olvido su Contrase&ntilde;a para reenviar la clave";}
		}else{$_SESSION['GLO_msgE']="No se grabo el cambio. Verifique si el EMail ya fue registrado."; } 
		//desconecto
		mysql_close($conn); 		
		header("Location:../Clientes.php");
		
	}		
}



elseif (isset($_POST['CmdCancelar'])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../Clientes.php");
}




?>