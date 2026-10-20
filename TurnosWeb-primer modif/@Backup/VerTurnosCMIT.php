<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}


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
		$tablaclientes .=GLO_inittabla(950,0,0,0);
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."50"." class="."TablaTituloDato"." style='text-align:right;'> Nro</td>";   
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TablaTituloDato"."> Fecha</td>";  
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."170"." class="."TablaTituloDato"."> Razón Social</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TablaTituloDato"."> CUIT</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."200"." class="."TablaTituloDato"."> Paciente</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TablaTituloDato"."> Tipo Examen</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."80"." class="."TablaTituloDato"."> Estado</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."90"." class="."TablaTituloDato"."></td>"; 
		$tablaclientes .="<td class="."TablaTituloRight"."> </td>";  
		$tablaclientes .=" </tr> ";    
		$recuento=0;$recuentosa=0; $recuentoat=0;  $recuentoeli=0;          
		while($row=mysql_fetch_array($rs)){
			if ($row['Estado']==3){$clase="TablaDatoR2";}else{$clase="TablaDato";}	
			if($row['IdRSF']==0){$empresa=$row['RSF0'];$cuit=$row['CUITF0'];}else{$empresa=$row['RSF'];$cuit=$row['CUITF'];}
			if($row['Estado']==0){$estado='Sin Atender';$colorest='';$recuentosa=$recuentosa+1;}
			if($row['Estado']==1){$estado='Atendido';$colorest=' style="font-weight:bold;color:#4CAF50"';$recuentoat=$recuentoat+1;}
			if($row['Estado']==3){$estado='Eliminado';$colorest=' style="font-weight:bold;color:#86868b"';$recuentoeli=$recuentoeli+1;}
			$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha'])).' '.FormatoFecha($row['Fecha']).' '.date("H:i",strtotime($row['Hora']));
			$clickeliminar="'¿Desea eliminar el turno ".$fecha."? Grabará los cambios y enviará mail al Cliente'";
			$clickatender="'¿Desea atender el turno ".$fecha."?'";
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
			$tablaclientes .="<td class=".$clase." style='text-align:right;'> ".str_pad($row['Id'], 6, "0", STR_PAD_LEFT)."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".$fecha."</td>";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".substr($empresa,0,22)."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".substr($cuit,0,15)."</td>";  			
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
			$tablaclientes .="<td class=".$clase."> ".substr($row['Paciente'],0,25)."</td>";  			
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".substr($row['TipoEx'],0,20)."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase.$colorest."> ".$estado."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase." style='text-align:right;'>"; 
			if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2  or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10){ 			
				if($row['Estado']==0){
					$tablaclientes .='<input name="CmdAtender" type="submit" class="botonseleccionar"   value="" title="Atender" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickatender.');"> ';
				}
			}
			$tablaclientes .='<input name="CmdVer" type="submit" class="botonlupa"   value="" title="Ver" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"> ';
			if($row['Estado']!=3){	
			$tablaclientes .='<input name="CmdModificar" type="submit" class="botonmodificar"   value="" title="Modificar" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"> ';
			}
			if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2  or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10){ 
				if($row['Estado']!=3){ 			
				$tablaclientes .='<input name="CmdBorrar" type="submit" class="botonborrar"   value="" title="Borrar" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');">';
				}
			}
			$tablaclientes .="&nbsp;</td><td class="."TablaMostrarRight"."> </td>";  
			$tablaclientes .=" </tr> "; 
			$recuento=$recuento+1;
		}	
		//Cerrar tabla
		$tablaclientes .="</table>"; 
		$tablaclientes .="<p class="."recuento"." align="."right"."> $recuento turnos | $recuentosa sin atender, $recuentoat atendidos, $recuentoeli eliminados</p>"; 
		$tablaclientes .='<table align="right" ><tr> <td></td></tr><tr><td><input name="CmdExcel"  type="submit" class="botonexcel"  value="" onClick="document.Formulario.target='."'_self'".'"></td></tr></table></td></tr></table>';
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center">No existen datos</p>';}
	//Cierra consulta
	mysql_free_result($rs);
	
}
}
?>

<? include ("Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css" >
<meta http-equiv="REFRESH" content="300"> 
<? GLO_bodyform('',0,0); ?>
<? include ("Codigo/BannerConMenuHVCMIT.php");?>
<? GLO_formform('Formulario','TurnosCMIT/zVerTurnos.php',0,0,0); ?>
<? GLO_tituloypath(0,900,'','TURNOS REGISTRADOS '.$f.' '.$h,'salir'); ?>

<table width="900" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr> <td height="2" width="300"></td><td width="600"></td></tr>
<tr> <td height="16"  align="right"><input  name="TxtId"  type="hidden"  value="<? echo $_SESSION[TxtId]; ?>"><input  name="TxtFecha" type="hidden"  value="<? echo $_SESSION[TxtFecha];?>"><input  name="TxtHora" type="hidden"  value="<? echo $_SESSION[TxtHora];?>"><input  name="TxtIdAgenda" type="hidden"  value="<? echo $_SESSION[TxtIdAgenda];?>"><input  name="TxtIdEncriptado" type="hidden"  value="<? echo $_SESSION[TxtIdEncriptado];?>"></td><td   align="right" >

<?
//restriccion perfiles
if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2  or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10){ 		
	//verifico si se puede agregar
	$fecha=$_SESSION['TxtFecha'];
	$hora=$_SESSION['TxtHora'];
	$varagenda=intval($_SESSION['TxtIdAgenda']);
	$varminreserva=30;$varturnos=5;$varturnos8hs=10;$varturnosotros=5;
	list($h1,$m1)=explode(":",$hora);$horamin=$m1+($h1*60);
	list($h1,$m1)=explode(":",date("H:i"));$horaminactual=$m1+($h1*60);
	//domingo
	if(date('w',strtotime($fecha))==0){$domingo=1;}else{$domingo=0;}
	//sabado fuera de horario de atencion
	if(date('w',strtotime($fecha))==6 and ($horamin<540 or $horamin>675 )){$sabado=1;}else{$sabado=0;}
	//horario no vigente hoy
	if((($horaminactual+$varminreserva)>$horamin) and (strtotime($fecha)==strtotime(date("d-m-Y")))){$horavieja=1;}else{$horavieja=0;}
	//si es horario 08:00 lleva cantidad distinta de turnos
	if($horamin==480){$varturnos=$varturnos8hs;}else{$varturnos=$varturnosotros;}
	//busco si hay turno disponible(y cuantos)
	$ocupado=0;
	$query="Select Count(Id) as Cant From turnos Where Estado<>3 and IdAgenda=$varagenda and Fecha='".FechaMySql($fecha)."' and Hora='$hora'";
	$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
	if(mysql_num_rows($rs)!=0){if($row['Cant']>=$varturnos){$ocupado=1;}}mysql_free_result($rs);
	
	//busco si es feriado
	$feriado=GLO_TURFeriado($fecha,$conn);
	
	//libre,no domingo,sabado dentro de horario,horariovigente,no feriado
	if($ocupado==0 and $domingo==0 and $sabado==0 and $horavieja==0 and $feriado==0){
	 echo '<input name="CmdAgregar"  type="submit" class="boton"   value="Agregar" onClick="document.Formulario.target='."'_self'".'">';
	}
}
?>
</td></tr>
<tr> <td height="2"></td></tr>
</table>


<table  width="740" border="0" cellspacing="0" cellpadding="0" >
<tr  valign="bottom"><td align="left" valign="bottom" ></td>	</tr>
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table>


<? 
MostrarTabla($conn);
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(920,0);
echo 'Enviará <font class="comentario3">Mail</font>  de aviso al Cliente si el turno: tiene cliente asignado, no está atendido y está vigente';
GLO_endcomment();
?>


<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>
