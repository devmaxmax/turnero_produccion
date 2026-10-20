<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php");include("Codigo/Funciones.php");$_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

function MostrarTabla($conn){
$query="Select u.*,p.Nombre as NombrePerfil from usuarios u,perfiles p where u.IdPerfil=p.Id and u.Usuario<>'ngrunmann@gmail.com' and u.IdPerfil<>5 and u.IdPerfil<>1 Order by u.Apellido,u.Nombre"; 
$rs=mysql_query($query,$conn);
//Titulos de la tabla
$tablaclientes="";
$tablaclientes .=GLO_inittabla(700,1,0,0); 
$tablaclientes .="<td "."width="."280"." class="."TableShowT"."> Nombre</td>";   
$tablaclientes .="<td "."width="."180"." class="."TableShowT"."> Usuario </td>";   
$tablaclientes .="<td "."width="."170"." class="."TableShowT"."> Perfil</td>";  
$tablaclientes .="<td width="."60"." class="."TableShowT"."> </td>"; 
$tablaclientes .=" </tr> ";             
$recuento=0;
$estilo=" style='cursor:pointer;' "; 
while($row=mysql_fetch_array($rs)){	
	$link=" onclick="."location='Usuarios/Modificar.php?id=".encrypt($row['Usuario'],'elcrucedelosandes2016')."'";
	$clickeliminar="'Eliminar Usuario ".substr($row['Usuario'],0,15)."'";	
	$tablaclientes .=" <tr".$estilo."> "; 
	$tablaclientes .="<td class="."TableShowD".$link."> ".substr($row['Apellido']." ".$row['Nombre'],0,30)."</td>"; 
	$tablaclientes .="<td class="."TableShowD".$link."> ".substr($row['Usuario'],0,20)."</td>"; 
	$tablaclientes .="<td class="."TableShowD".$link."> ".substr($row['NombrePerfil'],0,20)."</td>"; 
	$tablaclientes .="<td class="."TableShowD"." style='text-align:center;'>";
	$tablaclientes .='<button name="CmdBorrar" type="submit" class="iconbtn2"   value="" title="Borrar" id="'.$row['Usuario'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');"><i class="fas fa-trash iconsmallbt iconlgray"></i></button>';
	$tablaclientes .='&nbsp; <button name="CmdClave" type="submit" class="iconbtn2"   value="" title="Clave" id="'.$row['Usuario'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';"><i class="fa fa-key iconsmallbt iconlgray"></i></button>';
	$tablaclientes .="</td>";  
	$tablaclientes .=" </tr> "; 
	$recuento=$recuento+1;
}	
$tablaclientes .=GLO_fintabla(0,0,$recuento);
echo $tablaclientes;	
//Cierra consulta
mysql_free_result($rs);
}


GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHVCMIT','Usuarios/zUsuarios',0,0,0,0); 
GLO_tituloypath(0,700,'','USUARIOS','basica');

GLO_Hidden('TxtId',0);
GLO_mensajeerror();
MostrarTabla($conn);
mysql_close($conn); 
GLO_cierratablaform();
include ("Codigo/FooterConUsuario.php");
?>