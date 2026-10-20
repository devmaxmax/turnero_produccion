<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");$_SESSION["NivelArbol"]="../";include("../Codigo/Funciones.php");

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}



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


?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">   
<html>
<head>
<link rel="STYLESHEET" type="text/css" href="../CSS/Estilo.css" >

<? include ("../Codigo/Head.php");?>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['TxtRSF'].focus()">
<? include ("../Codigo/BannerConMenuHVCMIT.php");?>

<form name="Formulario" action="zModificarRS.php" method="post" onKeyPress="if (event.which == 13 || event.keyCode == 13){return false;}">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"  >
<tr> <td height="5"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="750" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >MODIFICAR EMPRESA</td> </tr>
</table> 
<table> 
<!-- Campos y botones -->
<tr><td  align="center"  valign="top">

<table width="520" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="400"></td> </tr>
<tr><td height="18"  align="right"  >Usuario:</td><td  valign="top" > &nbsp; <input name="TxtUsuario" type="text"  readonly="true"  class="TextBoxRO" style="width:300px"  value="<? echo $_SESSION[TxtUsuario]; ?>"  onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="3"></td></tr>
</table>  
      
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	       

<table width="520" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="400"></td> </tr>
<tr><td height="18"  align="right"  >Razón Social:</td><td  valign="top" > &nbsp; <input name="TxtRSF" type="text"  class="TextBox" style="width:300px" maxlength="100"  tabindex="1" value="<? echo $_SESSION[TxtRSF]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >Nombre de Fantasia:</td><td  valign="top" > &nbsp; <input name="TxtNFF" type="text"  class="TextBox" style="width:300px" maxlength="100"  tabindex="1"  value="<? echo $_SESSION[TxtNFF]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >CUIT:</td><td  valign="top" > &nbsp; <input name="TxtCUITF" type="text"  class="TextBox" style="width:300px" maxlength="20"  tabindex="1" value="<? echo $_SESSION[TxtCUITF]; ?>"  onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="3"></td></tr>
<tr> <td height="18"  align="right"  >Domicilio Real:</td><td  valign="top" > &nbsp; <input name="TxtDomiF" type="text"  class="TextBox" style="width:300px" maxlength="100"  tabindex="1" value="<? echo $_SESSION[TxtDomiF]; ?>" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
<tr> <td height="18"  align="right"  >Ciudad/Provincia:</td><td  valign="top" > &nbsp; <input name="TxtPciaF"  type="text"  class="TextBox"  style="width:300px" maxlength="100" tabindex="1"  value="<? echo $_SESSION[TxtPciaF];?>"><label class="MuestraCampoRequerido"> * </label></td></tr>
<!--<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >Empresa Planilla:</td><td  valign="top" > &nbsp; <input name="TxtRSPF" type="text"  class="TextBox" style="width:300px" maxlength="100"  tabindex="1"  value="<? //echo $_SESSION[TxtRSPF]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  ></td><td  valign="top" class="comentario1"> &nbsp; ¿En las planillas debe figurar otra empresa? (Cliente de consultora)</td></tr>
--><tr> <td height="3"></td></tr>
</table>  
      
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	                    

<table width="520" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr> <td height="3"></td></tr>
<tr> <td height="19"  align="center" valign="middle" > <input name="CmdAceptar" type="submit" class="boton"  tabindex="2" value="Guardar" > &nbsp; <input name="CmdCancelar" type="submit" class="boton"  value="Cerrar"  ><input  name="TxtNumero" type="hidden" value="<? echo $_SESSION[TxtNumero]; ?>"></td>
</tr>
<tr> <td height="3"></td></tr>					
</table>

<!--  Mensaje error-->
<table width="705" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
<tr> <td height="100"></td></tr>	
</table>                 

           
</td></tr>

<? //limpia las var de session
$_SESSION['TxtNumero'] ="";
$_SESSION['TxtRSF']="";
$_SESSION['TxtCUITF']="";
$_SESSION['TxtDomiF']="";
$_SESSION['TxtPciaF']="";
$_SESSION['TxtNFF']="";
$_SESSION['TxtRSPF']="";
$_SESSION['TxtUsuario']="";
?>			

</table>    
</td>
</tr>
</table>
</Form>				

<? include ("../Codigo/FooterConUsuario.php");?>
</body>
</html>
