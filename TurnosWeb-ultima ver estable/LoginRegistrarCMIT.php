<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

GLO_InitHTML($_SESSION["NivelArbol"],'TxtUsuario','BannerConMenuHVCMIT','Clientes/zLoginRegistrar',0,0,0,0);
GLO_tituloypath(0,1120,'Clientes.php','CREAR CUENTA USUARIO','linksalir');
?>


<table width="700" border="0" cellspacing="0" class="Tabla" >

<tr>
    <td width="200" align="right">EMail:</td>
    <td width="500" valign="top">
        <input name="TxtUsuario" type="text" class="TextBox" style="width:340px" maxlength="100" tabindex="1" value="<? echo $_SESSION['TxtUsuario']; ?>"  onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label>
    </td>
</tr>
</table>  
      
<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td height="10"></td>
    </tr>
</table>	       
      
<table width="700" border="0" cellspacing="0" class="Tabla" >
<tr>
    <td width="200" align="right">Nombre:</td>
    <td width="500" valign="top">
        <input name="TxtNombre" type="text"  class="TextBox" style="width:340px" maxlength="30"  tabindex="1" value="<? echo $_SESSION['TxtNombre']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label>
    </td>
</tr>
<tr>
    <td height="18" align="right">Apellido:</td>
    <td valign="top">
        <input name="TxtApellido" type="text" class="TextBox" style="width:340px" maxlength="30" tabindex="1" value="<? echo $_SESSION['TxtApellido']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label>
    </td>
</tr>
<tr>
    <td height="18" align="right">Tel&eacute;fono:</td>
    <td valign="top">
        <input name="TxtTel" type="text" class="TextBox" style="width:340px" maxlength="50" tabindex="1" value="<? echo $_SESSION['TxtTel']; ?>" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label>
    </td>
</tr>
</table>  
 
<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td height="10"></td>
    </tr>
</table>      

<table width="700" border="0" cellspacing="0" class="Tabla" >
<tr>
    <td width="200" align="right">Raz&oacute;n Social:</td>
    <td width="500">
        <input name="TxtRSF" type="text"  class="TextBox" style="width:340px" maxlength="100"  tabindex="1" value="<? echo $_SESSION['TxtRSF']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label>
    </td>
</tr>
<tr>
    <td align="right">Nombre de Fantasia:</td>
    <td>
        <input name="TxtNFF" type="text"  class="TextBox" style="width:340px" maxlength="100" tabindex="1" value="<? echo $_SESSION['TxtNFF']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)">
    </td>
</tr>
<tr>
    <td align="right">CUIT:</td>
    <td>
        <input name="TxtCUITF" type="text"  class="TextBox" style="width:340px" maxlength="20"  tabindex="1" value="<? echo $_SESSION['TxtCUITF']; ?>"  onKeyDown="enterxtab(event)">
    </td>
</tr>
<tr>
    <td align="right"  >Domicilio Real:</td>
    <td>
        <input name="TxtDomiF" type="text"  class="TextBox" style="width:340px" maxlength="100"  tabindex="1" value="<? echo $_SESSION['TxtDomiF']; ?>" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr>
    <td height="18"  align="right">Ciudad/Provincia:</td>
    <td  valign="top" ><input name="TxtPciaF"  type="text"  class="TextBox"  style="width:340px" maxlength="100" tabindex="1"  value="<? echo $_SESSION['TxtPciaF'];?>"><label class="MuestraCampoRequerido"> * </label>
    </td>
</tr>
</table>  

 
<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td height="10"></td>
    </tr>
</table>                    

<table width="700" border="0"   cellspacing="0" class="Tabla" >

<tr>
    <td width="200" align="right"  >Forma de Pago:</td>
    <td width="500">
        <input name="ChkFP"  type="checkbox"  value="1" <? if ($_SESSION['ChkFP'] =='1') echo 'checked'; ?>> Cuenta Corriente
    </td>
</tr>
</table>  

<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td height="10"></td>
    </tr>
</table>       

<table width="700" border="0" cellspacing="0" class="Tabla" >
<tr> <td height="19"  align="center" valign="middle" > <input name="CmdAceptar" type="submit" class="boton"  tabindex="2" value="Aceptar" onClick="return confirm('Por favor aguarde. Grabara los cambios y enviara mail al nuevo usuario');"> </td></tr>
</table>



<?
GLO_mensajeerror();
GLO_cierratablaform();

GLO_initcomment(700,0);
echo '
1. Introduzca la direcci&oacute;n de <font class="comentario3">EMail</font> que utilizar&aacute; para iniciar sesi&oacute;n<br>
2. Complete los datos <font class="comentario2">requeridos</font><br>
3. Ingrese el c&oacute;digo de <font class="comentario3">validaci&oacute;n</font> respetando may&uacute;sculas y min&uacute;sculas<br>
4. Seleccione el bot&oacute;n <font class="comentario2">Aceptar</font><br>
5. Recibir&aacute; en esa direcci&oacute;n de EMail una <font class="comentario3">clave</font> de ingreso al sistema
';
GLO_endcomment();


include ("Codigo/FooterConUsuario.php");
?>