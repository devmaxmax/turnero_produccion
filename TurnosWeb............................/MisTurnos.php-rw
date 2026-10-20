<? include("Codigo/Seguridad.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";


$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);


function MostrarTabla($conn){
//trae turnos vigentes del usuario
$hoy=date("d-m-Y");$fecha=date("d-m-Y", strtotime("$hoy -7 day"));$wfechad="and DATEDIFF(t.Fecha,'".FechaMySql($fecha)."')>=0";
$usr=$_SESSION["login"];
//trae RSF de usuarios
$query="SELECT u.RSF FROM usuarios u where u.Usuario='$usr'";$rs=mysql_query($query,$conn);
while($row=mysql_fetch_array($rs)){$rsf0=$row['RSF'];}mysql_free_result($rs);
//muestra turnos+sobreturnos 
$horasobreturnover=GLO_horasobreturnovermysql();
//turnos
$query1="Select t.*,tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF,t.Hora as Hora2 From turnos t,tipoexamen tex,entidades e,usuariosclientes uc Where t.Id<>0 and t.Estado<>3 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and t.IdUsuario='$usr' and uc.Id=t.IdRSF $wfechad and t.STurno<>1";
//sobreturnos
$query2="Select t.*,tex.Nombre as TipoEx,e.Nombre as Entidad,uc.RSF,'".$horasobreturnover."' as Hora2 From turnos t,tipoexamen tex,entidades e,usuariosclientes uc Where t.Id<>0 and t.Estado<>3 and t.IdTipoEx=tex.Id and t.IdEntidad=e.Id and t.IdUsuario='$usr' and uc.Id=t.IdRSF $wfechad and t.STurno=1";
//turnos+sobreturnos
$query="Select x.* From($query1 UNION ALL $query2)x Order by x.Fecha,x.Hora2";
if ( ($query!="")){
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//Titulos de la tabla		
		$tablaclientes="";
		$tablaclientes .=GLO_inittabla(890,1,0,0);
		$tablaclientes .="<td "."width="."50"." class="."TableShowT"." style='text-align:right;' > Turno</td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TableShowT"."> Fecha</td>";  
		$tablaclientes .="<td "."width="."110"." class="."TableShowT"."> Raz&oacute;n Social</td>"; 
		$tablaclientes .="<td "."width="."230"." class="."TableShowT"."> Paciente</td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TableShowT"."> Tipo Examen</td>"; 
		$tablaclientes .="<td "."width="."80"." class="."TableShowT"."> Estado</td>"; 
		$tablaclientes .="<td "."width="."150"." class="."TableShowT"."></td>"; 
		$tablaclientes .="<td "."width="."30"." class="."TableShowT"."></td>"; 
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
			//
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TableShowD"." style='text-align:right;'> ".str_pad($row['Id'], 6, "0", STR_PAD_LEFT)."</td>";  
			$tablaclientes .="<td class="."TableShowD".$estilost."> ".$fecha."</td>";  
			$tablaclientes .="<td class="."TableShowD"."> ".substr($empresa,0,12)."</td>";  			
			$tablaclientes .="<td class="."TableShowD"."> ".substr($row['Paciente'],0,30)."</td>";  			
			$tablaclientes .="<td class="."TableShowD"."> ".substr($row['TipoEx'],0,20)."</td>"; 
			$tablaclientes .="<td class="."TableShowD".$colorest."> ".$estado."</td>"; 
			$tablaclientes .="<td class="."TableShowD"." style='text-align:right;'>"; 
			if($row['Estado']==0){
				$tablaclientes .='<input name="CmdVer" type="submit" class="boton02" style="width:60px;"  value="Editar" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"> <input name="CmdBorrar" type="submit" class="boton02"   value="Borrar" style="width:60px;" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');">';
			}else{
				$tablaclientes .='<input name="CmdSoloVer" type="submit" class="boton02" style="width:60px;"  value="Ver" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'">';
			}
			$tablaclientes .="&nbsp;</td>"; 
			$tablaclientes .="<td class="."TableShowD"." style='text-align:right;'>";  
			//exporta a pdf si estan sin atender
			if($row['Estado']==0){
				$tablaclientes .='<button name="CmdPDF" type="submit" class="iconbtn2"   value="" title="Constancia de Turno" id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_blank'".'"><i class="far fa-file-pdf iconsmallbt iconred2"></i></button>';
			}
			$tablaclientes .="&nbsp;</td>"; 
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



GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHV','Turnos/zMisTurnos',0,0,0,0); 
GLO_tituloypath(0,890,'Inicio.php','MIS TURNOS','linksalir');

GLO_mensajeerror();
GLO_Hidden('TxtId',0);
MostrarTabla($conn);
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(890,0);
echo 'Si es un <font class="comentario3">sobre turno</font> la fecha se mostrar&aacute; en color <font class="comentario2">azul</font><br>';
echo 'Los Turnos con una antig&uuml;edad mayor a una semana ser&aacute;n borrados autom&aacute;ticamente';
GLO_endcomment();
include ("Codigo/FooterConUsuario.php");
?>