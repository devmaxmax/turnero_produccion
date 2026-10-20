<?PHP
session_start();
if (!defined('IN_SITE'))
{
	die('Hacking attempt');
}
if ($_SESSION['usuariop'] == 0 OR$_SESSION['usuariop'] == 2 ) {
	

}else{
	  @header('Location: login.php');
  die('Usuario no autorizado...!!');
                
}


?>