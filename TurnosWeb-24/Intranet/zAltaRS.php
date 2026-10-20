<? 
include("../Codigo/Seguridad.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";


if (isset($_POST['CmdAceptar'])){ 
	if ( (empty($_POST['TxtRSF']))  or (empty($_POST['TxtDomiF']))  or (empty($_POST['TxtPciaF']))  ){
		foreach($_POST as $key => $value){	$_SESSION[$key] = $value;	}		
		GLO_feedback(3);header("Location:AltaRS.php");
	}else{
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		$usr=mysql_real_escape_string($_SESSION["login"]);
		$rsf=mysql_real_escape_string(ltrim($_POST['TxtRSF']));
		$cuit=mysql_real_escape_string(ltrim($_POST['TxtCUITF']));
		$dom=mysql_real_escape_string(ltrim($_POST['TxtDomiF']));
		$pcia=mysql_real_escape_string(ltrim($_POST['TxtPciaF']));
		$nf=mysql_real_escape_string(ltrim($_POST['TxtNFF']));
		$rsp='';//mysql_real_escape_string($_POST['TxtRSPF']);
	  	//generoid
		$query="SELECT Max(Id) as UltimoId FROM usuariosclientes";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
		if(mysql_num_rows($rs)==0){$nroId=1;}else{$nroId=$row['UltimoId']+1;}mysql_free_result($rs);
		//inserto
		$query="INSERT INTO usuariosclientes (Id,IdUsuario,RSF,CUITF,DomiF,PciaF,NFF,RSPF) VALUES ($nroId,'$usr','$rsf','$cuit','$dom','$pcia','$nf','$rsp')";
		$rs=mysql_query($query,$conn);
		if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 
		mysql_close($conn); 	
		//limpiar datos del form anterior
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}
		header("Location:../MiCuenta.php");
	}
}





?>

