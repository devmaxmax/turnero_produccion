<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

if (isset($_POST[CmdBuscar])){ 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	if ((empty($_POST['TxtFechaAD'])) or (empty($_POST['TxtFechaAH']))){$query="";}
	else{
		$tabla=$_POST['CbTabla'];
		$accion=intval($_POST['CbAccion']);
		$usuario=$_POST['CbUsuario'];
		if ($tabla!=0){$wtabla=" and a.IdTabla=$tabla";}else{$wtabla="";}	
		if ($tabla==1){$wtabla=" and a.IdTabla IN (1,2)";}
		if ($accion!=0){$waccion=" and a.IdAccion=$accion";}else{$waccion="";}	
		if ($usuario!=''){$wusuario=" and a.IdUsuario='$usuario'";}else{$wusuario="";}	
		$walta='';
		if(!(empty($_POST['TxtFechaAD']))){$walta=$walta." and DATEDIFF(a.Fecha,'".FechaMySql($_POST['TxtFechaAD'])."')>=0";}
		if(!(empty($_POST['TxtFechaAH']))){$walta=$walta." and DATEDIFF(a.Fecha,'".FechaMySql($_POST['TxtFechaAH'])."')<=0";}		
		
		$query="Select a.*,aa.Nombre as Accion,at.Nombre as Modulo FROM auditoria a, auditoriaacciones aa, auditoriatablas at Where a.IdAccion=aa.Id and a.IdTabla=at.Id $walta $wtabla $waccion $wusuario order by a.Fecha";
	}
	$_SESSION[TxtConsulta]=$query;
	header("Location:../Auditoria.php"); 
}

elseif (isset($_POST[CmdEliminar])){	
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:Eliminar.php");
}


elseif (isset($_POST[CmdSalir])){
	foreach($_POST as $key => $value){$_SESSION[$key] = '';}
	header("Location:../InicioCMIT.php");
}



?>