<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}
//$_GET trae id cli
GLO_ValidaGETTUR($_GET['id'],0,0,'InicioCMIT');//valida que no sea vacio



if ($_GET['Flag1']=="True"){
	$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
	$id=intval(decrypt($_GET['id'],'elcrucedelosandes2016'));
	$query="SELECT * From usuariosclientes where Id<>0 and Id=$id"; $rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
	if(mysql_num_rows($rs)!=0){
		$_SESSION['TxtNumero'] = $row['Id'];
		$_SESSION['TxtRSF']=$row['RSF'];
		$_SESSION['TxtCUITF']=$row['CUITF'];
		$_SESSION['TxtDomiF']=$row['DomiF'];
		$_SESSION['TxtPciaF']=$row['PciaF'];
		$_SESSION['TxtNFF']=$row['NFF'];
		//$_SESSION['TxtRSPF']=$row['RSPF'];
		$_SESSION['TxtUsuario'] = $row['IdUsuario'];
	}mysql_free_result($rs);
	mysql_close($conn); 
}


GLO_InitHTML($_SESSION["NivelArbol"],'TxtRSF','BannerConMenuHVCMIT','zModificarRS',0,0,0,0); 
GLO_tituloypath(0,600,'','MODIFICAR EMPRESA','salir');
?> 


<table width="600" border="0"   cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="480"></td> </tr>
<tr><td height="18"  align="right"  >Usuario:</td><td  valign="top" > &nbsp; <input name="TxtUsuario" type="text"  readonly="true"  class="TextBoxRO" style="width:400px"  value="<? echo $_SESSION['TxtUsuario']; ?>"  onKeyDown="enterxtab(event)"></td></tr>
</table>  
      
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	       

<table width="600" border="0"   cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="480"></td> </tr>
<tr><td height="18"  align="right"  >Raz&oacute;n Social:</td><td  valign="top" > &nbsp; <input name="TxtRSF" type="text"  class="TextBox" style="width:400px" maxlength="100"  tabindex="1" value="<? echo $_SESSION['TxtRSF']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr><td height="18"  align="right"  >Nombre de Fantasia:</td><td  valign="top" > &nbsp; <input name="TxtNFF" type="text"  class="TextBox" style="width:400px" maxlength="100"  tabindex="1"  value="<? echo $_SESSION['TxtNFF']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  >CUIT:</td><td  valign="top" > &nbsp; <input name="TxtCUITF" type="text"  class="TextBox" style="width:400px" maxlength="20"  tabindex="1" value="<? echo $_SESSION['TxtCUITF']; ?>"  onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="18"  align="right"  >Domicilio Real:</td><td  valign="top" > &nbsp; <input name="TxtDomiF" type="text"  class="TextBox" style="width:400px" maxlength="100"  tabindex="1" value="<? echo $_SESSION['TxtDomiF']; ?>" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="18"  align="right"  >Ciudad/Provincia:</td><td  valign="top" > &nbsp; <input name="TxtPciaF"  type="text"  class="TextBox"  style="width:400px" maxlength="100" tabindex="1"  value="<? echo $_SESSION['TxtPciaF'];?>"><label class="MuestraCampoRequerido"> * </label></td></tr>
</table>  
      
<? 
GLO_Hidden('TxtNumero',0);
GLO_botonesform(600,0,2);
GLO_mensajeerror();
GLO_cierratablaform();
include ("../Codigo/FooterConUsuario.php");
?>