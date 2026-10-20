<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
require_once('Codigo/calendar/classes/tc_calendar.php');

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}




$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

//completa fecha por defecto
if (empty($_SESSION['TxtFechaDCP'])){
	$hoy=date("d-m-Y");list($d,$m,$a)=explode("-",$hoy); $primerdiames="01-".$m."-".$a;
	$_SESSION['TxtFechaDCP']=date("d-m-Y", strtotime("$primerdiames -1 month"));
	$_SESSION['TxtFechaHCP']=date("d-m-Y", strtotime("$primerdiames +1 month"));
}




function MostrarTabla($conn){
$query=$_SESSION[TxtQEliminarM];$query=str_replace("\\", "", $query);
if ( ($query!="")){
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//guardar
		$tablaclientes="";
		$tablaclientes .="<table width="."940"." border="."0"." cellspacing="."0"." cellpadding="."0"." ><tr>";
		$tablaclientes .="<td align="."right".">".'<input name="CmdGuardar" type="submit" class="botongrabar"  title="Guardar" value=""> '."</td>"; 		
		$tablaclientes .="</tr><tr><td "."height="."3"."></td></tr></table>";
		//Titulos de la tabla		
		$tablaclientes .="<table width="."940"." border="."0"." cellspacing="."0"." cellpadding="."0"." ><tr>";
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."50"." class="."TablaTituloDato"." style='text-align:right;'> Nro</td>";   
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TablaTituloDato"."> Fecha</td>";  
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."200"." class="."TablaTituloDato"."> Razón Social</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."140"." class="."TablaTituloDato"."> CUIT</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."200"." class="."TablaTituloDato"."> Paciente</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TablaTituloDato"."> Tipo Examen</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."80"." class="."TablaTituloDato"."> Estado</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .='<td width="30" class="TablaTituloDato" align="center"> <input type="checkbox" name="ChkAll" unchecked onclick="CheckMasivo();"></td>';
		$tablaclientes .="<td class="."TablaTituloRight"."> </td>";  
		$tablaclientes .=" </tr> ";    
		$recuento=0;$recuentosa=0; $recuentoat=0;  $recuentoeli=0;             
		while($row=mysql_fetch_array($rs)){
			if ($row['Estado']==3){$clase="TablaDatoR2";}else{$clase="TablaDato";}	
			if($row['IdRSF']==0){$empresa=$row['RSF0'];$cuit=$row['CUITF0'];}else{$empresa=$row['RSF'];$cuit=$row['CUITF'];}
			if($row['Estado']==0){$estado='Sin Atender';$colorest='';$recuentosa=$recuentosa+1;}
			if($row['Estado']==1){$estado='Atendido';$colorest=' style="font-weight:bold;color:#009900"';$recuentoat=$recuentoat+1;}
			if($row['Estado']==3){$estado='Eliminado';$colorest=' style="font-weight:bold;color:#86868b"';$recuentoeli=$recuentoeli+1;}
			$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha'])).' '.FormatoFecha($row['Fecha']).' '.date("H:i",strtotime($row['Hora']));
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
			$tablaclientes .="<td class=".$clase." style='text-align:right;'> ".str_pad($row['Id'], 6, "0", STR_PAD_LEFT)."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".$fecha."</td>";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".substr($empresa,0,18)."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".substr($cuit,0,18)."</td>";  			
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
			$tablaclientes .="<td class=".$clase."> ".substr($row['Paciente'],0,20)."</td>";  			
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".substr($row['TipoEx'],0,20)."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato".$colorest."> ".$estado."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato".' align="center"'."> ".'<input type="checkbox" name="campos['.$row['Id'].']" >'."</td>";  
			$tablaclientes .="<td class="."TablaMostrarRight"."> </td>";  
			$tablaclientes .=" </tr> "; 
			$recuento=$recuento+1;
		}	
		//Cerrar tabla
		$tablaclientes .="</table>"; 
		$tablaclientes .="<p class="."recuento"." align="."right"."> $recuento turnos | $recuentosa sin atender, $recuentoat atendidos, $recuentoeli eliminados</p>"; 
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center">No existen datos</p>';}
	//Cierra consulta
	mysql_free_result($rs);
	
}
}




function ComboEstado(){
$combo="";
if( "99" == $_SESSION[CbEstado]) { $combo .= " <option value="."'99'"." selected='selected'>".""."</option>\n";}
else{$combo .= " <option value="."'99'"." >".""."</option>\n";}
if( "0" == $_SESSION[CbEstado]) { $combo .= " <option value="."'0'"." selected='selected'>"."SIN ATENDER"."</option>\n";}
else{$combo .= " <option value="."'0'"." >"."SIN ATENDER"."</option>\n";}
if( "1" == $_SESSION[CbEstado]) { $combo .= " <option value="."'1'"." selected='selected'>"."ATENDIDO"."</option>\n";}
else{$combo .= " <option value="."'1'"." >"."ATENDIDO"."</option>\n";}
if( "3" == $_SESSION[CbEstado]) { $combo .= " <option value="."'3'"." selected='selected'>"."ELIMINADO"."</option>\n";}
else{$combo .= " <option value="."'3'"." >"."ELIMINADO"."</option>\n";}

echo $combo;
}


function ComboFPago(){
$combo="";
if( "99" == $_SESSION[CbFP]) { $combo .= " <option value="."'99'"." selected='selected'>".""."</option>\n";}
else{$combo .= " <option value="."'99'"." >".""."</option>\n";}
if( "0" == $_SESSION[CbFP]) { $combo .= " <option value="."'0'"." selected='selected'>"."CONTADO"."</option>\n";}
else{$combo .= " <option value="."'0'"." >"."CONTADO"."</option>\n";}
if( "1" == $_SESSION[CbFP]) { $combo .= " <option value="."'1'"." selected='selected'>"."CTA.CTE"."</option>\n";}
else{$combo .= " <option value="."'1'"." >"."CTA.CTE"."</option>\n";}
echo $combo;
}


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<? include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css">
<link href="Codigo/calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="Codigo/calendar/calendar.js"></script>
<meta http-equiv="REFRESH" content="300"> 
</head>



<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['CmdBuscar'].focus()">
<? include ("Codigo/BannerConMenuHVCMIT.php");?>

<form  name="Formulario" action="TurnosCMIT/zEliminarMasivo.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"   >
<tr> <td height="5"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="950" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >ELIMINAR TURNOS</td></tr>
</table>


<table width="740" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr> <td height="5" width="70"></td><td width="100"></td><td width="140"></td><td width="70"></td><td width="190"></td><td width="170"></td></tr>
<tr> <td height="18"  align="right">&nbsp;Fecha:</td><td  >&nbsp;<input name="TxtFechaDCP"  id="TxtFechaDCP" type="text" class="TextBox"  style="width:70px" maxlength="10"  onchange="this.value=validarFecha(this.value);" value="<? echo $_SESSION[TxtFechaDCP]; ?>"   >
	<?php
	  $myCalendar = new tc_calendar("TxtFechaDCP", true, false);
	  $myCalendar->setIcon("Codigo/calendar/images/calendario.png");
	  $myCalendar->setDate(date(d), date(m), date(Y)); $myCalendar->setPath("./");
	  $myCalendar->setYearInterval(2010, 2020);
	  $myCalendar->dateAllow('2010-01-01', '2020-01-01');$myCalendar->setDateFormat('j F Y'); $myCalendar->writeScript();
	 ?>
</td><td  > al&nbsp;<input name="TxtFechaHCP"  id="TxtFechaHCP" type="text" class="TextBox"  style="width:70px" maxlength="10"  onchange="this.value=validarFecha(this.value);" value="<? echo $_SESSION[TxtFechaHCP]; ?>"   >
	<?php
	  $myCalendar = new tc_calendar("TxtFechaHCP", true, false);
	  $myCalendar->setIcon("Codigo/calendar/images/calendario.png");
	  $myCalendar->setDate(date(d), date(m), date(Y)); $myCalendar->setPath("./");
	  $myCalendar->setYearInterval(2010, 2020);
	  $myCalendar->dateAllow('2010-01-01', '2020-01-01');$myCalendar->setDateFormat('j F Y'); $myCalendar->writeScript();
	 ?>
</td>
<td height="18" align="right">Examen:</td><td >&nbsp;<select name="CbEx" class="campos" id="CbEx"  style="width:140px" onKeyDown="enterxtab(event)"><option value=""></option><? ComboTablaRFX("tipoexamen","CbEx","Nombre","","",$conn); ?></select></td>
<td >F.Pago: <select name="CbFP" class="campos" id="CbEstado"  style="width:80px" onKeyDown="enterxtab(event)"><? ComboFPago(); ?></select></td></tr>
<tr><td  height=3 ></td></tr>
<tr> <td height="18"  align="right">Empresa:</td><td  colspan="2" >&nbsp;<input name="TxtBusqueda" type="text" class="TextBox" style="width:180px" maxlength="20" onKeyDown="enterxtab(event)"></td><td height="18" align="right">Estado:</td><td >&nbsp;<select name="CbEstado" class="campos" id="CbEstado"  style="width:140px" onKeyDown="enterxtab(event)"><? ComboEstado(); ?></select></td><td   align="right" ><input  name="TxtId"  type="hidden"  value="<? echo $_SESSION[TxtId]; ?>"><input  name="TxtQEliminarM"  type="hidden"   value="<? echo $_SESSION[TxtQEliminarM]; ?>"><input name="CmdBuscar"  type="submit" class="botonbuscarG"  value="" onClick="document.Formulario.target='_self'">&nbsp;<input name="CmdSalir"  type="submit" class="botonsalirG"   value="" onClick="document.Formulario.target='_self'">&nbsp;
</td></tr>
<tr><td  height=3 ></td></tr>
</table>



<table  width="940" border="0" cellspacing="0" cellpadding="0" >
<tr  valign="bottom"><td align="left" valign="bottom" ></td>	</tr>
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
<tr><td  height=3 ></td></tr>
<tr valign="top"> 	<td  align="center" valign="top" > 	<?php MostrarTabla($conn); ?>	</td>	</tr>
</table>


</td></tr>      
</table>
<? mysql_close($conn);

$_SESSION[TxtId]=""; 
$_SESSION[TxtFechaDCP]="";$_SESSION[TxtFechaHCP]=""; $_SESSION[CbEx]=""; $_SESSION[CbEstado]=""; 
$_SESSION[TxtBusqueda]="";$_SESSION[CbFP]="";$_SESSION[TxtQEliminarM]=""; 
?>
</Form>		


<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>
