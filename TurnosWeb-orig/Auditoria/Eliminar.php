<? include("../Codigo/SeguridadCMIT.php");include("../Codigo/Funciones.php");include("../Codigo/Config.php");    $_SESSION["NivelArbol"]="../";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

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
		$tablaclientes .=GLO_inittabla(450,1,0,0);
		$tablaclientes .="<td "."width="."60"." class="."TableShowT"."> A&ntilde;o</td>";  
		$tablaclientes .="<td "."width="."100"." class="."TableShowT"."> Mes</td>"; 
		$tablaclientes .="<td "."width="."60"." class="."TableShowT"." style='text-align:right;'> Cantidad</td>"; 
		$tablaclientes .="<td "."width="."230"." class="."TableShowT"."></td>"; 
		$tablaclientes .=" </tr> "; 		       
		while($row=mysql_fetch_array($rs)){
			$mes=G_NombreMes($row['Mes']);
			$clickeliminar="'Desea eliminar el mes ".$mes.' '.$row['Año']."?'";
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TableShowD"."> ".$row['Año']."</td>";  
			$tablaclientes .="<td class="."TableShowD"."> ".$mes."</td>"; 
			$tablaclientes .="<td class="."TableShowD"." style='text-align:right;'>".$row['Cant']."</td>";  
			$tablaclientes .="<td class="."TableShowD"." style='text-align:right;'>"; 
			$tablaclientes .='<input name="CmdExcel" type="submit" class="boton02"   value="Exportar" id="'.$row['Año'].'|'.$row['Mes'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"> &nbsp;&nbsp; <input name="CmdBorrar" type="submit" class="boton02"   value="Borrar" id="'.$row['Año'].'|'.$row['Mes'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');">&nbsp;';
			$tablaclientes .="</td>";  
			$tablaclientes .=" </tr> "; 
		}	
		$tablaclientes .=GLO_fintabla(0,0,0);
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center">No existen datos</p>';}
	//Cierra consulta
	mysql_free_result($rs);
	
}
}


GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHVCMIT','zEliminar',0,0,0,0); 
GLO_tituloypath(0,450,'../Auditoria.php','ELIMINAR AUDITORIAS','linksalir');

GLO_Hidden('TxtId',0);
GLO_mensajeerror();
MostrarTabla($conn);
mysql_close($conn);
GLO_cierratablaform();
include ("../Codigo/FooterConUsuario.php");
?>