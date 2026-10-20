<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php");include("Codigo/Funciones.php");$_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

//busca datos
$query="SELECT * From banners WHERE id = 3";
$rs=mysql_query($query,$conn);
$row=mysql_fetch_array($rs);
if(mysql_num_rows($rs)!=0){
	$_SESSION['TxtTitulo'] = $row['Titulo'];
	$_SESSION['TxtSTitulo'] = $row['Subtitulo'];
	$_SESSION['TxtTexto'] = $row['Texto'];
	$_SESSION['Activado'] = $row['Activado'];
}mysql_free_result($rs);


GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHVCMIT','IntranetCMIT/zBanner03',0,0,0,0); 
GLO_tituloypath(0,750,'InicioCMIT.php','BANNER','linksalir');
?> 


<table width="750" border="0" cellspacing="0" class="Tabla">
	<tr>
		<td width="70" height="5"></td>
		<td width="680"></td>
	</tr>
	<tr>
		<td height="18" align="right">&nbsp;T&iacute;tulo:</td>
		<td valign="top">&nbsp;<input name="TxtTitulo" type="text" class="TextBox" style="width:450px" maxlength="40" value="<? echo $_SESSION['TxtTitulo']; ?>" disabled></td>
	</tr>
	<tr>
		<td height="18" align="right">&nbsp;Subt&iacute;tulo:</td>
		<td valign="top">&nbsp;<input name="TxtSTitulo" maxlength="40" type="text" class="TextBox" value="<? echo $_SESSION['TxtSTitulo']; ?>" style="width:450px"></td>
	</tr>
	<tr>
		<td height="18" align="right" valign="top">&nbsp;Texto:</td>
		<td valign="top">&nbsp;<textarea name="TxtTexto" style="width:630px" rows="10" class="TextBox" ><? echo $_SESSION['TxtTexto']; ?></textarea></td>
	</tr>
	<tr>
		<td height="18" align="right" valign="top">&nbsp;Activado:</td>
		<td valign="top">&nbsp;<select name='Activado' id="Activado" style="width:630px">

                  <option value='SI' <?php if( $_SESSION['Activado'] == 'SI' ) : ?>selected <?php endif ?> >SI</option>
                  <option value='NO' <?php if( $_SESSION['Activado'] == 'NO' ) : ?>selected <?php endif ?> >NO</option>

                </select>
        </td>
	</tr>
</table>

<? 
GLO_botonesform(750,0,2);
GLO_mensajeerror();
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(750,0);
echo 'El <font class="comentario3">Banner</font> se mostrar&aacute; en la p&aacute;gina <font class="comentario2">Modificar Turno</font> (Clientes)';
GLO_endcomment();
include ("Codigo/FooterConUsuario.php");
?>