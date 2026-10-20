<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
$_SESSION['TxtUsuario']=mysql_real_escape_string(decrypt($_GET['id'],'elcrucedelosandes2016'));	



function MostrarTabla($conn){
//trae turnos vigentes del usuario
$hoy=date("d-m-Y");$fecha=date("d-m-Y", strtotime("$hoy -7 day"));
$wfechad="and DATEDIFF(t.Fecha,'".FechaMySql($fecha)."')>=0";
$usr=$_SESSION["TxtUsuario"];
//trae RSF de usuarios
$query="SELECT u.RSF FROM usuarios u where u.Usuario='$usr'";$rs=mysql_query($query,$conn);
while($row=mysql_fetch_array($rs)){$rsf0=$row['RSF'];}mysql_free_result($rs);
//muestra turnos+sobreturnos 
$horasobreturnover=GLO_horasobreturnovermysql();
//turnos
$query1="Select t.*,e.Nombre as Entidad,uc.RSF,t.Hora as Hora2 From turnos t,entidades e,usuariosclientes uc Where t.Id<>0 and t.Estado<>3 and t.IdEntidad=e.Id and t.IdUsuario='$usr' and uc.Id=t.IdRSF $wfechad and t.STurno<>1";
//sobreturnos
$query2="Select t.*,e.Nombre as Entidad,uc.RSF,'".$horasobreturnover."' as Hora2 From turnos t,entidades e,usuariosclientes uc Where t.Id<>0 and t.Estado<>3 and t.IdEntidad=e.Id and t.IdUsuario='$usr' and uc.Id=t.IdRSF $wfechad and t.STurno=1";
//turnos+sobreturnos
$query="Select x.* From($query1 UNION ALL $query2)x Order by x.Fecha,x.Hora2";
if ( ($query!="")){
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//Titulos de la tabla		
		$tablaclientes="";
		$tablaclientes .=GLO_inittabla(1050,1,0,0);
		$tablaclientes .="<td "."width="."50"." class="."TableShowT"." style='text-align:right;' > Turno</td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TableShowT"."> Fecha</td>";  
		$tablaclientes .="<td "."width="."210"." class="."TableShowT"."> Raz&oacute;n Social</td>"; 
		$tablaclientes .="<td "."width="."270"." class="."TableShowT"."> Paciente</td>"; 
		$tablaclientes .="<td "."width="."320"." class="."TableShowT"."> Tipo Examen</td>"; 
		$tablaclientes .="<td "."width="."80"." class="."TableShowT"."> Estado</td>"; 
		$tablaclientes .=" </tr> ";    
		$recuento=0;  
		while($row=mysql_fetch_array($rs)){
			if($row['IdRSF']==0){$empresa=$rsf0;}else{$empresa=$row['RSF'];}
			if($row['Estado']==0){$estado='Sin Atender';$colorest='';}
			else{$estado='Atendido';$colorest=' style="font-weight:bold;color:#0F9D58"';}			
			$clickeliminar="'Desea eliminar el turno ".$fecha."? Grabara los cambios y enviara mail a su Usuario'";
			//si es sobreturno letra azul
			if($row['STurno']==1){
				$estilost=' style="font-weight:bold;color:#4285F4;"';
				$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha'])).' '.FormatoFecha($row['Fecha']).' '.GLO_horasobreturnover();
			}else{
				$estilost='';
				$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha'])).' '.FormatoFecha($row['Fecha']).' '.date("H:i",strtotime($row['Hora']));
			}
			$mostrartipoex=2;include("Includes/zTipoExamen.php");
			//
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TableShowD"." style='text-align:right;'> ".str_pad($row['Id'], 6, "0", STR_PAD_LEFT)."</td>";  
			$tablaclientes .="<td class="."TableShowD".$estilost."> ".$fecha."</td>";  
			$tablaclientes .="<td class="."TableShowD"."> ".substr($empresa,0,24)."</td>";  			
			$tablaclientes .="<td class="."TableShowD"."> ".substr($row['Paciente'],0,35)."</td>";  			
			$tablaclientes .="<td class="."TableShowD"."> ".$tipoex1."</td>"; 
			$tablaclientes .="<td class="."TableShowD".$colorest."> ".$estado."</td>"; 
			$tablaclientes .=" </tr> "; 
			$recuento=$recuento+1;
		}	
		$tablaclientes .=GLO_fintabla(0,0,$recuento);
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center">No existen datos</p>';}
	//Cierra consulta
	mysql_free_result($rs);
	
}
}



GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHVCMIT','TurnosCMIT/zMisTurnos',0,0,0,0);
GLO_tituloypath(0,1050,'','TURNOS','salir'); 


GLO_mensajeerror();
GLO_Hidden('TxtId',0);GLO_Hidden('TxtUsuario',0);
MostrarTabla($conn);
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(1050,0);
echo 'Si es un <font class="comentario3">sobre turno</font> la fecha se mostrar&aacute; en color <font class="comentario2">azul</font><br>';
GLO_endcomment();
include ("Codigo/FooterConUsuario.php");
?>