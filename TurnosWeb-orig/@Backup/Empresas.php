<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}




$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);



function MostrarTabla($conn){
$query=$_SESSION[TxtConsultaEmpre];$query=str_replace("\\", "", $query);
if ( ($query!="")){
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//Titulos de la tabla		
		$tablaclientes="";
		$tablaclientes .="<table width="."900"." border="."0"." cellspacing="."0"." cellpadding="."0"." >";
		$tablaclientes .="<tr><td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."340"." class="."TablaTituloDato"."> Razón Social</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."100"." class="."TablaTituloDato"."> CUIT</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."170"." class="."TablaTituloDato"."> Usuario</td>";  
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."300"." class="."TablaTituloDato"."> Nombre</td>"; 
		$tablaclientes .="<td class="."TablaTituloRight"."> </td>";  
		$tablaclientes .=" </tr> ";    
		$recuento=0;          
		while($row=mysql_fetch_array($rs)){
			$clickeliminar="'¿Desea eliminar el usuario'";
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato"."> ".substr($row['RSF'],0,40)."</td>";  			
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
			$tablaclientes .="<td class="."TablaDato"."> ".substr($row['CUITF'],0,15)."</td>";
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato"."> ".substr($row['Usuario'],0,25)."</td>";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato"."> ".substr($row['Apellido'].' '.$row['Nombre'],0,35)."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarRight"."> </td>";  
			$tablaclientes .=" </tr> "; 
			$recuento=$recuento+1;
		}	
		//Cerrar tabla
		$tablaclientes .="</table>"; 
		$tablaclientes .="<p class="."recuento"." align="."right"."> $recuento empresas</p>"; 
		$tablaclientes .='<table align="right" ><tr> <td></td></tr><tr><td><input name="CmdExcel"  type="submit" class="botonexcel"  value="" onClick="document.Formulario.target='."'_self'".'"></td></tr></table>';
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center">No existen datos</p>';}
	//Cierra consulta
	mysql_free_result($rs);
	
}
}







?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<? include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css">
<meta http-equiv="REFRESH" content="300"> 
</head>



<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['CmdBuscar'].focus()">
<? include ("Codigo/BannerConMenuHVCMIT.php");?>


<form  name="Formulario" action="Clientes/zEmpresas.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"   >
<tr> <td height="5"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="920" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >EMPRESAS DE CLIENTES REGISTRADOS</td></tr>
</table>


<table width="690" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr> <td height="5" width="70"></td><td width="100"></td><td width="140"></td><td width="70"></td><td width="190"></td><td width="120"></td></tr>
<tr> <td height="18"  align="right">Empresa:</td><td  colspan="2" >&nbsp;<input name="TxtBusqueda" type="text" class="TextBox" style="width:180px" maxlength="20" onKeyDown="enterxtab(event)"></td><td height="18" align="right"></td><td >&nbsp;</td>
<td   align="right" ><input  name="TxtId"  type="hidden"  value="<? echo $_SESSION[TxtId]; ?>"><input  name="TxtConsultaEmpre"  type="hidden"   value="<? echo $_SESSION[TxtConsultaEmpre]; ?>"><input name="CmdBuscar"  type="submit" class="botonbuscarG"  value="" onClick="document.Formulario.target='_self'">&nbsp;<input name="CmdSalir"  type="submit" class="botonsalirG"   value="" onClick="document.Formulario.target='_self'">&nbsp;
</td></tr>
<tr><td  height=3 ></td></tr>
</table>



<table  width="900" border="0" cellspacing="0" cellpadding="0" >
<tr  valign="bottom"><td align="left" valign="bottom" ></td>	</tr>
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
<tr><td  height=3 ></td></tr>
<tr valign="top"> 	<td  align="center" valign="top" > 	<?php MostrarTabla($conn); ?>	</td>	</tr>
</table>


</td></tr>      
</table>
<? mysql_close($conn);

$_SESSION[TxtId]=""; 
$_SESSION[TxtBusqueda]="";
$_SESSION[TxtConsultaEmpre]="";
?>
</Form>		
<!-- Comentario-->
<table  width="920" border="0" cellspacing="0" cellpadding="0"  >
<tr><td class="comentario1">
Muestra las Empresas asociadas a los Usuarios registrados.<br>
</td></tr>
</table>
<!-- fin Comentario-->

<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>
