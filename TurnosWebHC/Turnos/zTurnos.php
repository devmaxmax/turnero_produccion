<? include("../Codigo/Seguridad.php"); include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");



if (isset($_POST['CmdSiguiente'])){ 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION['IdConsulta']=2;
	header("Location:../Inicio.php");
}


if (isset($_POST['CmdAnterior'])){ 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION['IdConsulta']=1;
	header("Location:../Inicio.php");
}


if (isset($_POST['CmdTurno'])){	
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	//valido sin alta
	$sinalta=GLO_TURSinAlta($_SESSION["login"],$conn);
	//valido habilitado temporal
	$habiltemp=0;
	if($sinalta==1){
		$id=$_SESSION["login"];
		$query="SELECT FPago,SA,DiasSA,FechaSA From usuarios where Usuario='$id'";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
		if(mysql_num_rows($rs)!=0){$habiltemp=GLO_TURSinAltaHT($row['FPago'],$row['SA'],$row['DiasSA'],$row['FechaSA']);}mysql_free_result($rs);	
	}
	mysql_close($conn);
	//doy de alta o muestro mensaje, segun corresponda
	if( $sinalta==0 or ($sinalta==1 and $habiltemp==1) ){//valido habilitado temporalmente
		//header("Location:Alta.php?Id=".encrypt($_POST['TxtId'],'elcrucedelosandes2016'));
		$_SESSION["GLO_FechaTurno"]=$_POST['TxtId'];
		header("Location:Alta.php");
	}else{
		$_SESSION['GLO_msgE']='Por favor pongase en contacto con Administracion <br> al mail facturacion@cmit.com.ar o telefono 0299-4474371 int 5 para dar de Alta un turno';
		header("Location:../Inicio.php");	
	}	
}

?>

