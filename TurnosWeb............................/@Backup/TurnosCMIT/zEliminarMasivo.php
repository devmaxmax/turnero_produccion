<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

if (isset($_POST[CmdBuscar])){		
	if ((empty($_POST['TxtBusqueda']))){$wrs="";}
	else{
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		$cri=mysql_real_escape_string($_POST['TxtBusqueda']);
		$wrs="and ((t.IdRSF<>0 and uc.RSF Like '%".$cri."%') or (t.IdRSF=0 and u.RSF Like '%".$cri."%'))";
		mysql_close($conn); 
	}
	if((empty($_POST['TxtFechaDCP']))){$wfechad="";}else{$wfechad="and DATEDIFF(t.Fecha,'".FechaMySql($_POST['TxtFechaDCP'])."')>=0";}
	if((empty($_POST['TxtFechaHCP']))){$wfechah="";}else{$wfechah="and DATEDIFF(t.Fecha,'".FechaMySql($_POST['TxtFechaHCP'])."')<=0";}
	$tipoex=intval($_POST['CbEx']);if($tipoex!=0){$wtipoex="and t.IdTipoEx=$tipoex";}else{$wtipoex='';}
	$est=intval($_POST['CbEstado']);if($est!=99){$west="and t.Estado=$est";}else{$west='';}
	$fpago=intval($_POST['CbFP']);if($fpago!=99){$wfpago="and t.FPago1=$fpago";}else{$wfpago='';}
	$query="Select t.*,tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF,uc.CUITF,uc.NFF,uc.DomiF,uc.PciaF,uc.RSPF,u.Nombre,u.Apellido,u.Tel,u.RSF as RSF0,u.CUITF as CUITF0,u.NFF as NFF0,u.DomiF as DomiF0,u.PciaF as PciaF0,u.RSPF as RSPF0,tde.Nombre as FP2 From turnos t,tipoexamen tex,entidades e,usuariosclientes uc,usuarios u,turnosdetalle tde Where t.Id<>0 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and uc.Id=t.IdRSF and u.Usuario=t.IdUsuario and t.FPago2=tde.Id and t.Estado<>2  $wfechad $wfechah $wtipoex $west $wrs $wfpago Order by t.Fecha,t.Hora";
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION[TxtQEliminarM]=$query;
	header("Location:../EliminarMasivo.php");
}



elseif (isset($_POST[CmdGuardar])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$cant=0;
	if(!empty($_POST['campos'])) {
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
		$aLista=array_keys($_POST['campos']);$fvacia="0000-00-00";
		foreach($aLista as $nro) {	
			$query="Delete From turnos Where Id=$nro";$rs=mysql_query($query,$conn);
			if($rs){  $cant=$cant+1;}
		}
		mysql_close($conn); 
	}
	$_SESSION['GLO_msgC']="Se borraron ".$cant." registros";
	header("Location:../EliminarMasivo.php");
}



if (isset($_POST[CmdSalir])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../ConsultaCMIT.php");
}

 
 
?>