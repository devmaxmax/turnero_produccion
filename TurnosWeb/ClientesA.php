<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}


$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

function MostrarTabla($conn){
//mensajes
$clickctdo="'Desea pasar a Contado?'";	
$clickcc="'Desea pasar a Cuenta Corriente?'";	
$clickeliminar="'Desea Eliminar?'";	
$clickbloquear="'Desea Bloquear?'";	
$clickdesbloquear="'Desea borrar Bloqueo?'";	
$clickriesgo="'Desea marcar como Riesgo?'";	
$clickbriesgo="'Desea borrar Riesgo?'";	
$clickbloquearmail="'Desea Bloquear y enviar Mail Falta de Pago?'";	
$clickmail="'Desea enviar Mail Aviso Deuda?'";	
$clicksinalta="'Desea marcar sin alta de turnos?'";	
//
$query=$_SESSION['TxtConsultaCliAcc'];$query=str_replace("\\", "", $query);
if ( ($query!="")){
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//Titulos de la tabla		
		$tablaclientes="";
		$tablaclientes .=GLO_inittabla(1120,0,0,0); 
		$tablaclientes .="<td>".'<input name="CmdCtdo" type="submit" class="botonlog" value="Contado" style="width:120px" onClick="document.Formulario.target='."'_self'".';return confirm('.$clickctdo.');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="CmdBloquear" type="submit" class="botonlog" value="Bloquear" style="width:120px" onClick="document.Formulario.target='."'_self'".';return confirm('.$clickbloquear.');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="CmdRiesgo" type="submit" class="botonlog" value="Riesgo" style="width:120px" onClick="document.Formulario.target='."'_self'".';return confirm('.$clickriesgo.');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="CmdMail" type="submit" class="botonlog" value="Mail Deuda" style="width:120px" onClick="document.Formulario.target='."'_self'".';return confirm('.$clickmail.');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="CmdEliminar" type="submit" class="botonlog" value="Eliminar" style="width:120px" onClick="document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');">'."</td></tr>";	
		$tablaclientes .="<td "."height="."3"."></td></tr>";
		$tablaclientes .="<tr><td>".'<input name="CmdCC" type="submit" class="botonlog" value="CtaCorriente" style="width:120px" onClick="document.Formulario.target='."'_self'".';return confirm('.$clickcc.');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="CmdDesbloquear" type="submit" class="botonlog" value="Borrar Bloqueo" style="width:120px" onClick="document.Formulario.target='."'_self'".';return confirm('.$clickdesbloquear.');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="CmdBRiesgo" type="submit" class="botonlog" value="Borrar Riesgo" style="width:120px" onClick="document.Formulario.target='."'_self'".';return confirm('.$clickbriesgo.');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="CmdBloquearM" type="submit" class="botonlog" value="Bloquear + Mail" style="width:120px" onClick="document.Formulario.target='."'_self'".';return confirm('.$clickbloquearmail.');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="CmdSinAlta" type="submit" class="botonlog" value="Sin Alta" style="width:120px" onClick="document.Formulario.target='."'_self'".';return confirm('.$clicksinalta.');">'."</td></tr>";		
		$tablaclientes .="<tr><td "."height="."10"."></td></tr></table>";
		//Titulos de la tabla		
		$tablaclientes .='<table width="1120" class="TableShow" id="tshow"><tr>';		
		$tablaclientes .="<td "."width="."220"." class="."TableShowT"."> Usuario</td>";  
		$tablaclientes .="<td "."width="."230"." class="."TableShowT"."> Nombre</td>"; 
		$tablaclientes .="<td "."width="."250"." class="."TableShowT"."> Raz&oacute;n Social</td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TableShowT"."> CUIT</td>"; 
		$tablaclientes .="<td "."width="."60"." class="."TableShowT"."> Pago</td>"; 
		$tablaclientes .="<td "."width="."110"." class="."TableShowT"."> Estado</td>"; 
		$tablaclientes .="<td "."width="."100"." class="."TableShowT"."> Alta Turnos</td>"; 
		$tablaclientes .='<td width="30" class="TableShowT" align="center"> <input type="checkbox" id="5" name="ChkAll" unchecked onclick="CheckMasivo2();"></td>';
		$tablaclientes .=" </tr> ";    
		$recuento=0;          
		while($row=mysql_fetch_array($rs)){
			if($row['FPago']==0){$fpago='Ctdo';}else{$fpago='CC';}
			$clase="TableShowD";	$estado='';
			if (GLO_TURRiesgo($row['Riesgo'],$row['FPago'])!=0){$clase="TableShowD TBlue";$estado='Riesgo';}
			if ($row['Bloqueado']!=0){$clase="TableShowD TRed";$estado='Bloq';}
			if ($row['SA']==1){$altaturno="NO";}else{$altaturno="";}//sin alta
			//valido sin alta modo temporal(ctdo+sinalta+tiene dias y fecha)
			if(GLO_TURSinAltaHT($row['FPago'],$row['SA'],$row['DiasSA'],$row['FechaSA'])==1){$htemp=' HT';}else{$htemp='';}
			$tablaclientes .=" <tr> ";
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center">'.substr($row['Usuario'],0,30)."</td>";  
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center">'.substr($row['Apellido'].' '.$row['Nombre'],0,20)."</td>"; 
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center">'.substr($row['RSF'],0,25)."</td>";  			
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center">'.substr($row['CUITF'],0,15)."</td>";  
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center">'.$fpago."</td>";  
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center; font-weight:bold">'.$estado.' '.GLO_FormatoFecha($row['FechaBL'])."</td>";
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center; font-weight: bold;">'.$altaturno.$htemp."</td>";  			
			$tablaclientes .='<td class="TableShowD TAC">'.'<input type="checkbox" id="5" name="campos['.$row['Usuario'].']" >'."</td>";  
			$tablaclientes .=" </tr> "; 
			$recuento=$recuento+1;
		}mysql_free_result($rs);	
		$tablaclientes .=GLO_fintabla(0,0,$recuento);
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center">No existen datos</p>';}
}
}


GLO_InitHTML($_SESSION["NivelArbol"],'TxtBusqueda','BannerConMenuHVCMIT','Clientes/zClientesA',0,0,0,0);
GLO_tituloypath(0,1120,'Clientes.php','ACCIONES MASIVAS CLIENTES','linksalir');

include("Clientes/Includes/zCamposFiltros.php");
GLO_Hidden('TxtId',0);GLO_Hidden('TxtConsultaCliAcc',0);
GLO_mensajeerror();
MostrarTabla($conn);
mysql_close($conn);
GLO_cierratablaform();
include ("Codigo/FooterConUsuario.php");
?>