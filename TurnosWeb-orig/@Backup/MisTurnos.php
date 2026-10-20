<? include("Codigo/Seguridad.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";


$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);


function MostrarTabla($conn){
//trae turnos vigentes del usuario
$hoy=date("d-m-Y");$fecha=date("d-m-Y", strtotime("$hoy -7 day"));
$wfechad="and DATEDIFF(t.Fecha,'".FechaMySql($fecha)."')>=0";
$usr=$_SESSION["login"];
//trae RSF de usuarios
$query="SELECT u.RSF FROM usuarios u where u.Usuario='$usr'";$rs=mysql_query($query,$conn);
while($row=mysql_fetch_array($rs)){$rsf0=$row['RSF'];}mysql_free_result($rs);
//consulta
$query="Select t.*,tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF From turnos t,tipoexamen tex,entidades e,usuariosclientes uc Where t.Id<>0 and t.Estado<>3 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and t.IdUsuario='$usr' and uc.Id=t.IdRSF $wfechad Order by t.Fecha,t.Hora";
if ( ($query!="")){
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//Titulos de la tabla		
		$tablaclientes="";
		$tablaclientes .="<table width="."850"." border="."0"." cellspacing="."0"." cellpadding="."0"." >";
		$tablaclientes .="<tr><td class="."TablaTituloLeft"."> </td>"; 		
		$tablaclientes .="<td "."width="."50"." class="."TablaTituloDato"." style='text-align:right;' > N°Turno</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>";   
		$tablaclientes .="<td "."width="."120"." class="."TablaTituloDato"."> Fecha</td>";  
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."110"." class="."TablaTituloDato"."> Razón Social</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."230"." class="."TablaTituloDato"."> Paciente</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TablaTituloDato"."> Tipo Examen</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."80"." class="."TablaTituloDato"."> Estado</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."140"." class="."TablaTituloDato"."></td>"; 
		$tablaclientes .="<td class="."TablaTituloRight"."> </td>";  
		$tablaclientes .=" </tr> ";    
		$recuento=0;          
		while($row=mysql_fetch_array($rs)){
			if($row['IdRSF']==0){$empresa=$rsf0;}else{$empresa=$row['RSF'];}
			if($row['Estado']==0){$estado='Sin Atender';$colorest='';}else{$estado='Atendido';$colorest=' style="font-weight:bold;color:#009900"';}
			$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha'])).' '.FormatoFecha($row['Fecha']).' '.date("H:i",strtotime($row['Hora']));
			$clickeliminar="'¿Desea eliminar el turno ".$fecha."? Grabará los cambios y enviará mail a su Usuario'";
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TablaMostrarLeft"." > </td>"; 
			$tablaclientes .="<td class="."TablaDato"." style='text-align:right;'> ".str_pad($row['Id'], 6, "0", STR_PAD_LEFT)."</td>";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato"."> ".$fecha."</td>";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato"."> ".substr($empresa,0,12)."</td>";  			
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
			$tablaclientes .="<td class="."TablaDato"."> ".substr($row['Paciente'],0,30)."</td>";  			
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato"."> ".substr($row['TipoEx'],0,20)."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato".$colorest."> ".$estado."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato"." style='text-align:left;'>&nbsp;"; 
			if($row['Estado']==0){
				$tablaclientes .='<input name="CmdVer" type="submit" class="boton2"   value="Editar" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"> <input name="CmdBorrar" type="submit" class="boton2"   value="Borrar" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');">';
			}else{
				$tablaclientes .='<input name="CmdSoloVer" type="submit" class="boton2"   value="Ver" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"> ';
			}
			$tablaclientes .="</td><td class="."TablaMostrarRight"."> </td>";  
			$tablaclientes .=" </tr> "; 
			$recuento=$recuento+1;
		}	
		//Cerrar tabla
		$tablaclientes .="</table>"; 
		$tablaclientes .="<p class="."recuento"." align="."right"."> $recuento turnos</p>"; 
		$tablaclientes .='<table align="right" ><tr> <td></td></tr><tr><td><input name="CmdExcel"  type="submit" class="boton1"  value="Exportar" onClick="document.Formulario.target='."'_self'".'"></td></tr></table>';
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center">No existen datos</p>';}
	//Cierra consulta
	mysql_free_result($rs);
	
}
}








?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<? include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css">
</head>



<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['CmdBuscar'].focus()">
<? include ("Codigo/BannerConMenuHV.php");?>

<form  name="Formulario" action="Turnos/zMisTurnos.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"   >
<tr> <td height="5"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="860" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >MIS TURNOS </td></tr>
</table>
<table width="850" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr> <td height="2" width="300"></td><td width="550"></td></tr>
<tr> <td height="16"  align="right"><input  name="TxtId"  type="hidden"  value="<? echo $_SESSION[TxtId]; ?>"></td>
  <td   align="right" ><input name="CmdSalir"  type="submit" class="boton1"   value="Volver" onClick="document.Formulario.target='_self'">&nbsp;
</td></tr>
<tr> <td height="2"></td></tr>
</table>


<table  width="740" border="0" cellspacing="0" cellpadding="0" >
<tr  valign="bottom"><td align="left" valign="bottom" ></td>	</tr>
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table>

<table  width="850" border="0" cellspacing="0" cellpadding="0" >
<tr><td  height=3 ></td></tr>
<tr valign="top"> 	<td  align="center" valign="top" > 	<?php MostrarTabla($conn); ?>	</td>	</tr>
</table>

</td></tr>      
</table>
<? mysql_close($conn);

$_SESSION[TxtId]=""; 

?>
</Form>		
<!-- Comentario-->
<table  width="800" border="0" cellspacing="0" cellpadding="0"  >
<tr><td class="comentario1">
Los Turnos con una antigüedad mayor a una semana serán borrados automáticamente.
</td></tr>
</table>
<!-- fin Comentario-->


<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>
