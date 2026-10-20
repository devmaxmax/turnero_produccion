<? include("Codigo/Seguridad.php") ;include("Codigo/Config.php"); include("Codigo/Funciones.php");  $_SESSION["NivelArbol"]=""; 


GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHV','',0,0,0,0); 
GLO_tituloypath(0,400,'','',''); 

GLO_mensajeerror();
GLO_cierratablaform();
include ("Codigo/FooterConUsuario.php");
?>