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
		$tablaclientes .=GLO_inittabla(900,1,0,0);
		$tablaclientes .="<td "."width="."340"." class="."TableShowT"."> Raz&oacute;n Social</td>"; 
		$tablaclientes .="<td "."width="."100"." class="."TableShowT"."> CUIT</td>"; 
		$tablaclientes .="<td "."width="."170"." class="."TableShowT"."> Usuario</td>";  
		$tablaclientes .="<td "."width="."300"." class="."TableShowT"."> Nombre</td>"; 
		$tablaclientes .=" </tr> ";    
		$recuento=0;          
		while($row=mysql_fetch_array($rs)){
			$clickeliminar="'Desea eliminar el usuario'";
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TableShowD"."> ".substr($row['RSF'],0,40)."</td>";  			
			$tablaclientes .="<td class="."TableShowD"."> ".substr($row['CUITF'],0,15)."</td>";
			$tablaclientes .="<td class="."TableShowD"."> ".substr($row['Usuario'],0,25)."</td>";  
			$tablaclientes .="<td class="."TableShowD"."> ".substr($row['Apellido'].' '.$row['Nombre'],0,35)."</td>"; 
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
GLO_tituloypath(0,690,'Clientes.php','EMPRESAS REGISTRADAS','linksalir'); 
?>


<table width="690" border="0"   cellspacing="0" class="Tabla" >
<tr> <td height="5" width="70"></td><td width="100"></td><td width="140"></td><td width="70"></td><td width="190"></td><td width="120"></td></tr>
<tr> <td height="18"  align="right">Empresa:</td><td  colspan="2" >&nbsp;<input name="TxtBusqueda" type="text" class="TextBox" style="width:180px" maxlength="20" onKeyDown="enterxtab(event)"></td><td height="18" align="right">Usuario:</td><td >&nbsp;<input name="TxtBusquedaU" type="text" class="TextBox" style="width:150px" maxlength="20" onKeyDown="enterxtab(event)"></td>
<td   align="right" ><input  name="TxtId"  type="hidden"  value="<? echo $_SESSION['TxtId']; ?>"><input  name="TxtConsultaEmpre"  type="hidden"   value="<? echo $_SESSION['TxtConsultaEmpre']; ?>"><? GLOF_Search('CmdBuscar',0); ?>&nbsp;</td></tr>
</table>




<?
GLO_mensajeerror();
MostrarTabla($conn); 
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(920,0);
echo 'Muestra las <font class="comentario2">Empresas</font> asociadas a los <font class="comentario3">Usuarios</font> registrados';
GLO_endcomment();

include ("Codigo/FooterConUsuario.php");
?>