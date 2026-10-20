<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php");include("Codigo/Funciones.php");$_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
$_SESSION['TxtTexto']=GLO_TURCondicionesMail($conn);//condiciones


GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHVCMIT','IntranetCMIT/zPoliticas',0,0,0,0); 
GLO_tituloypath(0,1120,'InicioCMIT.php','CONDICIONES TURNO PIE DE PAGINA','linksalir');
?> 

<table width="1120" border="0" cellspacing="0" class="Tabla" >
<tr>
	<td width="150" height="5"></td>
	<td width="970"></td>
</tr>
<tr>
	<td height="18" align="right"  valign="top">T&iacute;tulo:</td>
	<td valign="top">
		<textarea name="TxtTexto" style="width:900px" rows="20" class="TextBox" ><? echo $_SESSION['TxtTexto']; ?></textarea>
	</td>
</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="5"></td>
	</tr>
</table>	

<? 
GLO_botonesform(1120,0,2);
GLO_mensajeerror();
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(1120,0);
echo 'Las <font class="comentario3">Condiciones</font> se mostrar&aacute;n en la p&aacute;gina de solicitud de <font class="comentario2">Turnos</font>';
GLO_endcomment();
include ("Codigo/FooterConUsuario.php");
?>