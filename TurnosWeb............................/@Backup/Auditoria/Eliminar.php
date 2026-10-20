<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Funciones.php");include("../Codigo/Config.php");    $_SESSION["NivelArbol"]="../";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);


function MostrarTabla($conn){
//trae los meses que registran turnos
$hoy=date("d-m-Y"); list($d,$m,$a)=explode("-",$hoy);$primerdiames="01-".$m."-".$a;
$fecha=date("d-m-Y", strtotime("$primerdiames -1 month"));
$query="Select count(Id) as Cant, month(Fecha) as Mes,year(Fecha) as Año From auditoria Where DATEDIFF(Fecha,'".FechaMySql($fecha)."')<=0 Group by year(Fecha),month(Fecha) Order by year(Fecha),month(Fecha)";


if ( ($query!="")){
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//Titulos de la tabla		
		$tablaclientes="";
		$tablaclientes .="<table width="."360"." border="."0"." cellspacing="."0"." cellpadding="."0"." >";
		$tablaclientes .="<tr><td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."60"." class="."TablaTituloDato"."> Año</td>";  
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."100"." class="."TablaTituloDato"."> Mes</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."60"." class="."TablaTituloDato"." style='text-align:right;'> Cantidad</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."140"." class="."TablaTituloDato"."></td>"; 
		$tablaclientes .="<td class="."TablaTituloRight"."> </td>";  
		$tablaclientes .=" </tr> "; 		       
		while($row=mysql_fetch_array($rs)){
			$mes=G_NombreMes($row['Mes']);
			$clickeliminar="'¿Desea eliminar el mes ".$mes.' '.$row['Año']."?'";
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato"."> ".$row['Año']."</td>";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato"."> ".$mes."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato"." style='text-align:right;'>".$row['Cant']."</td>";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  			
			$tablaclientes .="<td class="."TablaDato"." style='text-align:right;'>"; 
			$tablaclientes .='<input name="CmdExcel" type="submit" class="boton2"   value="Exportar" id="'.$row['Año'].'|'.$row['Mes'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"> <input name="CmdBorrar" type="submit" class="boton2"   value="Borrar" id="'.$row['Año'].'|'.$row['Mes'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');">';
			$tablaclientes .="</td><td class="."TablaMostrarRight"."> </td>";  
			$tablaclientes .=" </tr> "; 
		}	
		//Cerrar tabla
		$tablaclientes .="</table>"; 
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
<? include ("../Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="../CSS/Estilo.css">
</head>



<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['CmdBuscar'].focus()">
<? include ("../Codigo/BannerConMenuHVCMIT.php");?>


<form  name="Formulario" action="zEliminar.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"   >
<tr> <td height="5"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="750" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >ELIMINAR AUDITORIAS ANTIGUAS</td></tr>
</table>
<table width="360" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr> <td height="2" width="300"></td><td width="500"></td></tr>
<tr> <td height="16"  align="right"><input  name="TxtId"  type="hidden"  value="<? echo $_SESSION[TxtId]; ?>"></td>
  <td   align="right" ><input name="CmdSalir"  type="submit" class="boton1"   value="Volver" onClick="document.Formulario.target='_self'">&nbsp;
</td></tr>
<tr> <td height="2"></td></tr>
</table>


<table  width="360" border="0" cellspacing="0" cellpadding="0" >
<tr  valign="bottom"><td align="left" valign="bottom" ></td>	</tr>
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
</table>

<table  width="360" border="0" cellspacing="0" cellpadding="0" >
<tr><td  height=3 ></td></tr>
<tr valign="top"> 	<td  align="center" valign="top" > 	<?php MostrarTabla($conn); ?>	</td>	</tr>
</table>

</td></tr>      
</table>
<? mysql_close($conn);

$_SESSION[TxtId]=""; 

?>
</Form>		
<!-- Comentario-->
<table  width="750" border="0" cellspacing="0" cellpadding="0"  >
<tr><td class="comentario1">
Si lo desea puede Exportar los registros antes de borralos.
</td></tr>
</table>
<!-- fin Comentario-->


<? include ("../Codigo/FooterConUsuario.php");?>
</body>
</html>
