<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";require_once('../Codigo/calendar/classes/tc_calendar.php');

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}



//mostrar datos
if ($_GET['Flag1']=="True"){
	$query="SELECT * From feriados where Id=".intval($_GET['id']);
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);$rs=mysql_query($query,$conn);
	while($row=mysql_fetch_array($rs)){
		$_SESSION['TxtNumero'] = str_pad($row['Id'], 6, "0", STR_PAD_LEFT);
		$_SESSION['TxtFechaA'] = FormatoFecha($row['Fecha']);
		if ($_SESSION['TxtFechaA']=='00-00-0000'){$_SESSION['TxtFechaA']="";$_SESSION['TxtDia']="";}
		else{$_SESSION['TxtDia']=ObtenerDiaSemana($_SESSION['TxtFechaA']);}
		$_SESSION['TxtNombre'] = $row['Nombre'];
		
		
	}
	mysql_free_result($rs);mysql_close($conn);
}




?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">   
<html>
<head>
<link rel="STYLESHEET" type="text/css" href="../CSS/Estilo.css" >
<link href="../Codigo/calendar/calendar.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../Codigo/calendar/calendar.js"></script>
<? include ("../Codigo/Head.php");?>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['TxtFechaA'].focus()">
<? include ("../Codigo/BannerConMenuHVCMIT.php");?>

<form name="Formulario" action="zModificar.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"  >
<tr> <td height="5"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="750" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr ><td height="20" align="center" valign="bottom" class="Titulo" >FERIADO</td></tr>
</table> 
<table>  


<!-- Campos y botones -->
<tr><td  align="center"  valign="top">

<table width="500" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr> <td width="100" height="5"  ></td> <td width="150"></td><td width="250"></td></tr>
<tr><td height="18"  align="right"  >Fecha:</td><td  valign="top" > &nbsp; <input name="TxtFechaA" id="TxtFechaA"  tabindex="5"  type="text" class="TextBox"  style="width:70px;" maxlength="10"  onchange="this.value=validarFecha(this.value);" value="<? echo $_SESSION[TxtFechaA]; ?>"   ><label class="MuestraCampoRequerido"> * </label>
<?php
$myCalendar = new tc_calendar("TxtFechaA", true, false);
$myCalendar->setIcon("../Codigo/calendar/images/calendario.png");
$myCalendar->setDate(date(d), date(m), date(Y)); $myCalendar->setPath("./");
$myCalendar->setYearInterval(1990, 2030);
$myCalendar->dateAllow('1990-01-01', '2030-01-01');$myCalendar->setDateFormat('j F Y'); $myCalendar->writeScript();
?></td><td  valign="top" ><input name="TxtDia" type="text"  class="TextBox2" style="width:150px;"  readonly="true" value="<? echo $_SESSION[TxtDia]; ?>"></td></tr>
<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >Nombre:</td><td  valign="top"  colspan="2"> &nbsp; <input name="TxtNombre" type="text" class="TextBox" style="width:320px" maxlength="30"  value="<? echo $_SESSION[TxtNombre]; ?>" onKeyUp="this.value=this.value.toUpperCase()"> <label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
<tr> <td height="19" colspan="3" align="center" valign="middle" > <input name="CmdAceptar" type="submit" class="boton"  value="Guardar" > &nbsp; <input name="CmdCancelar" type="submit" class="boton"  value="Cerrar"  > <input  name="TxtNumero"  type="hidden"  value="<? echo $_SESSION[TxtNumero]; ?>"></td></tr>
<tr> <td height="3"></td></tr>
</table>

<!--  Mensaje error-->
<table width="705" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table>                 
</td>
</tr>	           



<tr><td  align="center"  valign="top">	
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="5"></td></tr></table>


  

                 
</td></tr>	           
</table>    
</td> </tr>
</table>
<?
//limpia las var de session
$_SESSION['TxtFechaA'] = "";
$_SESSION['TxtNumero'] = "";
$_SESSION['TxtNombre'] = "";
$_SESSION['TxtDia'] = "";
?>			
</Form>	
			
<? include ("../Codigo/FooterConUsuario.php");?>
</body>
</html>
