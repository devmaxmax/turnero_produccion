<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);


function MostrarTabla($conn){
//trae los meses que registran turnos
$hoy=date("d-m-Y"); list($d,$m,$a)=explode("-",$hoy);$primerdiames="01-".$m."-".$a;
$fecha=date("d-m-Y", strtotime("$primerdiames -1 month"));

$query="Select count(Id) as Cant, month(Fecha) as Mes,year(Fecha) as Ano From turnos Where DATEDIFF(Fecha,'".FechaMySql($fecha)."')<=0 Group by year(Fecha),month(Fecha) Order by year(Fecha),month(Fecha)";
if ( ($query!="")){
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//Titulos de la tabla		
		$tablaclientes="";
		$tablaclientes .=GLO_inittabla(900,1,0,0);
		$tablaclientes .="<td "."width="."150"." class="."TableShowT"."> A&ntilde;o</td>";  
		$tablaclientes .="<td "."width="."250"." class="."TableShowT"."> Mes</td>"; 
		$tablaclientes .="<td "."width="."200"." class="."TableShowT"."> Cantidad</td>"; 
		$tablaclientes .="<td "."width="."300"." class="."TableShowT"."></td>"; 
		$tablaclientes .=" </tr> "; 		       
		while($row=mysql_fetch_array($rs)){
			$mes=G_NombreMes($row['Mes']);
			$clickeliminar="'Desea eliminar el mes ".$mes.' '.$row['Ano']."?'";
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center;'> ".$row['Ano']."</td>";  
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center;'> ".$mes."</td>"; 
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center;'>".$row['Cant']."</td>";  
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center;'>"; 
			$tablaclientes .='<input name="CmdExcel" type="submit" class="boton02" style="width:90px"  value="Exportar" id="'.$row['Ano'].'|'.$row['Mes'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'">  <input name="CmdBorrar" type="submit" class="boton02" style="width:90px"  value="Borrar" id="'.$row['Ano'].'|'.$row['Mes'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');">&nbsp;';
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



GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHVCMIT','TurnosCMIT/zEliminar',0,0,0,0); 
GLO_tituloypath(0,1120,'InicioCMIT.php','ELIMINAR TURNOS','linksalir'); 

GLO_Hidden('TxtId',0);
GLO_mensajeerror();
MostrarTabla($conn); 
mysql_close($conn);
GLO_cierratablaform();
include ("Codigo/FooterConUsuario.php");
?>