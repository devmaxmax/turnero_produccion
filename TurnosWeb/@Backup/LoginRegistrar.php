<? include("Codigo/Config.php");

if(!isset($_SESSION)) { session_start(); } 
//genero captcha
$cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";$longitudCadena=strlen($cadena);$pass="";$longitudPass=4;
for($i=1 ; $i<=$longitudPass ; $i++){$pos=rand(0,$longitudCadena-1);$pass .= substr($cadena,$pos,1);}		
$_SESSION['TxtValida1']=$pass;
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
<? include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['TxtUsuario'].focus()">
<? include ("Codigo/BannerSinMenuHV.php");?>

<!--form--> 
<form name="Formulario" action="Intranet/zLoginRegistrar.php" method="post" >
<table width="100%" border="0"  cellpadding="0" cellspacing="0" >
<tr> <td height="5"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="750" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >CREAR UNA CUENTA DE USUARIO</td></tr></table> 


<table width="550" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="430"></td> </tr>
<tr><td height="18"  align="right"  >EMail:</td><td  valign="top" > &nbsp; <input name="TxtUsuario" type="text"  class="TextBox" style="width:300px" maxlength="100"  tabindex="1" value="<? echo $_SESSION[TxtUsuario]; ?>"  onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
</table>  
      
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	       
      
<table width="550" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="430"></td> </tr>
<tr><td height="18"  align="right"  >Nombre:</td><td  valign="top" > &nbsp; <input name="TxtNombre" type="text"  class="TextBox" style="width:300px" maxlength="30"  tabindex="1" value="<? echo $_SESSION[TxtNombre]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >Apellido:</td><td  valign="top" > &nbsp; <input name="TxtApellido" type="text"  class="TextBox" style="width:300px" maxlength="30"  tabindex="1" value="<? echo $_SESSION[TxtApellido]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
<tr> <td height="18"  align="right"  >Teléfono:</td><td  valign="top" > &nbsp; <input name="TxtTel" type="text"  class="TextBox" style="width:300px" maxlength="50"  tabindex="1" value="<? echo $_SESSION[TxtTel]; ?>" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
</table>  
 
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	       

<table width="550" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="430"></td> </tr>
<tr><td height="18"  align="right"  >Razón Social:</td><td  valign="top" > &nbsp; <input name="TxtRSF" type="text"  class="TextBox" style="width:300px" maxlength="100"  tabindex="1" value="<? echo $_SESSION[TxtRSF]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >Nombre de Fantasia:</td><td  valign="top" > &nbsp; <input name="TxtNFF" type="text"  class="TextBox" style="width:300px" maxlength="100"  tabindex="1" value="<? echo $_SESSION[TxtNFF]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >CUIT:</td><td  valign="top" > &nbsp; <input name="TxtCUITF" type="text"  class="TextBox" style="width:300px" maxlength="20"  tabindex="1" value="<? echo $_SESSION[TxtCUITF]; ?>"  onKeyDown="enterxtab(event)"></td></tr>
<tr> <td height="3"></td></tr>
<tr> <td height="18"  align="right"  >Domicilio Real:</td><td  valign="top" > &nbsp; <input name="TxtDomiF" type="text"  class="TextBox" style="width:300px" maxlength="100"  tabindex="1" value="<? echo $_SESSION[TxtDomiF]; ?>" onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label></td></tr>
<tr> <td height="3"></td></tr>
<tr> <td height="18"  align="right"  >Ciudad/Provincia:</td><td  valign="top" > &nbsp; <input name="TxtPciaF"  type="text"  class="TextBox"  style="width:300px" maxlength="100" tabindex="1"  value="<? echo $_SESSION[TxtPciaF];?>"><label class="MuestraCampoRequerido"> * </label></td></tr>
<!--<tr> <td height="3"></td></tr>
<tr><td height="18"  align="right"  >Empresa Planilla:</td><td  valign="top" > &nbsp; <input name="TxtRSPF" type="text"  class="TextBox" style="width:300px" maxlength="100"  tabindex="1" value="<? //echo $_SESSION[TxtRSPF]; ?>" onKeyUp="this.value=this.value.toUpperCase()" onKeyDown="enterxtab(event)"></td></tr>
<tr><td height="18"  align="right"  ></td><td  valign="top" class="comentario1"> &nbsp; ¿En las planillas debe figurar otra empresa? (Cliente de consultora)</td></tr>
--><tr> <td height="3"></td></tr>
</table>  

 
      
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	                    

<table width="550" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr><td width="120" height="5"  ></td> <td width="430"></td> </tr>
<tr><td height="18"  align="right"  >Validar:</td><td  valign="top" > &nbsp; <input name="TxtValida1" type="text"   readonly="true"  class="TextBoxRO" style="width:50px; text-align:center; font-size:14px; font-style:italic; font-weight:bold;background:#c9d9de;" value="<? echo $_SESSION[TxtValida1]; ?>"  onKeyDown="enterxtab(event)">  <input name="TxtValida2" type="text"  class="TextBox" style="width:50px" maxlength="4"  tabindex="1" value="<? echo $_SESSION[TxtValida2]; ?>"  onKeyDown="enterxtab(event)"><label class="MuestraCampoRequerido"> * </label> <label class="comentario1"> (Ingrese el código de validación aleatorio) </label></td></tr>
<tr> <td height="3"></td></tr></table>  

     
<table  border="0"  cellpadding="0" cellspacing="0"><tr> <td height="3"></td></tr></table>	       

<table width="550" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr> <td height="3"></td></tr>
<tr> <td height="19"  align="center" valign="middle" > <input name="CmdAceptar" type="submit" class="boton"  tabindex="2" value="Aceptar" onClick="return confirm('Por favor aguarde. Grabará los cambios y enviará mail a CMIT');"> &nbsp; &nbsp; <input name="CmdCancelar" type="submit" class="boton"  value="Cancelar"  > </td></tr>
<tr> <td height="3"></td></tr>					
</table>


<!--  Mensaje error-->
<table width="450" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table>


<!-- Comentario-->
<table  width="450" border="0" cellspacing="0" cellpadding="0"  >
<tr> <td height="15"></td></tr>
<tr><td class="comentario1">
1. Introduzca la dirección de <font class="comentario3">EMail</font> que utilizará para iniciar sesión<br>
2. Complete los datos <font class="comentario2">requeridos</font><br>
3. Ingrese el código de <font class="comentario3">validación</font> respetando mayúsculas y minúsculas<br>
4. Seleccione el botón <font class="comentario2">Aceptar</font> y su pedido será tramitado por <font class="comentario3">CMIT</font><br>
5. Posteriormente recibirá en esa dirección de EMail una <font class="comentario2">clave</font> de ingreso al sistema
</td></tr>
</table>
<!-- fin Comentario-->
                 
</td></tr>    	
</table>

</Form>	
<? 
//limpia las var de session
$_SESSION['TxtUsuario']='';
$_SESSION['TxtNombre']='';
$_SESSION['TxtApellido']='';
$_SESSION['TxtTel']='';
$_SESSION['TxtValida1']='';
$_SESSION['TxtValida2']='';
$_SESSION['TxtRSF']="";
$_SESSION['TxtCUITF']="";
$_SESSION['TxtDomiF']="";
$_SESSION['TxtPciaF']="";
$_SESSION['TxtNFF']="";
$_SESSION['TxtRSPF']="";
?>			

 
<? include ("Codigo/FooterSinUsuario.php");?>
</body>
</html>





