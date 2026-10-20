<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Config.php");include("../Codigo/Funciones.php");$_SESSION["NivelArbol"]="../";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

if (isset($_POST[CmdAceptar])){
	if ((empty($_POST['TxtNombre'])) or(empty($_POST['TxtFechaA']))){
		foreach($_POST as $key => $value){$_SESSION[$key] = $value;	}		
	    header("Location:Alta.php?&msgE=Por favor complete los campos requeridos");
	}else{
		//grabar los datos en la tabla
		$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
		if (empty($_POST['TxtFechaA'])){$fechaa="0000-00-00";}else{$fechaa=FechaMySql($_POST['TxtFechaA']);}	
		$nom=mysql_real_escape_string(ltrim($_POST['TxtNombre'] ));
	  	//generoid
		$query="SELECT Max(Id) as UltimoId FROM feriados";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
		if(mysql_num_rows($rs)==0){$nroId=1;}else{$nroId=$row['UltimoId']+1;}mysql_free_result($rs);
		//inserto
		$query="INSERT INTO feriados (Id,Fecha,Nombre) VALUES ($nroId,'$fechaa','$nom')";$rs=mysql_query($query,$conn);
		if ($rs){$feed="msgC="."Los datos se grabaron correctamente";$grabook=1;}else{$feed="msgE="."No se grabó.";$grabook=0; } 
		mysql_close($conn); 			
		//volver
		if($grabook==1){
			foreach($_POST as $key => $value){$_SESSION[$key] = "";}
			header("Location:../Feriados.php?&".$feed);
		}else{
			foreach($_POST as $key => $value){$_SESSION[$key] = $value;}
			header("Location:Alta.php?".$feed);
		}			
	
	}		
}

elseif (isset($_POST[CmdCancelar])){
foreach($_POST as $key => $value){$_SESSION[$key] = "";}
header("Location:../Feriados.php");
}

?>


