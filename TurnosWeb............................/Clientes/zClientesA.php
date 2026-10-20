<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

if (isset($_POST['CmdBuscar'])){	
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
	//razon social
	if ((empty($_POST['TxtBusqueda']))){$wrs="";}
	else{$cri=mysql_real_escape_string($_POST['TxtBusqueda']);$wrs="and (u.RSF Like '%".$cri."%')";	}
	//usuario
	if ((empty($_POST['TxtBusquedaU']))){$wusr="";}
	else{$cri=mysql_real_escape_string($_POST['TxtBusquedaU']);$wusr="and (u.Usuario Like '%".$cri."%')";	}
	mysql_close($conn); 
	//
	$bloq=intval($_POST['ChkBloq']);if($bloq!=0){$wbloq="and u.Bloqueado<>0";}else{$wbloq='';}
	$bloqaa=intval($_POST['ChkBloqAA']);if($bloqaa!=0){$wbloqaa="and u.Bloqueado=2";}else{$wbloqaa='';}
	$fpago=intval($_POST['CbFP']);if($fpago!=99){$wfpago="and u.FPago=$fpago";}else{$wfpago='';}
	$riesgo=intval($_POST['ChkR']);if($riesgo!=0){$wriesgo="and (u.Riesgo<>0 or u.FPago=0)";}else{$wriesgo='';}
	$sat=intval($_POST['ChkSA']);if($sat!=0){$wsat="and (u.SA=1)";}else{$wsat='';}//sinalta
	//
	$query="Select u.* From usuarios u Where u.Usuario<>'ngrunmann@gmail.com' and u.IdPerfil=5 $wrs $wfpago $wbloq $wbloqaa $wusr $wriesgo $wsat Order by u.RSF";
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION['TxtConsultaCliAcc']=$query;
	header("Location:../ClientesA.php");
}


elseif (isset($_POST['CmdEliminar'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$cant=0;
	if(!empty($_POST['campos'])) {
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
		$aLista=array_keys($_POST['campos']);
		foreach($aLista as $iId) {	
			$query="Delete From usuarios Where Usuario='".mysql_real_escape_string($iId)."'";$rs=mysql_query($query,$conn);
			if($rs){ $cant=$cant+1;}
		}
		mysql_close($conn); 
	}
	$_SESSION['GLO_msgC']="Se actualizaron ".$cant." registros";
	header("Location:../ClientesA.php");
}

elseif (isset($_POST['CmdBloquear'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$cant=0;$hoy=FechaMySql(date("d-m-Y"));
	if(!empty($_POST['campos'])) {
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
		$aLista=array_keys($_POST['campos']);
		foreach($aLista as $iId) {	
			$query="UPDATE usuarios set Bloqueado=1,FechaBL='$hoy' Where Usuario='".mysql_real_escape_string($iId)."'";
			$rs=mysql_query($query,$conn);
			if($rs){ $cant=$cant+1;}
		}
		mysql_close($conn); 
	}
	$_SESSION['GLO_msgC']="Se actualizaron ".$cant." registros";
	header("Location:../ClientesA.php");
}


elseif (isset($_POST['CmdDesbloquear'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$cant=0;
	if(!empty($_POST['campos'])) {
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
		$aLista=array_keys($_POST['campos']);
		foreach($aLista as $iId) {	
			$query="UPDATE usuarios set Bloqueado=0,FechaBL='0000-00-00' Where Usuario='".mysql_real_escape_string($iId)."'";
			$rs=mysql_query($query,$conn);
			if($rs){ $cant=$cant+1;}
		}
		mysql_close($conn); 
	}
	$_SESSION['GLO_msgC']="Se actualizaron ".$cant." registros";
	header("Location:../ClientesA.php");
}

elseif (isset($_POST['CmdRiesgo'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$cant=0;
	if(!empty($_POST['campos'])) {
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
		$aLista=array_keys($_POST['campos']);
		foreach($aLista as $iId) {	
			$query="UPDATE usuarios set Riesgo=1 Where Usuario='".mysql_real_escape_string($iId)."'";$rs=mysql_query($query,$conn);
			if($rs){ $cant=$cant+1;}
		}
		mysql_close($conn); 
	}
	$_SESSION['GLO_msgC']="Se actualizaron ".$cant." registros";
	header("Location:../ClientesA.php");
}


elseif (isset($_POST['CmdBRiesgo'])){//ctdo siempre es riesgo
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$cant=0;
	if(!empty($_POST['campos'])) {
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
		$aLista=array_keys($_POST['campos']);
		foreach($aLista as $iId) {	
			$query="UPDATE usuarios set Riesgo=0 Where FPago<>0 and Usuario='".mysql_real_escape_string($iId)."'";$rs=mysql_query($query,$conn);
			if($rs){ $cant=$cant+1;}
		}
		mysql_close($conn); 
	}
	$_SESSION['GLO_msgC']="Se actualizaron ".$cant." registros";
	header("Location:../ClientesA.php");
}



elseif (isset($_POST['CmdBloquearM'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$cant=0;$mails='';$hoy=FechaMySql(date("d-m-Y"));
	if(!empty($_POST['campos'])) {
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
		$aLista=array_keys($_POST['campos']);
		foreach($aLista as $iId) {	
			//bloquea
			$query="UPDATE usuarios set Bloqueado=1,FechaBL='$hoy' Where Usuario='".mysql_real_escape_string($iId)."'";$rs=mysql_query($query,$conn);
			if($rs){ 
				$cant=$cant+1;
				//suma a mail
				if ($mails==''){$mails=$iId;}else{$mails=$mails.", ".$iId;}
			}
		}
		//envia mail
		include("../Includes/zMailBloqDeuda.php");		
		mysql_close($conn); 
	}
	$_SESSION['GLO_msgC']="Se actualizaron ".$cant." registros";
	header("Location:../ClientesA.php");
}


elseif (isset($_POST['CmdMail'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$cant=0;$mails='';
	if(!empty($_POST['campos'])) {
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
		$aLista=array_keys($_POST['campos']);
		foreach($aLista as $iId) {	
				$cant=$cant+1;
				//suma a mail
				if ($mails==''){$mails=$iId;}else{$mails=$mails.", ".$iId;}
		}
		//envia mail
		include("../Includes/zMailDeuda.php");		
		mysql_close($conn); 
	}
	$_SESSION['GLO_msgC']="Se gestionaron ".$cant." registros";
	header("Location:../ClientesA.php");
}



elseif (isset($_POST['CmdCtdo'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$cant=0;
	if(!empty($_POST['campos'])) {
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
		$aLista=array_keys($_POST['campos']);
		foreach($aLista as $iId) {	
			$query="UPDATE usuarios set FPago=0 Where FPago<>0 and Usuario='".mysql_real_escape_string($iId)."'";$rs=mysql_query($query,$conn);
			if($rs){ $cant=$cant+1;}
		}
		mysql_close($conn); 
	}
	$_SESSION['GLO_msgC']="Se actualizaron ".$cant." registros";
	header("Location:../ClientesA.php");
}


elseif (isset($_POST['CmdCC'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$cant=0;
	if(!empty($_POST['campos'])) {
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
		$aLista=array_keys($_POST['campos']);
		foreach($aLista as $iId) {	
			$query="UPDATE usuarios set FPago=1 Where FPago<>1 and Usuario='".mysql_real_escape_string($iId)."'";$rs=mysql_query($query,$conn);
			if($rs){ $cant=$cant+1;}
		}
		mysql_close($conn); 
	}
	$_SESSION['GLO_msgC']="Se actualizaron ".$cant." registros";
	header("Location:../ClientesA.php");
}


elseif (isset($_POST['CmdSinAlta'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$cant=0;
	if(!empty($_POST['campos'])) {
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
		$aLista=array_keys($_POST['campos']);
		foreach($aLista as $iId) {	
			$query="UPDATE usuarios set SA=1 Where SA<>1 and Usuario='".mysql_real_escape_string($iId)."'";$rs=mysql_query($query,$conn);
			if($rs){ $cant=$cant+1;}
		}
		mysql_close($conn); 
	}
	$_SESSION['GLO_msgC']="Se actualizaron ".$cant." registros";
	header("Location:../ClientesA.php");
}


 
?>