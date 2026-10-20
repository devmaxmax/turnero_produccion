<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}


if (isset($_POST[CmdAceptar])){ 
	if ( (empty($_POST['TxtRSF'])) or (empty($_POST['TxtDomiF']))  or (empty($_POST['TxtPciaF']))  ){
		foreach($_POST as $key => $value){	$_SESSION[$key] = $value;	}		
		header("Location:AltaRS.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016')."&msgE=Por favor complete los campos requeridos");
	}else{
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		$usr=mysql_real_escape_string($_POST['TxtUsuario']);
		$rsf=mysql_real_escape_string(ltrim($_POST['TxtRSF']));
		$cuit=mysql_real_escape_string(ltrim($_POST['TxtCUITF']));
		$dom=mysql_real_escape_string(ltrim($_POST['TxtDomiF']));
		$pcia=mysql_real_escape_string(ltrim($_POST['TxtPciaF']));
		$nf=mysql_real_escape_string(ltrim($_POST['TxtNFF']));
		$rsp='';//mysql_real_escape_string($_POST['TxtRSPF']);
	  	//generoid
		$query="SELECT Max(Id) as UltimoId FROM usuariosclientes";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
		if(mysql_num_rows($rs)==0){$nroId=1;}else{$nroId=$row['UltimoId']+1;}mysql_free_result($rs);
		//inserto
		$query="INSERT INTO usuariosclientes (Id,IdUsuario,RSF,CUITF,DomiF,PciaF,NFF,RSPF) VALUES ($nroId,'$usr','$rsf','$cuit','$dom','$pcia','$nf','$rsp')";
		$rs=mysql_query($query,$conn);
		if ($rs){$feed="msgC="."Los datos se grabaron correctamente";}else{$feed="msgE="."Los datos NO se grabaron."; } 
		mysql_close($conn); 	
		//limpiar datos del form anterior
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}
		header("Location:Modificar.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016')."&Flag1=True&".$feed);
	}
}


elseif (isset($_POST[CmdCancelar])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:Modificar.php?id=".encrypt($_POST['TxtUsuario'],'elcrucedelosandes2016')."&Flag1=True&".$feed);
}



?>

