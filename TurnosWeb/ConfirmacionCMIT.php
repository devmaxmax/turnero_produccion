<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php");include("Codigo/Funciones.php");   $_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}
 
GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHVCMIT','',0,0,0,0); 
GLO_tituloypath(0,400,'','',''); 

GLO_mensajeerror();
GLO_cierratablaform();
include ("Codigo/FooterConUsuario.php");
?>