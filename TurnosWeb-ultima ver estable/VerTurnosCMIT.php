<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}
GLO_ValidaGETTUR($_GET['Id'],0,0,'InicioCMIT');//valida que no sea vacio

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

list($f,$h,$a)=explode("|",mysql_real_escape_string(decrypt($_GET['Id'],'elcrucedelosandes2016')));
$_SESSION['TxtFecha']=$f;$_SESSION['TxtHora']=$h;$_SESSION['TxtIdAgenda']=$a;
$_SESSION['TxtIdEncriptado']=$_GET['Id'];



function MostrarTabla($conn){
$f=FechaMySql($_SESSION['TxtFecha']);
$h=$_SESSION['TxtHora'];
$a=intval($_SESSION['TxtIdAgenda']);
//consulta
$query="Select t.*,tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF,uc.CUITF,u.RSF as RSF0,u.CUITF as CUITF0 From turnos t,tipoexamen tex,entidades e,usuariosclientes uc,usuarios u Where t.Id<>0 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and uc.Id=t.IdRSF and u.usuario=t.IdUsuario and t.IdAgenda=$a and t.Fecha='$f' and t.Hora='$h' Order by t.Fecha,t.Hora";
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
			if($row['Estado']==1){$estado='Atendido';$colorest=' style="font-weight:bold;color:#0F9D58"';$recuentoat=$recuentoat+1;}
			if($row['Estado']==3){$estado='Eliminado';$colorest=' style="font-weight:bold;color:#86868b"';$recuentoeli=$recuentoeli+1;}
			$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha'])).' '.FormatoFecha($row['Fecha']).' '.date("H:i",strtotime($row['Hora']));
			$clickeliminar="'Desea eliminar el turno ".$fecha."? Grabara los cambios y enviara mail al Cliente'";
			$clickatender="'Desea atender el turno ".$fecha."?'";
			//si es sobreturno letra azul
			if( $row['STurno']==1){$estilost=' style="font-weight:bold;color:#4285F4;"';}
			else{$estilost='';}
			//			
			$tablaclientes .='<tr '.GLO_highlight($row['Id']).'>';
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center;">'.str_pad($row['Id'], 6, "0", STR_PAD_LEFT)."</td>"; 
			$tablaclientes .='<td class="'.$clase.'"'.$estilost." style='text-align:center;'> ".$fecha."</td>";  
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center;">'.substr($empresa,0,22)."</td>"; 
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center;">'.substr($cuit,0,15)."</td>";  			
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center;">'.substr($row['Paciente'],0,25)."</td>";
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center;">'.substr($row['TipoEx'],0,20)."</td>"; 
			$tablaclientes .='<td class="'.$clase.'"'.$colorest." style='text-align:center;'> ".$estado."</td>"; 
			$tablaclientes .='<td class="'.$clase.'" style="text-align:center;">'; 
			if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2  or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10){ 			
				if($row['Estado']==0){
					$tablaclientes .='<button name="CmdAtender" type="submit" class="iconbtn2"   value="" data-toggle="tooltip" data-placement="top" title="Atender" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickatender.');"><i class="fa fa-check iconsmallbt iconlgray"></i></button>';
				}
			}
			$tablaclientes .='&nbsp; <button name="CmdVer" type="submit" class="iconbtn2" data-toggle="tooltip" data-placement="top" value="" title="Ver" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"><i class="fa fa-search iconsmallbt iconlgray"></i></button>';
			if($row['Estado']!=3){	
			$tablaclientes .='&nbsp; <button name="CmdModificar" type="submit" class="iconbtn2" value="" data-toggle="tooltip" data-placement="top" title="Modificar" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"><i class="fa fa-edit iconsmallbt iconlgray"></i></button>';
			}
			if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2  or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10){ 
				if($row['Estado']!=3){ 			
				$tablaclientes .='&nbsp; <button name="CmdBorrar" type="submit" class="iconbtn2" value="" data-toggle="tooltip" data-placement="top" title="Borrar" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');"><i class="fas fa-trash iconsmallbt iconlgray"></i></button>';
				}
			}
			//exportar pdf si no esta eliminado
			if($row['Estado']!=3){	
				$tablaclientes .='&nbsp; <button name="CmdPDF" type="submit" class="iconbtn2" value="" data-toggle="tooltip" data-placement="top" title="Constancia de Turno" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_blank'".'"><i class="far fa-file-pdf iconsmallbt iconred2"></i></button>';
			}
			$tablaclientes .="&nbsp;</td>";  
			$tablaclientes .=" </tr> "; 
			$recuento=$recuento+1;
		}	
		//Cerrar tabla
		$tablaclientes .="</table>"; 
		$tablaclientes .="<p class="."recuento"." align="."right"." style='margin: 5px; 0px'> $recuento turnos | $recuentosa sin atender, $recuentoat atendidos, $recuentoeli eliminados</p>"; 
		$tablaclientes .='<table align="right" ><tr> <td></td></tr><tr><td>'.GLO_FAButton('CmdExcel','submit','110','self','Exportar','excel','').'</td></tr></table></td></tr></table>';
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center"><i class="fas fa-exclamation-circle" style="margin-right:5px"></i> No existen datos</p>';}
	//Cierra consulta
	mysql_free_result($rs);
	
}
}

GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHVCMIT','TurnosCMIT/zVerTurnos',0,0,0,0);
echo '<meta http-equiv="REFRESH" content="300">'; 
GLO_tituloypath(0,1120,'InicioCMIT.php','TURNOS REGISTRADOS PARA EL DIA: <b>'.$f.'</b> HORA: <b>'.$h.'</b>','linksalir');
?>

<table width="1120" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
	<tr>
		<td height="2" width="300"></td>
		<td width="710"></td>
	</tr>
	<tr>
		<td height="16"  align="right">
			<input name="TxtId" type="hidden" value="<? echo $_SESSION[TxtId]; ?>">
			<input name="TxtFecha" type="hidden" value="<? echo $_SESSION[TxtFecha];?>">
			<input name="TxtHora" type="hidden"  value="<? echo $_SESSION[TxtHora];?>">
			<input name="TxtIdAgenda" type="hidden" value="<? echo $_SESSION[TxtIdAgenda];?>">
			<input name="TxtIdEncriptado" type="hidden" value="<? echo $_SESSION[TxtIdEncriptado];?>">
		</td>
		<td align="right">
			<?
			//restriccion perfiles
			if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2  or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10){ 		
				//verifico si se puede agregar
				$fecha=$_SESSION['TxtFecha'];
				$hora=$_SESSION['TxtHora'];
				$varagenda=intval($_SESSION['TxtIdAgenda']);
				//variables
				include("Includes/zVariables.php");
				//hora
				list($h1,$m1)=explode(":",$hora);$horamin=$m1+($h1*60);
				list($h1,$m1)=explode(":",date("H:i"));$horaminactual=$m1+($h1*60);
				//tipo dia y turnos disponibles
				include("Includes/zTipoDia.php");
				//libre,no domingo,sabado dentro de horario,horariovigente,no feriado
				if($ocupado==0 and $domingo==0 and $sabado==0 and $horavieja==0 and $feriado==0){
				 echo '<button name="CmdAgregar" type="submit" class="btn btn-prest3" value="Agregar" onClick="document.Formulario.target='."'_self'".'">Agregar <i class="fa fa-angle-right"></i></button>';
				}
			}
			?>
		</td>
	</tr>
</table>



<? 
GLO_mensajeerror();
MostrarTabla($conn);
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(1120,0);
echo 'Si es un <font class="comentario2">sobre turno</font> la fecha se mostrar&aacute; en color <font class="comentario2">azul</font><br>';
echo 'Enviar&aacute; <font class="comentario3">mail</font> de aviso al Cliente si el turno: tiene cliente asignado, no est&aacute; atendido y est&aacute; vigente';
GLO_endcomment();
include ("Codigo/FooterConUsuario.php");
?>