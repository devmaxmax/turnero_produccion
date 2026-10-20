<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}



if (isset($_POST['CmdGuardar'])){
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$cant=0;$u='ngrunmann@gmail.com';$detmail='';
	$adjunto='';$cuerpo='';$empresa='';$tipoex1='';
	$listadoturnos='';$dialistado='';
	if(!empty($_POST['campos'])) {
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);	
		//datos turno
		$nomuser=substr($_SESSION["NombreUsuario"],0,45);
		list($rsf,$usr)=explode("|",$_POST['CbIdRSF']);
		$obs=mysql_real_escape_string($_POST['TxtObs']);
		//tipoexamen
		$tipoe=intval($_POST['CbIdTipoEx']);
		$e1=0;$e2=0;$e3=0;$e4=0;$e5=0;
		switch ($tipoe) {
			case 1:	$e1=1;break;
			case 2:	$e2=1;break;
			case 3:	$e3=1;break;
			case 4:	$e4=1;break;
			case 5:	$e5=1;break;	
		}	
		//			
		$rsf=intval($rsf);$usr=mysql_real_escape_string($usr);
		if($usr!=''){$u=$usr;}
		//obtener datos turno
		if($u!='ngrunmann@gmail.com'){
			//$empresa
			if($rsf==0){$query="SELECT u.RSF,u.CUITF FROM usuarios u where u.Usuario='$u'";}
			else{$query="Select uc.RSF,uc.CUITF From usuariosclientes uc Where uc.IdUsuario='$u' and uc.Id=$rsf";}
			$rs2=mysql_query($query,$conn);while($row2=mysql_fetch_array($rs2)){$empresa=$row2['RSF'];$cuit=$row2['CUITF'];}mysql_free_result($rs2);
			//$tipoex1
			$query="SELECT e.Nombre FROM tipoexamen e where e.Id=$tipoe";
			$rs2=mysql_query($query,$conn);while($row2=mysql_fetch_array($rs2)){$tipoex1=$row2['Nombre'];}mysql_free_result($rs2);
		}
		//turnos
		$aLista=array_keys($_POST['campos']);
		foreach($aLista as $nrocheck) {	
			list($fecha,$hora,$varagenda,$idt)=explode("|",$nrocheck);
			$fecha=FormatoFecha($fecha);
			//variables
			include("../Includes/zVariables.php");
			//hora
			list($h1,$m1)=explode(":",$hora);$horamin=$m1+($h1*60);
			//tipo dia y turnos disponibles
			include("../Includes/zTipoDia.php");
			//si no esta ocupado grabo			
			if($ocupado==0){
				$fecha=FechaMySql($fecha);
				$sturno=GLO_TURSobreturnoES($hora);
				//inserto
				$nroId=GLO_generoID("turnos",$conn);
				$query="INSERT INTO turnos (Id,IdAgenda,IdUsuario,Obs,Paciente,DNIP,IdTipoEx,IdEntidad,EnvioMail,ART,IdRSF,Fecha,Hora,Cmit,Estado,Acepto,Carga,FPago1,FPago2,STurno,E1,E2,E3,E4,E5) VALUES ($nroId,$varagenda,'$u','$obs','','',0,0,'','',$rsf,'$fecha','$hora',1,0,1,'$nomuser',0,0,$sturno,$e1,$e2,$e3,$e4,$e5)";$rs=mysql_query($query,$conn);
				if ($rs){
					$cant=$cant+1;
					InsertarAuditoria(1,1,$nroId,$conn);
					if($listadoturnos==''){$listadoturnos=$nroId;}else{$listadoturnos=$listadoturnos.','.$nroId;}
				}
			}
		}
		include("../Includes/zMailClienteMasivo.php");				
		mysql_close($conn); 
	}
	$_SESSION['GLO_msgC']="Se grabaron ".$cant." turnos";
	header("Location:../MasivoCMITL.php");
}


elseif (isset($_POST['CmdExBuscar'])){//buscar empresa
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}	
	header("Location:../MasivoCMITL.php");
}

if (isset($_POST['CmdSiguiente'])){ 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION['IdConsulta']=2;
	header("Location:../MasivoCMITL.php");
}


if (isset($_POST['CmdAnterior'])){ 
	foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
	$_SESSION['IdConsulta']=1;
	header("Location:../MasivoCMITL.php");
}


 
?>