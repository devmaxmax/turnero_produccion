<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
require_once('Codigo/calendar/classes/tc_calendar.php');

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);




GLO_InitHTML($_SESSION["NivelArbol"],'TxtExCriterio','BannerConMenuHVCMIT','DiaCMITL',0,0,0,0);
GLO_tituloypath(0,1134,'InicioCMIT.php','TURNOS DIA','linksalir'); 
?>
<form  action="DiaCMITL.php" method="POST">
<table width="700" border="0"   cellspacing="0" class="Tabla" >
	<tr>
		<td width="250" height="18" align="right">Seleccione la fecha:</td>
		<td width="200">
			<input name="fechad" id="fechad" maxlength="10" type="text" class="TextBox" style="width:130px" maxlength="10" required value=""><?php calendario("fechad","Codigo/","actual"); ?>
		</td>
		<td width="250">
			<button name="Consultar" type="submit" value="Consultar" class="boton">Consultar</button>
		</td>
	</tr>

</table>
</form>



<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="40"></td>
	</tr>
</table>

<?


GLO_initcomment(1120,0);
echo 'Enviar&aacute; <font class="comentario3">Mail</font>  de aviso al Cliente si el turno: tiene cliente asignado, no est&aacute; atendido y est&aacute; vigente<br>
Al pi&eacute; de cada d&iacute;a se muestra la cantidad de turnos <font class="comentario2">disponibles</font>';
GLO_endcomment();

include ("Codigo/FooterConUsuario.php");
?>