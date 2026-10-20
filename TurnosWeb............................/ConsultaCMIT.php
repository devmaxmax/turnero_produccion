<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
require_once('Codigo/calendar/classes/tc_calendar.php');
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}


$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

if (empty($_SESSION['TxtFechaDCP'])){$hoy=date("d-m-Y"); $_SESSION['TxtFechaDCP']=$hoy;	$_SESSION['TxtFechaHCP']=$hoy;}




function MostrarTabla($conn){
$query=$_SESSION['TxtConsultaTurnos'];$query=str_replace("\\", "", $query);
if ( ($query!="")){
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//Titulos de la tabla		
		$tablaclientes="";
		$tablaclientes .=GLO_inittabla(1120,1,0,0);
		$tablaclientes .="<td "."width="."70"." class="."TableShowT"."> N<sup>ro</sup></td>";   
		$tablaclientes .="<td "."width="."150"." class="."TableShowT"."> Fecha</td>";  
		$tablaclientes .="<td "."width="."170"." class="."TableShowT"."> Raz&oacute;n Social</td>"; 
		$tablaclientes .="<td "."width="."150"." class="."TableShowT"."> CUIT</td>"; 
		$tablaclientes .="<td "."width="."210"." class="."TableShowT"."> Paciente</td>"; 
		$tablaclientes .="<td "."width="."130"." class="."TableShowT"."> Tipo Examen</td>"; 
		$tablaclientes .="<td "."width="."90"." class="."TableShowT"."> Estado</td>"; 
		$tablaclientes .="<td "."width="."150"." class="."TableShowT"."></td>"; 
		$tablaclientes .=" </tr> ";    
		$recuento=0;$recuentosa=0; $recuentoat=0;  $recuentoeli=0;             
		while($row=mysql_fetch_array($rs)){
			if ($row['Estado']==3){$clase="TableShowD TGray";}else{$clase="TableShowD";}	
			if($row['IdRSF']==0){$empresa=$row['RSF0'];$cuit=$row['CUITF0'];}else{$empresa=$row['RSF'];$cuit=$row['CUITF'];}
			if($row['Estado']==0){$estado='Sin Atender';$colorest='';$recuentosa=$recuentosa+1;}
			if($row['Estado']==1){$estado='Atendido';$colorest=' style="font-weight:bold;color:#0F9D58; text-align:center;"';$recuentoat=$recuentoat+1;}
			if($row['Estado']==3){$estado='Eliminado';$colorest=' style="font-weight:bold;color:#86868b; text-align:center;"';$recuentoeli=$recuentoeli+1;}
			$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha'])).' '.FormatoFecha($row['Fecha']).' '.date("H:i",strtotime($row['Hora']));
			$clickeliminar="'Desea eliminar el turno ".$fecha."? Graba los cambios y envia mail al Cliente'";
			$clickatender="'Desea atender el turno ".$fecha."?'";
			//si es sobreturno y no esta eliminado letra azul
			if( $row['STurno']==1 and $row['Estado']!=3){$estilost=' style="font-weight:bold;color:#4285F4;"';}else{$estilost='';}
			//
			
			$tablaclientes .='<tr '.GLO_highlight($row['Id']).'>';
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center;">'.str_pad($row['Id'], 6, "0", STR_PAD_LEFT)."</td>"; 
			$tablaclientes .='<td class="'.$clase.'"'.$estilost." style='text-align:center;'>".$fecha."</td>";  
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center;">'.substr($empresa,0,18)."</td>"; 
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center;">'.substr($cuit,0,18)."</td>";  			
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center;">'.substr($row['Paciente'],0,20)."</td>";  			
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center;">'.substr($row['TipoEx'],0,20)."</td>"; 
			$tablaclientes .="<td class="."TableShowD".$colorest." style='text-align:center;'> ".$estado."</td>"; 
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center;'>"; 
			//restriccion perfiles
			if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2  or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10){ 			
				if($row['Estado']==0){
					$tablaclientes .='<button name="CmdAtender" type="submit" class="iconbtn2"   value="" data-toggle="tooltip" data-placement="top" title="Atender" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickatender.');"><i class="fa fa-check iconsmallbt iconlgray"></i></button>';
				}
			}			
			$tablaclientes .='&nbsp; <button name="CmdVer" type="submit" class="iconbtn2"   value="" data-toggle="tooltip" data-placement="top" title="Ver" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"><i class="fa fa-search iconsmallbt iconlgray"></i></button>';
			if($row['Estado']!=3){	
			$tablaclientes .='&nbsp; <button name="CmdModificar" type="submit" class="iconbtn2"   value="" data-toggle="tooltip" data-placement="top" title="Modificar" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"><i class="fa fa-edit iconsmallbt iconlgray"></i></button>';
			}
			//restriccion perfiles
			if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2  or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10){  
				if($row['Estado']!=3){//si no esta eliminado			
				$tablaclientes .='&nbsp; <button name="CmdBorrar" type="submit" class="iconbtn2"   value="" data-toggle="tooltip" data-placement="top" title="Borrar" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');"><i class="fas fa-trash iconsmallbt iconlgray"></i></button>';
				}
			}
			//exportar pdf si no esta eliminado
			if($row['Estado']!=3){	
				$tablaclientes .=' <button name="CmdPDF" type="submit" class="iconbtn2"   value="" data-toggle="tooltip" data-placement="top" title="Constancia de Turno" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_blank'".'"><i class="far fa-file-pdf iconsmallbt iconred2"></i></button>';
			}
			$tablaclientes .="</td></tr>";  
			$recuento=$recuento+1;
		}	
		//Cerrar tabla
		$tablaclientes .="</table>"; 
		$tablaclientes .="<p class="."recuento"." align="."right"."> $recuento turnos | $recuentosa sin atender, $recuentoat atendidos, $recuentoeli eliminados</p>"; 
		$tablaclientes .='<table align="right" ><tr> <td></td></tr><tr><td>'.GLO_FAButton('CmdExcel','submit','110','self','Exportar','excel','').'</td></tr></table></td></tr></table>';
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center">No existen datos</p>';}
	//Cierra consulta
	mysql_free_result($rs);
	
}
}




function ComboEstado(){
$combo="";
if( "99" == $_SESSION['CbEstado']) { $combo .= " <option value="."'99'"." selected='selected'>".""."</option>\n";}
else{$combo .= " <option value="."'99'"." >".""."</option>\n";}
if( "0" == $_SESSION['CbEstado']) { $combo .= " <option value="."'0'"." selected='selected'>"."SIN ATENDER"."</option>\n";}
else{$combo .= " <option value="."'0'"." >"."SIN ATENDER"."</option>\n";}
if( "1" == $_SESSION['CbEstado']) { $combo .= " <option value="."'1'"." selected='selected'>"."ATENDIDO"."</option>\n";}
else{$combo .= " <option value="."'1'"." >"."ATENDIDO"."</option>\n";}
if( "3" == $_SESSION['CbEstado']) { $combo .= " <option value="."'3'"." selected='selected'>"."ELIMINADO"."</option>\n";}
else{$combo .= " <option value="."'3'"." >"."ELIMINADO"."</option>\n";}

echo $combo;
}


function ComboFPago(){
$combo="";
if( "99" == $_SESSION['CbFP']) { $combo .= " <option value="."'99'"." selected='selected'>".""."</option>\n";}
else{$combo .= " <option value="."'99'"." >".""."</option>\n";}
if( "0" == $_SESSION['CbFP']) { $combo .= " <option value="."'0'"." selected='selected'>"."CONTADO"."</option>\n";}
else{$combo .= " <option value="."'0'"." >"."CONTADO"."</option>\n";}
if( "1" == $_SESSION['CbFP']) { $combo .= " <option value="."'1'"." selected='selected'>"."CTA.CTE"."</option>\n";}
else{$combo .= " <option value="."'1'"." >"."CTA.CTE"."</option>\n";}
echo $combo;
}


GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHVCMIT','TurnosCMIT/zConsulta',0,0,0,0);
echo '<meta http-equiv="REFRESH" content="300">'; 
GLO_tituloypath(0,1120,'InicioCMIT.php','TURNOS REGISTRADOS','linksalir');
?>

<table width="900" border="0"   cellspacing="0" class="Tabla" >
	<tr>
		<td width="100" height="18" align="right">Fecha:</td>
		<td width="150">
			<input name="TxtFechaDCP" id="TxtFechaDCP" type="text" class="TextBox" style="width:100px" maxlength="10" onchange="this.value=validarFecha(this.value);" value="<? echo $_SESSION['TxtFechaDCP']; ?>"><?php calendario("TxtFechaDCP","Codigo/","actual"); ?>
		</td>
		<td width="210"> al <input name="TxtFechaHCP" id="TxtFechaHCP" type="text" class="TextBox"  style="width:100px;margin-left: 5px" maxlength="10" onchange="this.value=validarFecha(this.value);" value="<? echo $_SESSION['TxtFechaHCP']; ?>"><?php calendario("TxtFechaHCP","Codigo/","actual"); ?></td>
		<td width="70" height="18" align="right">Examen:</td>
		<td width="170">
			<select name="CbEx" class="campos" id="CbEx"  style="width:140px" onKeyDown="enterxtab(event)"><option value=""></option><? ComboTablaRFX("tipoexamen","CbEx","Id","","",$conn); ?></select></td>
		<td width="200">F.Pago: <select name="CbFP" class="campos" id="CbEstado"  style="width:100px" onKeyDown="enterxtab(event)"><? ComboFPago(); ?></select>
		</td>
	</tr>
	<tr>
		<td height="18" align="right">Empresa:</td>
		<td colspan="2"><input name="TxtBusqueda" type="text" class="TextBox" style="width:300px" maxlength="20" onKeyDown="enterxtab(event)"></td>
		<td height="18" align="right">Estado:</td>
		<td><select name="CbEstado" class="campos" id="CbEstado"  style="width:140px" onKeyDown="enterxtab(event)"><? ComboEstado(); ?></select></td>
		<td align="right"></td>
	</tr>

	<tr>
		<td height="18" align="right"></td>
		<td colspan="2" ></td>
		<td height="18" align="right"></td>
		<td></td>
		<td align="center"><input  name="TxtId"  type="hidden"  value="<? echo $_SESSION['TxtId']; ?>"><input  name="TxtConsultaTurnos"  type="hidden"   value="<? echo $_SESSION['TxtConsultaTurnos']; ?>"><? GLOF_Search('CmdBuscar',0); ?></td>
	</tr>


</table>


<table  width="900" border="0" cellspacing="0" cellpadding="0" >
	<tr>
		<td height="5"></td>
	</tr>
	<tr>
		<td><? if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2 or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10){ echo'<input name="CmdEliminar" type="submit" class="botonc"  value="Eliminar" onClick="document.Formulario.target='."'_self'".'">';} ?> </td>
	</tr>
	<tr>
		<td height=20></td>
	</tr>
</table>

<?
GLO_mensajeerror();
MostrarTabla($conn); 
GLO_cierratablaform();
mysql_close($conn);

GLO_initcomment(1120,0);
echo 'Si es un <font class="comentario2">sobre turno</font> la fecha se mostrar&aacute; en color <font class="comentario2">azul</font><br>';
echo 'Enviar&aacute; <font class="comentario3">Mail</font>  de aviso al Cliente si el turno tiene cliente asignado, no est&aacute; atendido y est&aacute; vigente';
GLO_endcomment();
include ("Codigo/FooterConUsuario.php");
?>