<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";require_once('../Codigo/calendar/classes/tc_calendar.php');
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

GLO_InitHTML($_SESSION["NivelArbol"],'TxtFechaA','BannerConMenuHVCMIT','zAlta',0,0,0,0); 
GLO_tituloypath(0,500,'../Feriados.php','FERIADO','linksalir');
?> 

<table width="500" border="0"  cellspacing="0" class="Tabla" >
<tr> <td width="100" height="5"  ></td> <td width="150"></td><td width="250"></td></tr>
<tr><td height="18"  align="right"  >Fecha:</td><td  valign="top" >&nbsp;<?php  GLO_calendario("TxtFechaA","../Codigo/","actual",1); ?></td><td  valign="top" ></td></tr>
<tr><td height="18"  align="right"  >Dia:</td><td  valign="top"  colspan="2">&nbsp;<input name="TxtDia" type="text"  class="TextBox2" style="width:100px;"  readonly="true" value="<? echo $_SESSION['TxtDia']; ?>"></td></tr>
<tr><td height="18"  align="right"  >Nombre:</td><td  valign="top"  colspan="2">&nbsp;<input name="TxtNombre" type="text" class="TextBox" style="width:320px" maxlength="30"  value="<? echo $_SESSION['TxtNombre']; ?>" onKeyUp="this.value=this.value.toUpperCase()"> <label class="MuestraCampoRequerido"> * </label></td></tr>
</table>

<?
GLO_Hidden('TxtNumero',0);
GLO_botonesform(500,0,2);
GLO_mensajeerror();
GLO_cierratablaform();
include ("../Codigo/FooterConUsuario.php");
?>