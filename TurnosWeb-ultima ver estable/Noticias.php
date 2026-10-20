<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php");include("Codigo/Funciones.php");$_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

//busca datos
$query="SELECT * From noticias";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
if(mysql_num_rows($rs)!=0){
	$_SESSION['TxtTitulo'] = $row['Titulo'];
	$_SESSION['TxtSTitulo'] = $row['Subtitulo'];
	$_SESSION['TxtTexto'] = $row['Texto'];
}mysql_free_result($rs);


GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHVCMIT','IntranetCMIT/zNoticias',0,0,0,0); 
GLO_tituloypath(0,1120,'InicioCMIT.php','BIENVENIDA','linksalir');
?> 


<table width="1120" border="0" cellspacing="0" class="Tabla" >
<tr>
	<td width="150" height="5"></td>
	<td width="970"></td>
</tr>
<tr>
	<td height="18" align="right">T&iacute;tulo:</td>
	<td valign="top">
		<input name="TxtTitulo" type="text" class="TextBox" style="width:900px" maxlength="40"  value="<? echo $_SESSION['TxtTitulo']; ?>">
	</td>
</tr>
<tr>
	<td height="18"  align="right"  >
	Subt&iacute;tulo:</td>
	<td valign="top" >
		<input name="TxtSTitulo" maxlength="40" type="text" class="TextBox" value="<? echo $_SESSION['TxtSTitulo']; ?>" style="width:900px" >
	</td>
</tr>
<tr>
	<td height="18" align="right" valign="top" >Texto:</td>
	<td valign="top">
		<textarea name="TxtTexto" style="width:900px" rows="22" class="TextBox" ><? echo $_SESSION['TxtTexto']; ?></textarea>
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
echo 'La <font class="comentario3">Bienvenida</font> se mostrar&aacute; en la p&aacute;gina inicial del sistema de <font class="comentario2">Turnos</font> (Clientes y CMIT)';
GLO_endcomment();
include ("Codigo/FooterConUsuario.php");
?>