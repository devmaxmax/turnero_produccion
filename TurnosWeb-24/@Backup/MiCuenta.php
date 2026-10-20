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
		//$_SESSION['TxtRSPF']=$row['RSPF'];
	}mysql_free_result($rs);	
}	
	

function MostrarTablaRS($idpadre,$conn){ 
$query="SELECT * From usuariosclientes where Id<>0 and IdUsuario='$idpadre' Order by RSF";$rs=mysql_query($query,$conn);
//Titulos de la tabla
$tablaclientes="";
$tablaclientes .="<table width="."550"." border="."0"." cellspacing="."0"." cellpadding="."0"." ><tr>";
$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
$tablaclientes .="<td "."width="."310"." class="."TablaTituloDato"."> Razón Social</td>";   
$tablaclientes .="<td class="."TablaTituloLeft"."> </td>";  
$tablaclientes .="<td "."width="."110"." class="."TablaTituloDato"."> CUIT</td>";  
$tablaclientes .="<td class="."TablaTituloLeft"."> </td>";  
$tablaclientes .="<td width="."130"." class="."TablaTituloDato"."> </td>"; 
$tablaclientes .="<td class="."TablaTituloRight"."> </td>";  
$tablaclientes .=" </tr> ";             
$recuento=0;  
while($row=mysql_fetch_array($rs)){ 	
	$clickeliminar="'Eliminar ".substr($row['RSF'],0,25)."'";
	$tablaclientes .=" <tr> ";  
	$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
	$tablaclientes .="<td class="."TablaDato"."> ".substr($row['RSF'],0,30)."</td>"; 
	$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
	$tablaclientes .="<td class="."TablaDato"."> ".substr($row['CUIT'],0,20)."</td>"; 
	$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
	$tablaclientes .="<td  class="."TablaDato"." style='text-align:right;'>";
	$tablaclientes .='<input name="CmdVerRS" type="submit"  class="boton2"  value="Ver" id="'.$row['Id'].'" onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';"> <input name="CmdBorrarRS" type="submit"  class="boton2"  value="Borrar" id="'.$row['Id'].'" onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');">';	  
	$tablaclientes .="<td class="."TablaMostrarRight"."> </td>";  
	$tablaclientes .=" </tr> "; 
	$recuento=$recuento+1;
}	
$tablaclientes .="</table>"; 
$tablaclientes .="<p class="."recuento"." align="."right"."> $recuento empresas</p>"; 
echo $tablaclientes;	
mysql_free_result($rs);
}
	
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<? include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css">

</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['TxtNombre'].focus()">
<? include ("Codigo/BannerConMenuHV.php");?>
<form name="Formulario" action="Intranet/zMiCuenta.php" method="post" >
<table width="100%" border="0"  cellpadding="0" cellspacing="0" >
<tr> <td height="5"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="750" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >MI CUENTA</td></tr></table> 

<table width="550" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="430"></td> </tr>
<tr><td height="18"  align="right"  >EMail:</td><td  valign="top" > &nbsp; <input name="TxtUsuario" type="text"  readonly="true"  class="TextBoxRO" style="width:300px"  value="<? echo $_SESSION[TxtUsuario]; ?>"  onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="3"></td></tr>
</table>  
      
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	       

<table width="550" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="430"></td> </tr>
<tr><td height="18"  align="right"  >Nombre:</td><td  valign="top" > &nbsp; <input name="TxtNombre" type="text"  class="TextBox" style="width:300px" maxlength="30"  value="<? echo $_SESSION[TxtNombre]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >Apellido:</td><td  valign="top" > &nbsp; <input name="TxtApellido" type="text"  class="TextBox" style="width:300px" maxlength="30"  value="<? echo $_SESSION[TxtApellido]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
<tr> <td height="18"  align="right"  >Teléfono:</td><td  valign="top" > &nbsp; <input name="TxtTel" type="text"  class="TextBox" style="width:300px" maxlength="50"  value="<? echo $_SESSION[TxtTel]; ?>" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
</table>  
      
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	       

<table width="550" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="430"></td> </tr>
<tr><td height="18"  align="right"  >Razón Social:</td><td  valign="top" > &nbsp; <input name="TxtRSF" type="text"  class="TextBox" style="width:300px" maxlength="100"  value="<? echo $_SESSION[TxtRSF]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >Nombre de Fantasia:</td><td  valign="top" > &nbsp; <input name="TxtNFF" type="text"  class="TextBox" style="width:300px" maxlength="100"  value="<? echo $_SESSION[TxtNFF]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >CUIT:</td><td  valign="top" > &nbsp; <input name="TxtCUITF" type="text"  class="TextBox" style="width:300px" maxlength="20"  value="<? echo $_SESSION[TxtCUITF]; ?>"  onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="3"></td></tr>
<tr> <td height="18"  align="right"  >Domicilio Real:</td><td  valign="top" > &nbsp; <input name="TxtDomiF" type="text"  class="TextBox" style="width:300px" maxlength="100"  value="<? echo $_SESSION[TxtDomiF]; ?>" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
<tr> <td height="18"  align="right"  >Ciudad/Provincia:</td><td  valign="top" > &nbsp; <input name="TxtPciaF"  type="text"  class="TextBox"  style="width:300px" maxlength="100" tabindex="1"  value="<? echo $_SESSION[TxtPciaF];?>"><label class="MuestraCampoRequerido"> * </label></td></tr>
<!--<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >Empresa Planilla:</td><td  valign="top" > &nbsp; <input name="TxtRSPF" type="text"  class="TextBox" style="width:300px" maxlength="100"  value="<? //echo $_SESSION[TxtRSPF]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  ></td><td  valign="top" class="comentario1"> &nbsp; ¿En las planillas debe figurar otra empresa? (Cliente de consultora)</td></tr>
--><tr> <td height="3"></td></tr>
</table>  
      
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	                    

<table width="550" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr> <td height="3"></td></tr>
<tr> <td height="19"  align="center" valign="middle" > <input name="CmdAceptar" type="submit" class="boton"  value="Guardar" > &nbsp; &nbsp; <input name="CmdCancelar" type="submit" class="boton"  value="Cerrar"  ><input  name="TxtId"   type="hidden"   value="<? echo $_SESSION[TxtId]; ?>"></td>
</tr>
<tr> <td height="3"></td></tr>					
</table>


<!--  Mensaje error-->
<table width="450" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
<tr> <td height="10"></td></tr>
</table>


<!--cc-->	  
<table width="550" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr ><td height="18" ><strong>Empresas registradas por el usuario:</strong></td><td align="right">
<input name="CmdAddRS" type="submit" class="boton2" value="Agregar" onClick="document.Formulario.target='_self'">&nbsp;</td></tr>
</table>
<table width="550" border="0"  cellpadding="0" cellspacing="0" class="fondo" >    
<tr> <td height="2" ></td></tr>
<tr> <td  align="center" ><?php MostrarTablaRS($_SESSION[TxtUsuario],$conn); ?>	</td></tr>
<tr> <td height="5"></td></tr>
</table>

                 
</td></tr>    	
</table>


</Form>	
<!-- Comentario-->
<table  width="550" border="0" cellspacing="0" cellpadding="0"  >
<tr><td class="comentario1">
Información del perfil del <font class="comentario3">Usuario</font>.
</td></tr>
</table>
<!-- fin Comentario-->

<? mysql_close($conn);
$_SESSION['TxtUsuario']='';
$_SESSION['TxtNombre']='';
$_SESSION['TxtApellido']='';
$_SESSION['TxtTel']='';
$_SESSION['TxtRSF']="";
$_SESSION['TxtCUITF']="";
$_SESSION['TxtDomiF']="";
$_SESSION['TxtPciaF']="";
$_SESSION['TxtNFF']="";
$_SESSION['TxtRSPF']="";
$_SESSION['TxtId']= "";

?>			

<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>





