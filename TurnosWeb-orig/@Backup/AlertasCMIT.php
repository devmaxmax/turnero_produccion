<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";


//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}




$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);



function MostrarTabla1($conn){
	//ultimos 7 dias
	$hoy=date("d-m-Y");$fecha=date("d-m-Y", strtotime("$hoy -7 day"));
	$wfechad="and DATEDIFF(u.FechaA,'".FechaMySql($fecha)."')>=0";
	//query
	$query="Select u.* From usuarios u Where u.Usuario<>'ngrunmann@gmail.com' and u.IdPerfil=5 $wfechad  Order by u.FechaA desc";
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		$tablaclientes="";
		$tablaclientes .="<strong style="."font-size:12px;".">Nuevos clientes registrados (últimos 7 días):</strong>";
		$tablaclientes .="<table width="."950"." border="."0"." cellspacing="."0"." cellpadding="."0"." >";
		$tablaclientes .="<tr><td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."240"." class="."TablaTituloDato"."> Usuario</td>";  
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."240"." class="."TablaTituloDato"."> Nombre</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."280"." class="."TablaTituloDato"."> Razón Social</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TablaTituloDato"."> CUIT</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."70"." class="."TablaTituloDato"."> Alta</td>"; 
		$tablaclientes .="<td class="."TablaTituloRight"."> </td>";  
		$tablaclientes .=" </tr> ";    
		while($row=mysql_fetch_array($rs)){
			if($row['FPago']==0){$fpago='Ctdo';}else{$fpago='CC';}
			if ($row['Bloqueado']==0){$clase="TablaDato";}else{$clase="TablaDatoR";}
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".substr($row['Usuario'],0,40)."</td>";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".substr($row['Apellido'].' '.$row['Nombre'],0,30)."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".substr($row['RSF'],0,30)."</td>";  			
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
			$tablaclientes .="<td class=".$clase."> ".substr($row['CUITF'],0,15)."</td>";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
			$tablaclientes .="<td class=".$clase."> ".FormatoFecha($row['FechaA'])."</td>";  			
			$tablaclientes .="<td class="."TablaMostrarRight"."> </td>";  
			$tablaclientes .=" </tr> "; 
		}	
		$tablaclientes .="</table>"; 
		echo $tablaclientes;	
	}
	//Cierra consulta
	mysql_free_result($rs);
}


function MostrarTabla2($conn){
	//proximos 7 dias
	$hoy=date("d-m-Y");$fecha=date("d-m-Y", strtotime("$hoy"));$fecha2=date("d-m-Y", strtotime("$hoy +7 day"));
	$wfechad="and DATEDIFF(t.Fecha,'".FechaMySql($fecha)."')>=0 and DATEDIFF(t.Fecha,'".FechaMySql($fecha2)."')<=0";
	//query
	$query="Select u.*,x.Cant,x.Fecha From usuarios u,(Select Count(t.Id) as Cant,t.IdUsuario,t.Fecha From turnos t,usuarios u Where t.IdUsuario=u.Usuario and t.IdUsuario<>'ngrunmann@gmail.com' and u.IdPerfil=5 $wfechad Group By t.IdUsuario,t.Fecha)x Where x.IdUsuario=u.Usuario and x.Cant>2  Order by x.Fecha desc";
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		$tablaclientes="";
		$tablaclientes .="<strong style="."font-size:12px;".">Clientes con mas de 2 turnos diarios (próximos 7 días):</strong>";
		$tablaclientes .="<table width="."950"." border="."0"." cellspacing="."0"." cellpadding="."0"." >";
		$tablaclientes .="<tr><td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."240"." class="."TablaTituloDato"."> Usuario</td>";  
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."240"." class="."TablaTituloDato"."> Nombre</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."280"." class="."TablaTituloDato"."> Razón Social</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TablaTituloDato"."> Turnos</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."70"." class="."TablaTituloDato"."> Fecha</td>"; 
		$tablaclientes .="<td class="."TablaTituloRight"."> </td>";  
		$tablaclientes .=" </tr> ";    
		while($row=mysql_fetch_array($rs)){
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato"."> ".substr($row['Usuario'],0,40)."</td>";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato"."> ".substr($row['Apellido'].' '.$row['Nombre'],0,30)."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class="."TablaDato"."> ".substr($row['RSF'],0,30)."</td>";  			
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
			$tablaclientes .="<td class="."TablaDato"."> ".$row['Cant']."</td>";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
			$tablaclientes .="<td class="."TablaDato"."> ".FormatoFecha($row['Fecha'])."</td>";  			
			$tablaclientes .="<td class="."TablaMostrarRight"."> </td>";  
			$tablaclientes .=" </tr> "; 
		}	
		$tablaclientes .="</table>"; 
		echo $tablaclientes;	
	}
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



<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
<? include ("Codigo/BannerConMenuHVCMIT.php");?>

<form name="Formulario" action="<?=$PHP_SELF?>" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"   >
<tr> <td height="5"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="960" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >ALERTAS</td></tr>
</table>



<table  width="950" border="0" cellspacing="0" cellpadding="0" >
<tr><td  height=3 ></td></tr>
<tr valign="top"> 	<td  align="left" valign="top" > 	<?php MostrarTabla1($conn); ?>	</td>	</tr>
<tr><td  height=10 ></td></tr>
<tr valign="top"> 	<td  align="left" valign="top" > 	<?php MostrarTabla2($conn); ?>	</td>	</tr>
</table>


</td></tr>      
</table>
<? mysql_close($conn);
?>
</Form>		

<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>
