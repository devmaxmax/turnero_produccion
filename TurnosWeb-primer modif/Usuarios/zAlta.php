<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php") ;
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}


if (isset($_POST['CmdAceptar'])){
	$requerido=1;
	if ((empty($_POST['TxtNombre'])) or (empty($_POST['TxtApellido'])) or (intval($_POST['CbPerfil'])==0) or (empty($_POST['TxtUsuario'])) or (empty($_POST['TxtClave'])) or (empty($_POST['TxtConfirmar']))){$requerido=2;GLO_feedback(3);}
	if ($_POST['TxtClave']!=$_POST['TxtConfirmar']){$requerido=2;GLO_feedback(6);}
	if (strlen($_POST['TxtClave'])<8){$requerido=2;GLO_feedback(7);}
	if (!preg_match('`[0-9]`',$_POST['TxtClave'])){$requerido=2;GLO_feedback(8);}
	if ((!preg_match('`[a-z]`',$_POST['TxtClave'])) and (!preg_match('`[A-Z]`',$_POST['TxtClave']))){$requerido=2;GLO_feedback(9);}
	//grabo o vuelvo
	if (($requerido!=1)) { 	
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;	}		
		header("Location:Alta.php");	
	}else{
		//grabar los datos en la tabla
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		$usr=mysql_real_escape_string(ltrim($_POST['TxtUsuario'])); 
		$clave=crypt(trim($_POST['TxtClave']), 'otro@letra8'); 
		$perf=intval($_POST['CbPerfil']); 
		$nom=mysql_real_escape_string(ltrim($_POST['TxtNombre']));
		$ap=mysql_real_escape_string(ltrim($_POST['TxtApellido']));
		$fa=FechaMySql(date("d-m-Y"));
		$query="INSERT INTO usuarios (Usuario,Password,Nombre,Apellido,Tel,FechaA,RSF,CUITF,DomiF,PciaF,NFF,RSPF,IdPerfil,FPago,Bloqueado,Riesgo,SA,DiasSA,FechaSA,FechaBL) VALUES ('$usr','$clave','$nom','$ap','','$fa','','','','','','',$perf,0,0,0,0,0,'0000-00-00','0000-00-00')";$rs=mysql_query($query,$conn);
		if ($rs){GLO_feedback(1);}else{GLO_feedback(2);} 
		mysql_close($conn); 	
		foreach($_POST as $key => $value){$_SESSION[$key] = "";}		
		header("Location:../Usuarios.php");
	}
}
	



?>