<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";require_once('Codigo/calendar/classes/tc_calendar.php');

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}



//completa fecha por defecto
if (empty($_SESSION['TxtFechaD'])){
	$hoy=date("d-m-Y"); list($d,$m,$a)=explode("-",$hoy);
	$primerdiames="01-01-".$a;$ultimodiames="31-12-".$a;
	$_SESSION['TxtFechaD']=date("d-m-Y", strtotime("$primerdiames -0 month"));
	$_SESSION['TxtFechaH']=date("d-m-Y", strtotime("$ultimodiames -0 month"));
	
}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

function MostrarTabla($conn){
$query=$_SESSION[TxtQuery23];$query=str_replace("\\", "", $query);
if (  ($query!="")){	
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		$tablaclientes="";
		$tablaclientes .="<table width="."500"." border="."0"." cellspacing="."0"." cellpadding="."0"." ><tr>";
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."70"." class="."TablaTituloDato"."> Fecha</td>";   
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."290"." class="."TablaTituloDato"."> Nombre</td>";   
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."100"." class="."TablaTituloDato"."> Dia</td>";   
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."40"." class="."TablaTituloDato"."></td>";   
		$tablaclientes .="<td class="."TablaTituloRight"."> </td>";  
		$tablaclientes .=" </tr> ";    
		$recuento=0;          
		//Datos
		while($row=mysql_fetch_array($rs)){ 
			$estilo=" style='cursor:pointer;' title="."Modificar";
			$link=" onclick="."location='Feriados/Modificar.php?Flag1=True&id=".$row['Id']."'";
			$fecha = FormatoFecha($row['Fecha']);if ($fecha=='00-00-0000'){$fecha="";}
			$clase="TablaDato";
			$clickeliminar="'Eliminar ".$row['Nombre']."'";
			//muestro
			$tablaclientes .=" <tr".$estilo."> ";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";    
			$tablaclientes .="<td class=".$clase.$link."> ".$fecha."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";    
			$tablaclientes .="<td class=".$clase.$link."> ".substr($row['Nombre'],0,40)."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";    
			$tablaclientes .="<td class=".$clase.$link."> ".substr(ObtenerDiaSemana($fecha),0,20)."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
			$tablaclientes .="<td class="."TablaDato"." style='text-align:center;'>".'<input name="CmdBorrarFila" type="submit"  class="botonborrar" title="Eliminar" value=""  id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;return confirm('.$clickeliminar.');">'. "</td>";  
			$tablaclientes .="<td class="."TablaMostrarRight"."> </td>";  
			$tablaclientes .=" </tr> "; 
			$recuento=$recuento+1;
		}	
		$tablaclientes .="</table>"; 
		$tablaclientes .="<p class="."recuento"." align="."right"."> $recuento registros</p>"; 
		$tablaclientes .='<table align="right" ><tr> <td></td></tr><tr><td><input name="CmdExcel"  type="submit" class="botonexcel"  value="" ></td></tr></table>';
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center">No existen datos que cumplan esos criterios</p>';}
	mysql_free_result($rs);
}
}


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<? include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css">
<link href="Codigo/calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="Codigo/calendar/calendar.js"></script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['TxtBusqueda'].focus()">
<? include ("Codigo/BannerConMenuHVCMIT.php");?>


<form  name="Formulario" action="Feriados/zFeriados.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"  >
<tr> <td height="5"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="750" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >FERIADOS</td></tr>
</table>
<table width="500" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr><td  height=3 width="155" ></td><td  height=3 width="105"></td><td  height=3 width="130"></td><td  height=3 width="10"></td><td  height=3 width="30"></td><td  height=3 width="70"></td></tr>
<tr><td  align="right" >Fecha Inicio:</td><td  >&nbsp;<input name="TxtFechaD"  id="TxtFechaD" type="text" class="TextBox"  style="width:65px" maxlength="10"  onchange="this.value=validarFecha(this.value);" value="<? echo $_SESSION[TxtFechaD]; ?>"   >
	<?php
	  $myCalendar = new tc_calendar("TxtFechaD", true, false);
	  $myCalendar->setIcon("Codigo/calendar/images/calendario.png");
	  $myCalendar->setDate(date(d), date(m), date(Y)); $myCalendar->setPath("./");
	  $myCalendar->setYearInterval(2010, 2020);
	  $myCalendar->dateAllow('2010-01-01', '2020-01-01');$myCalendar->setDateFormat('j F Y'); $myCalendar->writeScript();
	 ?>
</td><td  > al&nbsp; <input name="TxtFechaH"  id="TxtFechaH" type="text" class="TextBox"  style="width:65px" maxlength="10"  onchange="this.value=validarFecha(this.value);" value="<? echo $_SESSION[TxtFechaH]; ?>"   >
	<?php
	  $myCalendar = new tc_calendar("TxtFechaH", true, false);
	  $myCalendar->setIcon("Codigo/calendar/images/calendario.png");
	  $myCalendar->setDate(date(d), date(m), date(Y)); $myCalendar->setPath("./");
	  $myCalendar->setYearInterval(2010, 2020);
	  $myCalendar->dateAllow('2010-01-01', '2020-01-01');$myCalendar->setDateFormat('j F Y'); $myCalendar->writeScript();
	 ?>
</td><td  align="right" >&nbsp;</td><td>&nbsp;</td>
<td  align="right"><input name="CmdBuscar"  type="submit" class="botonbuscarG"  title="Buscar" value="" onClick="document.Formulario.target='_self'">&nbsp;<input name="CmdSalir"  type="submit" class="botonsalirG"  title="Salir" value="" onClick="document.Formulario.target='_self'">&nbsp;</td>	</tr>
<tr><td  height=5 ></td></tr>
</table>
<!--Boton agregar y tabla-->
<table  width="500" border="0" cellspacing="0" cellpadding="0" >
<tr><td  height=3 ></td></tr>
<tr  valign="bottom"><td align="left" valign="bottom" >
<input name="CmdAgregar" type="submit" class="boton"  title="Agregar" value="Agregar" onClick="document.Formulario.target='_self'"> 
<input  name="TxtId"  type="hidden"  value="<? echo $_SESSION[TxtId]; ?>"><input  name="TxtQuery23"  type="hidden"   value="<? echo $_SESSION[TxtQuery23]; ?>"></td>	</tr>
<tr> <td  height="3" ></td></tr>
<tr valign="top"> 	<td  align="center" valign="top" > 	<?php MostrarTabla($conn); ?>	</td>	</tr>
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table>
</td></tr>      
</table>
<? mysql_close($conn);

$_SESSION[TxtId]="";$_SESSION[TxtFechaD]="";$_SESSION[TxtFechaH]="";?>
</Form>		


<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>
