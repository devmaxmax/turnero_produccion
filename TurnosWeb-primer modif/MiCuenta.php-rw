<? include("Codigo/Seguridad.php") ;   $_SESSION["NivelArbol"]="";include("Codigo/Config.php");include("Codigo/Funciones.php");

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

if ($_GET['Flag1']!="False"){	
	$query="SELECT * From usuarios where Usuario='".mysql_real_escape_string($_SESSION["login"])."'";
	$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
	if(mysql_num_rows($rs)!=0){
		$_SESSION['TxtUsuario'] = $row['Usuario'];
		$_SESSION['TxtNombre']=$row['Nombre'];
		$_SESSION['TxtApellido']= $row['Apellido'];
		$_SESSION['TxtTel'] = $row['Tel'];
		$_SESSION['TxtRSF']=$row['RSF'];
		$_SESSION['TxtCUITF']=$row['CUITF'];
		$_SESSION['TxtDomiF']=$row['DomiF'];
		$_SESSION['TxtPciaF']=$row['PciaF'];
		$_SESSION['TxtNFF']=$row['NFF'];
	}mysql_free_result($rs);	
}	
	

function MostrarTablaRS($idpadre,$conn){ 
$query="SELECT * From usuariosclientes where Id<>0 and IdUsuario='$idpadre' Order by RSF";$rs=mysql_query($query,$conn);
//Titulos de la tabla
$tablaclientes="";
$tablaclientes .=GLO_inittabla(600,1,0,0);
$tablaclientes .="<td "."width="."360"." class="."TableShowT"."> Raz&oacute;n Social</td>";   
$tablaclientes .="<td "."width="."110"." class="."TableShowT"."> CUIT</td>";  
$tablaclientes .="<td width="."130"." class="."TableShowT"."> </td>"; 
$tablaclientes .=" </tr> ";             
$recuento=0;  
while($row=mysql_fetch_array($rs)){ 	
	$clickeliminar="'Eliminar ".substr($row['RSF'],0,25)."'";
	$tablaclientes .=" <tr> ";  
	$tablaclientes .="<td class="."TableShowD"."> ".substr($row['RSF'],0,35)."</td>"; 
	$tablaclientes .="<td class="."TableShowD"."> ".substr($row['CUITF'],0,20)."</td>"; 
	$tablaclientes .="<td  class="."TableShowD"." style='text-align:right;'>";
	$tablaclientes .='<input name="CmdVerRS" type="submit"  class="boton02" style="width:60px;" value="Ver" id="'.$row['Id'].'" onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';"> <input name="CmdBorrarRS" type="submit"  class="boton02" style="width:60px;"  value="Borrar" id="'.$row['Id'].'" onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');">';	  
	$tablaclientes .="</td>";  
	$tablaclientes .=" </tr> "; 
	$recuento=$recuento+1;
}mysql_free_result($rs);	
$tablaclientes .=GLO_fintabla(0,0,$recuento);
echo $tablaclientes;	
}
	
	
GLO_InitHTML($_SESSION["NivelArbol"],'TxtTel','BannerConMenuHV','Intranet/zMiCuenta',0,0,0,0); 
GLO_tituloypath(0,640,'Inicio.php','MI CUENTA','linksalir');
?>



<table width="640" border="0"  cellspacing="0" class="Tabla">
	<tr>
		<td width="120" height="5"></td>
		<td width="360"></td>
		<td width="160"></td>
	</tr>
	<tr>
		<td height="18" align="right">EMail:</td>
		<td valign="middle">&nbsp;<input name="TxtUsuario" type="text"  readonly="true"  class="TextBoxRO" style="width:340px"  value="<? echo $_SESSION['TxtUsuario']; ?>"  onKeyDown="enterxtab(event)"><input  name="TxtId"   type="hidden"   value="<? echo $_SESSION['TxtId']; ?>"></td>
		<td align="center"><input name="CmdClave" type="button" class="botonlog" style="width:110px;" value="Cambio Clave" onClick="window.location.href='CambioClave.php';">&nbsp;</td>
	</tr>
</table>  
      
<table width="640" border="0"  cellspacing="0" class="Tabla TMT" >
	<tr>
		<td width="120" height="5"></td>
		<td width="520"></td>
	</tr>
	<tr><td height="18"  align="right"  >Nombre:</td><td  valign="top" >&nbsp;<input name="TxtNombre" type="text"  readonly="true"  class="TextBoxRO"  style="width:400px"  value="<? echo $_SESSION['TxtNombre']; ?>" onKeyDown="enterxtab(event)"></td></tr>
	<tr>
		<td height="18" align="right">Apellido:</td>
		<td  valign="top" >&nbsp;<input name="TxtApellido" type="text" readonly="true"  class="TextBoxRO" style="width:400px"  value="<? echo $_SESSION['TxtApellido']; ?>"  onKeyDown="enterxtab(event)"></td>
	</tr>
	<tr>
		<td height="18" align="right">Tel&eacute;fono:</td>
		<td valign="top" >&nbsp;<input name="TxtTel" type="text" class="TextBox" style="width:400px" maxlength="50"   tabindex="1" value="<? echo $_SESSION['TxtTel']; ?>" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td>
	</tr>
</table>  
      

<table width="640" border="0"  cellspacing="0" class="Tabla TMT" >
	<tr>
		<td width="120" height="5"></td>
		<td width="520"></td>
	</tr>
	<tr>
		<td height="18" align="right"  >Raz&oacute;n Social:</td>
		<td valign="top" >&nbsp;<input name="TxtRSF" type="text" readonly="true" class="TextBoxRO" style="width:400px"  value="<? echo $_SESSION['TxtRSF']; ?>"  onKeyDown="enterxtab(event)"></td>
	</tr>
	<tr>
		<td height="18"  align="right"  >Nombre de Fantasia:</td>
		<td valign="top">&nbsp;<input name="TxtNFF" type="text" class="TextBox" style="width:400px" maxlength="100" tabindex="1" value="<? echo $_SESSION['TxtNFF']; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td>
	</tr>
	<tr>
		<td height="18" align="right">CUIT:</td>
		<td valign="top">&nbsp;<input name="TxtCUITF" type="text"  class="TextBox" style="width:400px" maxlength="20" tabindex="1" value="<? echo $_SESSION['TxtCUITF']; ?>" onKeyDown="enterxtab(event)"></td>
	</tr>
	<tr>
		<td height="18"  align="right"  >Domicilio Real:</td><td  valign="top" >&nbsp;<input name="TxtDomiF" type="text"  class="TextBox" style="width:400px" maxlength="100"   tabindex="1" value="<? echo $_SESSION['TxtDomiF']; ?>" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td>
	</tr>
	<tr>
		<td height="18" align="right"  >Ciudad/Provincia:</td><td valign="top">&nbsp;<input name="TxtPciaF"  type="text"  class="TextBox"  style="width:400px" maxlength="100" tabindex="1"  value="<? echo $_SESSION['TxtPciaF'];?>"><label class="MuestraCampoRequerido"> * </label></td>
	</tr>
</table>  
      


<? 
GLO_botonesform(640,0,2);
GLO_mensajeerror();
?>


<!--cc-->	  
<table width="640" border="0"  cellpadding="0" cellspacing="0">
<tr> <td height="3" ></td></tr>
<tr ><td height="18"  class="subtituloturnos" valign="bottom">Empresas registradas por el usuario:</td><td align="right"><input name="CmdAddRS" type="submit" class="botonlog" style="width:90px;" value="Agregar" onClick="document.Formulario.target='_self'">&nbsp;</td></tr>
</table>

                 
<? 
MostrarTablaRS($_SESSION['TxtUsuario'],$conn);
GLO_cierratablaform();
mysql_close($conn); 
include ("Codigo/FooterConUsuario.php");
?>