<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

if (isset($_POST['CmdAceptar'])){
	//valida que si es ctdo+sinalta: si tiene dias o fecha tienen que tener los dos
	$validamodotemp=0;
	if( intval($_POST['ChkFP'])==0 and intval($_POST['ChkSA'])==1 ){//si es ctdo y sin alta
		if( (intval($_POST['TxtDias'])!=0 and $_POST['TxtFechaSA']=='') or (intval($_POST['TxtDias'])==0 and $_POST['TxtFechaSA']!='') ) {
			$validamodotemp=1;
		}
	}
	//valida requeridos
	if ( empty($_POST['TxtNombre']) or empty($_POST['TxtApellido'])  or empty($_POST['TxtTel'])  or empty($_POST['TxtRSF']) or empty($_POST['TxtDomiF'])  or empty($_POST['TxtPciaF']) or  $validamodotemp==1 ){
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
		if($validamodotemp==1){$_SESSION['GLO_msgE']='Por favor complete Dias y Fecha Habilitacion Temporal, o borre ambos';
		}else{GLO_feedback(3);}
		header("Location:Modificar.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016')."&Flag1=False");
	}else{
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		$usr=mysql_real_escape_string($_POST['TxtUsuario']);
		$nom=mysql_real_escape_string(ltrim($_POST['TxtNombre']));
		$ap=mysql_real_escape_string(ltrim($_POST['TxtApellido']));
		$tel=mysql_real_escape_string(ltrim($_POST['TxtTel']));
		$rsf=mysql_real_escape_string(ltrim($_POST['TxtRSF']));
		$cuit=mysql_real_escape_string(ltrim($_POST['TxtCUITF']));
		$dom=mysql_real_escape_string(ltrim($_POST['TxtDomiF']));
		$pcia=mysql_real_escape_string(ltrim($_POST['TxtPciaF']));
		$nf=mysql_real_escape_string(ltrim($_POST['TxtNFF']));
		$fpago=intval($_POST['ChkFP']);		
		$riesgo=intval($_POST['ChkR']); 
		if($fpago==0){$riesgo=1;}//si es ctdo es riesgo
		//sin alta turnos
		$chksa=intval($_POST['ChkSA']);//sin alta
		$diassa=intval($_POST['TxtDias']);//dias en que esta habilitado temporalmente
		if (empty($_POST['TxtFechaSA'])){$fechasa="0000-00-00";}else{$fechasa=FechaMySql($_POST['TxtFechaSA']);}	
		//bloqueado
		$bloq=intval($_POST['ChkBloq']); 
		$bloqorig=intval($_POST['ChkBloqOrig']); 
		$wherefechabl="";$hoy=FechaMySql(date("d-m-Y"));
		if($bloq!=$bloqorig){ if($bloq==0){$wherefechabl=",FechaBL='0000-00-00'";}else{$wherefechabl=",FechaBL='$hoy'";} }
	    //update
		$query="UPDATE usuarios set Nombre='$nom',Apellido='$ap',Tel='$tel',RSF='$rsf',CUITF='$cuit',DomiF='$dom',PciaF='$pcia',NFF='$nf',FPago=$fpago,Bloqueado=$bloq,Riesgo=$riesgo,SA=$chksa,DiasSA=$diassa,FechaSA='$fechasa' $wherefechabl Where Usuario='$usr'"; $rs=mysql_query($query,$conn);
		if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 	
		mysql_close($conn); 		
		header("Location:Modificar.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016'));
	}		
}


elseif (isset($_POST['CmdVerRS'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:ModificarRS.php?id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016')."&Flag1=True");	
}

elseif (isset($_POST['CmdAddRS'])){	
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:AltaRS.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016'));
}


elseif (isset($_POST['CmdBorrarRS'])){
	$query="Delete From usuariosclientes Where Id=".intval($_POST['TxtId']);
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);
	if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 	
	mysql_close($conn); 
	header("Location:Modificar.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016'));
}


elseif (isset($_POST['CmdEnviarClave'])){
	//busco bloq 
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	$usr=mysql_real_escape_string($_POST['TxtUsuario']);
	$query="SELECT Bloqueado From usuarios where Usuario='$usr'";$rs=mysql_query($query,$conn);
	$row=mysql_fetch_array($rs);if(mysql_num_rows($rs)!=0){$bloq= $row['Bloqueado'];}mysql_free_result($rs);	
	//enviar clave	
	if((intval($_POST['ChkBloq'])==0) and $bloq==0){	
		//genero nueva clave
		$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";$longitudCadena=strlen($cadena);$pass="";$longitudPass=8;
		for($i=1 ; $i<=$longitudPass ; $i++){$pos=rand(0,$longitudCadena-1);$pass .= substr($cadena,$pos,1);}		
		$clave=crypt($pass,'otro@letra8');//encripto
		//actualizo clave
		$query="UPDATE usuarios set Password='$clave' Where Usuario='$usr'";$rs=mysql_query($query,$conn);
		if($rs){
			//envio mail a Usuario
			$a=$_POST['TxtUsuario'];$asunto='Clave de Acceso Sistema de Turnos CMIT';$adjunto='';	
			include("../Includes/zMailCuerpoI.php");			
			$cuerpo .='La clave de acceso es: '.$pass;
			include("../Includes/zMailCuerpoF.php");	
			$resultenvio=EnviarMailUsuario($a,$asunto,$cuerpo,$adjunto,$conn);
			if ($resultenvio==1){GLO_feedback(15);$_SESSION['GLO_msgC']=$_SESSION['GLO_msgC'].'. La clave de acceso es: '.$pass;}
			else{$_SESSION['GLO_msgE']="El env&iacute;o fall&oacute;. La clave de acceso es: ".$pass;
			}
		}else{GLO_feedback(2); } 
	}else{$_SESSION['GLO_msgE']="El Usuario no puede estar bloqueado para enviar Clave"; }
	mysql_close($conn); 
	header("Location:Modificar.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016'));
}



elseif (isset($_POST['CmdTurnos'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../MisTurnosCMIT.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016'));
}




else{
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	header("Location:Modificar.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016')."&Flag1=False");
}
?>


