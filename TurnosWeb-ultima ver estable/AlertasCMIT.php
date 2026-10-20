<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}




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
		$tablaclientes .="<strong style="."font-size:12px;".">Nuevos clientes registrados (&uacute;ltimos 7 dias):</strong>";
		$tablaclientes .=GLO_inittabla(950,1,0,0);
		$tablaclientes .="<td "."width="."240"." class="."TableShowT"."> Usuario</td>";  
		$tablaclientes .="<td "."width="."240"." class="."TableShowT"."> Nombre</td>"; 
		$tablaclientes .="<td "."width="."280"." class="."TableShowT"."> Raz&oacute;n Social</td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TableShowT"."> CUIT</td>"; 
		$tablaclientes .="<td "."width="."70"." class="."TableShowT"."> Alta</td>"; 
		$tablaclientes .=" </tr> ";    
		while($row=mysql_fetch_array($rs)){
			if($row['FPago']==0){$fpago='Ctdo';}else{$fpago='CC';}
			if ($row['Bloqueado']==0){$clase="TableShowD";}else{$clase="TableShowD TRed";}
			$tablaclientes .=" <tr> ";
			$tablaclientes .='<td class="'.$clase.'">'.substr($row['Usuario'],0,40)."</td>";  
			$tablaclientes .='<td class="'.$clase.'">'.substr($row['Apellido'].' '.$row['Nombre'],0,30)."</td>"; 
			$tablaclientes .='<td class="'.$clase.'">'.substr($row['RSF'],0,30)."</td>";  			
			$tablaclientes .='<td class="'.$clase.'">'.substr($row['CUITF'],0,15)."</td>";  
			$tablaclientes .='<td class="'.$clase.'">'.FormatoFecha($row['FechaA'])."</td>";  			
			$tablaclientes .=" </tr> "; 
		}mysql_free_result($rs);	
		$tablaclientes .=GLO_fintabla(0,0,0);
		echo $tablaclientes;	
	}
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
		$tablaclientes .="<strong style="."font-size:12px;".">Clientes con mas de 2 turnos diarios (pr&oacute;ximos 7 dias):</strong>";
		$tablaclientes .=GLO_inittabla(1120,1,0,0);
		$tablaclientes .="<td "."width="."300"." class="."TableShowT"."> Usuario</td>";  
		$tablaclientes .="<td "."width="."300"." class="."TableShowT"."> Nombre</td>"; 
		$tablaclientes .="<td "."width="."300"." class="."TableShowT"."> Raz&oacute;n Social</td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TableShowT"."> Turnos</td>"; 
		$tablaclientes .="<td "."width="."100"." class="."TableShowT"."> Fecha</td>"; 
		$tablaclientes .=" </tr> ";    
		while($row=mysql_fetch_array($rs)){
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center'> ".substr($row['Usuario'],0,40)."</td>";  
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center'> ".substr($row['Apellido'].' '.$row['Nombre'],0,30)."</td>"; 
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center'> ".substr($row['RSF'],0,30)."</td>";  			
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center'> ".$row['Cant']."</td>";  
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center'> ".FormatoFecha($row['Fecha'])."</td>";  			
			$tablaclientes .=" </tr> "; 
		}mysql_free_result($rs);	
		$tablaclientes .=GLO_fintabla(0,0,0);
		echo $tablaclientes;	
	}
}


GLOF_Init('','BannerConMenuHVCMIT','',0,'',0,0,0); 
GLO_tituloypath(0,1120,'','ALERTAS','');
?>


<table  width="950" border="0" cellspacing="0" cellpadding="0" >
<tr>
	<td  height=3></td>
</tr>
<tr valign="middle">
	<td  align="left" valign="middle" >
		<?php MostrarTabla1($conn); ?>
	</td>
</tr>
<tr>
	<td  height=10 ></td>
</tr>
<tr valign="middle">
	<td  align="left" valign="middle" >
		<?php MostrarTabla2($conn); ?>
	</td>
</tr>
</table>


<? 
mysql_close($conn);
GLO_cierratablaform();
include ("Codigo/FooterConUsuario.php");
?>