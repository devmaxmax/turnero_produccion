<?PHP
session_start();
if (!defined('IN_SITE'))
{
	die('Hacking attempt');
}
if (isset($_SESSION['usuario'])) {
	

}else{
	  @header('Location: login.php');
  die('Usuario no autorizado...!!');
                
}


?>