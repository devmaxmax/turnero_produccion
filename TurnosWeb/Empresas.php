<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}




$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);



function MostrarTabla($conn){
$query=$_SESSION['TxtConsultaEmpre'];$query=str_replace("\\", "", $query);
if ( ($query!="")){
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//Titulos de la tabla		
		$tablaclientes="";
		$tablaclientes .=GLO_inittabla(1120,1,0,0);
		$tablaclientes .="<td "."width="."400"." class="."TableShowT"."> Raz&oacute;n Social</td>"; 
		$tablaclientes .="<td "."width="."150"." class="."TableShowT"."> CUIT</td>"; 
		$tablaclientes .="<td "."width="."220"." class="."TableShowT"."> Usuario</td>";  
		$tablaclientes .="<td "."width="."350"." class="."TableShowT"."> Nombre</td>"; 
		$tablaclientes .=" </tr> ";    
		$recuento=0;          
		while($row=mysql_fetch_array($rs)){
			$clickeliminar="'Desea eliminar el usuario'";
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center'> ".substr($row['RSF'],0,40)."</td>";  			
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center'> ".substr($row['CUITF'],0,15)."</td>";
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center'> ".substr($row['Usuario'],0,25)."</td>";  
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center'> ".substr($row['Apellido'].' '.$row['Nombre'],0,35)."</td>"; 
			$tablaclientes .=" </tr> "; 
			$recuento=$recuento+1;
		}	
		$tablaclientes .=GLO_fintabla(1,0,$recuento);
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center">No existen datos</p>';}
	//Cierra consulta
	mysql_free_result($rs);
	
}
}



GLO_InitHTML($_SESSION["NivelArbol"],'TxtBusqueda','BannerConMenuHVCMIT','Clientes/zEmpresas',0,0,0,0);
GLO_tituloypath(0,1120,'Clientes.php','EMPRESAS REGISTRADAS','linksalir'); 
?>


<table width="800" border="0" cellspacing="0" class="Tabla">
<tr>
	<td width="200" align="right">Empresa:</td>
	<td>
		<input name="TxtBusqueda" type="text" class="TextBox" style="width:180px" maxlength="20" onKeyDown="enterxtab(event)">
	</td>
	<td width="150" height="18" align="right">Usuario:</td>
	<td width="200">
		<input name="TxtBusquedaU" type="text" class="TextBox" style="width:180px" maxlength="20" onKeyDown="enterxtab(event)">
	</td>
	<td width="250" align="center">
		<input name="TxtId" type="hidden" value="<? echo $_SESSION['TxtId']; ?>">
		<input name="TxtConsultaEmpre" type="hidden" value="<? echo $_SESSION['TxtConsultaEmpre']; ?>"><? GLOF_Search('CmdBuscar',0); ?>
	</td>
</tr>
</table>




<?
GLO_mensajeerror();
MostrarTabla($conn); 
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(1120,0);
echo 'Muestra las <font class="comentario2">Empresas</font> asociadas a los <font class="comentario3">Usuarios</font> registrados';
GLO_endcomment();

include ("Codigo/FooterConUsuario.php");

?>