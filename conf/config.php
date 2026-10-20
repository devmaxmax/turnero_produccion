<?php
if (!defined('IN_SITE'))
{
	die('Hacking attempt');
}

@ini_set("session.use_only_cookies","1");
@ini_set("session.use_trans_sid","0");
session_start();


$db_username = 'lgrunman_43432';
$db_password = 'dell6253smauyt';
$db_name = 'lgrunman_rwred';
$db_host = 'localhost';


/*
$db_username = 'usuario';
$db_password = 'password';
$db_name = 'db_dame';
$db_host = 'localhost';
*/

$LID = @mysql_connect($db_host, $db_username, $db_password);

if (!$LID)
	{
	  die('Error: '.@mysql_error());
	}
else
	{
	   @mysql_select_db($db_name);
	}


?>
