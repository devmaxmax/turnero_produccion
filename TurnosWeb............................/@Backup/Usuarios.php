<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php");include("Codigo/Funciones.php");$_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

function MostrarTabla($conn){
$query="Select u.*,p.Nombre as NombrePerfil from usuarios u,perfiles p where u.IdPerfil=p.Id and u.Usuario<>'ngrunmann@gmail.com' and u.IdPerfil<>5 and u.IdPerfil<>1 Order by u.Apellido,u.Nombre"; 
$rs=mysql_query($query,$conn);
//Titulos de la tabla
$tablaclientes="";
$tablaclientes .="<table width="."650"." border="."0"." cellspacing="."0"." cellpadding="."0"." ><tr>";
$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
$tablaclientes .="<td "."width="."260"." class="."TablaTituloDato"."> Nombre</td>";   
$tablaclientes .="<td class="."TablaTituloLeft"."> </td>";   
$tablaclientes .="<td "."width="."175"." class="."TablaTituloDato"."> Usuario </td>";   
$tablaclientes .="<td class="."TablaTituloLeft"."> </td>";  
$tablaclientes .="<td "."width="."165"." class="."TablaTituloDato"."> Perfil</td>";  
$tablaclientes .="<td class="."TablaTituloLeft"."> </td>";  
$tablaclientes .="<td width="."40"." class="."TablaTituloDato"."> </td>"; 
$tablaclientes .="<td class="."TablaTituloRight"."> </td>";  
$tablaclientes .=" </tr> ";             
$recuento=0;
$estilo=" style='cursor:pointer;' title="."Modificar"; 
while($row=mysql_fetch_array($rs)){	
	$link=" onclick="."location='Usuarios/Modificar.php?id=".encrypt($row['Usuario'],'elcrucedelosandes2016')."'";
	$clickeliminar="'Eliminar Usuario ".substr($row['Usuario'],0,15)."'";	
	$clickclave="'Cambiar clave Usuario ".substr($row['Usuario'],0,15)."'";	
	$tablaclientes .=" <tr".$estilo."> "; 
	$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
	$tablaclientes .="<td class="."TablaDato".$link."> ".substr($row['Apellido']." ".$row['Nombre'],0,30)."</td>"; 
	$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
	$tablaclientes .="<td class="."TablaDato".$link."> ".substr($row['Usuario'],0,25)."</td>"; 
	$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
	$tablaclientes .="<td class="."TablaDato".$link."> ".substr($row['NombrePerfil'],0,20)."</td>"; 
	$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
	$tablaclientes .="<td class="."TablaDato"." style='text-align:center;'>";
	$tablaclientes .='<input name="CmdBorrar" type="submit" class="botonborrar"   value="" title="Borrar" id="'.$row['Usuario'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');"> ';
	$tablaclientes .='<input name="CmdClave" type="submit" class="botonclave"   value="" title="Clave" id="'.$row['Usuario'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickclave.');">';
	$tablaclientes .="</td><td class="."TablaMostrarRight"."> </td>";  
	$tablaclientes .=" </tr> "; 
	$recuento=$recuento+1;
}	
//Cerrar tabla
$tablaclientes .="</table>"; 
$tablaclientes .="<p class="."recuento"." align="."right"."> $recuento registros</p>";
echo $tablaclientes;	
//Cierra consulta
mysql_free_result($rs);
}


?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<? include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include ("Codigo/BannerConMenuHVCMIT.php");?>

<form  name="Formulario" action="Usuarios/zUsuarios.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"  >
<tr> <td height="8"></td></tr>
<tr > <td align="right" valign="top" > </td></tr>						
<tr><td>
<table width="750" border="0"  cellpadding="0" cellspacing="0"  align="center" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >USUARIOS</td></tr>
</table>
<!--Boton agregar y tabla-->
<table  width="650" border="0" cellspacing="0" cellpadding="0"  align="center">
<tr  valign="bottom"><td align="right" valign="bottom" ><input  name="TxtId"  type="hidden"  value="<? echo $_SESSION[TxtId]; ?>"><input name="CmdAgregar" type="submit" class="boton"  title="Agregar" value="Agregar">&nbsp;<input name="CmdSalir"  type="submit" class="botonsalirG"  title="Salir" value="" onClick="document.Formulario.target='_self'">&nbsp;
</td>	</tr>
<tr><td  height=3 ></td></tr>					
<tr valign="top"> 	<td  align="center" valign="top" > 	<?php MostrarTabla($conn); ?>	</td>	</tr>
<tr> <td  height="3" ></td></tr>
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table>
</td>
</tr>
</table>
<? mysql_close($conn); 
$_SESSION[TxtId]=""; 

?>
</Form>		


<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>
