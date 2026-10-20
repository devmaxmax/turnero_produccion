<? 
//paciente
$obs=mysql_real_escape_string($_POST['TxtObs']);//obs generales
$pac=mysql_real_escape_string($_POST['TxtPaciente']);
$dnip=mysql_real_escape_string($_POST['TxtDNIP']);


//examenes
$e1=intval($_POST['ChkE1']);
$e2=intval($_POST['ChkE2']);
$e3=intval($_POST['ChkE3']);
$e4=intval($_POST['ChkE4']);
$e5=intval($_POST['ChkE5']);



?>

