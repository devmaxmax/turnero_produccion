<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
require_once('Codigo/calendar/classes/tc_calendar.php');
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}


$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

if (empty($_SESSION['TxtFechaDCP'])){
	$hoy=date("d-m-Y");list($d,$m,$a)=explode("-",$hoy); $primerdiames="01-".$m."-".$a;
	$_SESSION['TxtFechaDCP']=date("d-m-Y", strtotime("$primerdiames -1 month"));
	$_SESSION['TxtFechaHCP']=date("d-m-Y", strtotime("$primerdiames +1 month"));
}



function MostrarTabla($conn){
$query=$_SESSION['TxtQEliminarM'];$query=str_replace("\\", "", $query);
if ( ($query!="")){
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//guardar
		$tablaclientes="";
		$tablaclientes .=GLO_inittabla(940,0,0,0);
		$tablaclientes .="<td align="."right".">".GLO_FAButton('CmdGuardar','submit','90','self','Grabar','save','')."</td>";		
		$tablaclientes .="</tr><tr><td "."height="."3"."></td></tr></table>";
		//Titulos de la tabla				
		$tablaclientes .='<table width="940" class="TableShow" id="tshow"><tr>';
		$tablaclientes .="<td "."width="."50"." class="."TableShowT"." style='text-align:right;'> Nro</td>";   
		$tablaclientes .="<td "."width="."120"." class="."TableShowT"."> Fecha</td>";  
		$tablaclientes .="<td "."width="."200"." class="."TableShowT"."> Raz&oacute;n Social</td>"; 
		$tablaclientes .="<td "."width="."140"." class="."TableShowT"."> CUIT</td>"; 
		$tablaclientes .="<td "."width="."200"." class="."TableShowT"."> Paciente</td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TableShowT"."> Tipo Examen</td>"; 
		$tablaclientes .="<td "."width="."80"." class="."TableShowT"."> Estado</td>"; 
		$tablaclientes .='<td width="30" class="TableShowT" align="center"> <input type="checkbox" name="ChkAll" unchecked onclick="CheckMasivoColor();"></td>';
		$tablaclientes .=" </tr> ";    
		$recuento=0;$recuentosa=0; $recuentoat=0;  $recuentoeli=0;             
		while($row=mysql_fetch_array($rs)){
			if ($row['Estado']==3){$clase="TableShowD TGray";}else{$clase="TableShowD";}	
			if($row['IdRSF']==0){$empresa=$row['RSF0'];$cuit=$row['CUITF0'];}else{$empresa=$row['RSF'];$cuit=$row['CUITF'];}
			if($row['Estado']==0){$estado='Sin Atender';$colorest='';$recuentosa=$recuentosa+1;}
			if($row['Estado']==1){$estado='Atendido';$colorest=' style="font-weight:bold;color:"';$recuentoat=$recuentoat+1;}
			if($row['Estado']==3){$estado='Eliminado';$colorest=' style="font-weight:bold;color:#86868b"';$recuentoeli=$recuentoeli+1;}
			$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha'])).' '.FormatoFecha($row['Fecha']).' '.date("H:i",strtotime($row['Hora']));
			//
			$tablaclientes .='<tr id="'.$row['Id'].'" >';
			$tablaclientes .='<td class="'.$clase.'" style="text-align:right;">'.str_pad($row['Id'], 6, "0", STR_PAD_LEFT)."</td>"; 
			$tablaclientes .='<td class="'.$clase.'">'.$fecha."</td>";  
			$tablaclientes .='<td class="'.$clase.'">'.substr($empresa,0,18)."</td>"; 
			$tablaclientes .='<td class="'.$clase.'">'.substr($cuit,0,18)."</td>";  			
			$tablaclientes .='<td class="'.$clase.'">'.substr($row['Paciente'],0,20)."</td>";  			
			$tablaclientes .='<td class="'.$clase.'">'.substr($row['TipoEx'],0,20)."</td>"; 
			$tablaclientes .='<td class="TableShowD"'.$colorest."> ".$estado."</td>"; 
			$tablaclientes .='<td class="TableShowD" align="center"'."> ".'<input type="checkbox" name="campos['.$row['Id'].']" onclick="if (this.checked==1) {this.value=1;}else{this.value=0;};" onChange="CheckRow('.$row['Id'].',this.value);">'."</td>";  
			$tablaclientes .=" </tr> "; 
			$recuento=$recuento+1;
		}	
		//Cerrar tabla
		$tablaclientes .="</table>"; 
		$tablaclientes .="<p class="."recuento"." align="."right"."> $recuento turnos | $recuentosa sin atender, $recuentoat atendidos, $recuentoeli eliminados</p></td></tr></table>"; 
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center">No existen datos</p>';}
	//Cierra consulta
	mysql_free_result($rs);
	
}
}

GLO_InitHTML($_SESSION["NivelArbol"],'TxtFechaDCP','BannerConMenuHVCMIT','TurnosCMIT/zEliminarMasivo',0,0,0,0);
GLO_tituloypath(0,740,'ConsultaCMIT.php','ELIMINAR TURNOS','linksalir'); 
?>



<table width="740" border="0"  cellspacing="0" class="Tabla" >
<tr> <td height="5" width="70"></td><td width="100"></td><td width="140"></td><td width="70"></td><td width="190"></td><td width="170"></td></tr>
<tr> <td height="18"  align="right">&nbsp;Fecha:</td><td  >&nbsp;<input name="TxtFechaDCP"  id="TxtFechaDCP" type="text" class="TextBox"  style="width:70px" maxlength="10"  onchange="this.value=validarFecha(this.value);" value="<? echo $_SESSION['TxtFechaDCP']; ?>"   ><?php  calendario("TxtFechaDCP","Codigo/","actual"); ?></td><td  > al&nbsp;<input name="TxtFechaHCP"  id="TxtFechaHCP" type="text" class="TextBox"  style="width:70px" maxlength="10"  onchange="this.value=validarFecha(this.value);" value="<? echo $_SESSION['TxtFechaHCP']; ?>"   ><?php  calendario("TxtFechaHCP","Codigo/","actual"); ?></td><td height="18" align="right">Examen:</td><td >&nbsp;<select name="CbEx" class="campos" id="CbEx"  style="width:140px" onKeyDown="enterxtab(event)"><option value=""></option><? ComboTablaRFX("tipoexamen","CbEx","Id","","",$conn); ?></select></td>
<td >F.Pago: <select name="CbFP" class="campos" id="CbEstado"  style="width:80px" onKeyDown="enterxtab(event)"><? GLO_ComboFPago(); ?></select></td></tr>
<tr> <td height="18"  align="right">Empresa:</td><td  colspan="2" >&nbsp;<input name="TxtBusqueda" type="text" class="TextBox" style="width:180px" maxlength="20" onKeyDown="enterxtab(event)"></td><td height="18" align="right">Estado:</td><td >&nbsp;<select name="CbEstado" class="campos" id="CbEstado"  style="width:140px" onKeyDown="enterxtab(event)"><? GLO_ComboEstado(); ?></select></td><td   align="right" ><? GLOF_Search('CmdBuscar',0); ?>&nbsp;</td></tr>
</table>



<? 
GLO_Hidden('TxtId',0);GLO_Hidden('TxtQEliminarM',0);
GLO_mensajeerror(); 
MostrarTabla($conn); 
mysql_close($conn);
GLO_cierratablaform(); 
include ("Codigo/FooterConUsuario.php");
?>