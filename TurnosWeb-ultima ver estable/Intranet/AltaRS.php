<? include("../Codigo/Seguridad.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";


?> 

<? include ("../Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="../CSS/Estilo.css" >
<? GLO_bodyform('TxtRSF',0,0); ?>
<? include ("../Codigo/BannerConMenuHV.php");?>
<? GLO_formform('Formulario','zAltaRS.php',0,0,0); ?>
<? GLO_tituloypath(0,600,'../MiCuenta.php','AGREGAR EMPRESA','linksalir'); ?>




<table width="600" border="0"  cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="480"></td> </tr>
<tr><td height="18"  align="right"  >Raz&oacute;n Social:</td><td  valign="top" > &nbsp; <input name="TxtRSF" type="text"  class="TextBox" style="width:400px" maxlength="100"  tabindex="1" value="<? echo $_SESSION['TxtRSF']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label><input  name="TxtNumero" type="hidden" value="<? echo $_SESSION['TxtNumero']; ?>"></td></tr>
<tr><td height="18"  align="right"  >Nombre de Fantasia:</td><td  valign="top" > &nbsp; <input name="TxtNFF" type="text"  class="TextBox" style="width:400px" maxlength="100"  tabindex="1"  value="<? echo $_SESSION['TxtNFF']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >CUIT:</td><td  valign="top" > &nbsp; <input name="TxtCUITF" type="text"  class="TextBox" style="width:400px" maxlength="20"  tabindex="1" value="<? echo $_SESSION['TxtCUITF']; ?>"  onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="18"  align="right"  >Domicilio Real:</td><td  valign="top" > &nbsp; <input name="TxtDomiF" type="text"  class="TextBox" style="width:400px" maxlength="100"  tabindex="1" value="<? echo $_SESSION['TxtDomiF']; ?>" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="18"  align="right"  >Ciudad/Provincia:</td><td  valign="top" > &nbsp; <input name="TxtPciaF"  type="text"  class="TextBox"  style="width:400px" maxlength="100" tabindex="1"  value="<? echo $_SESSION['TxtPciaF'];?>"><label class="MuestraCampoRequerido"> * </label></td></tr>
</table>  
      

<? 
GLO_botonesform("600",0,2);
GLO_mensajeerror();
GLO_cierratablaform();
?>


<? include ("../Codigo/FooterConUsuario.php");?>