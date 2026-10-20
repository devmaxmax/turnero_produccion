<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}


$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

function MostrarTabla($conn){
$query=$_SESSION['TxtConsultaCli'];$query=str_replace("\\", "", $query);
if ( ($query!="")){
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//Titulos de la tabla		
		$tablaclientes="";
		$tablaclientes .=GLO_inittabla(1000,1,0,0); 
		$tablaclientes .="<td "."width="."200"." class="."TableShowT"."> Usuario</td>";  
		$tablaclientes .="<td "."width="."180"." class="."TableShowT"."> Nombre</td>"; 
		$tablaclientes .="<td "."width="."200"." class="."TableShowT"."> Raz&oacute;n Social</td>"; 
		$tablaclientes .="<td "."width="."120"." class="."TableShowT"."> CUIT</td>"; 
		$tablaclientes .="<td "."width="."40"." class="."TableShowT"."> Pago</td>"; 
		$tablaclientes .="<td "."width="."100"." class="."TableShowT"."> Estado</td>"; 
		$tablaclientes .="<td "."width="."50"." class="."TableShowT"."> Alta Turnos</td>"; 
		$tablaclientes .="<td "."width="."90"." class="."TableShowT"."></td>"; 
		$tablaclientes .=" </tr> ";    
		$recuento=0;          
		while($row=mysql_fetch_array($rs)){
			$clickeliminar="'Eliminar Usuario ".substr($row['Usuario'],0,15)."'";	
			$clickclave="'Cambiar clave Usuario ".substr($row['Usuario'],0,15)."'";	
			if($row['FPago']==0){$fpago='Ctdo';}else{$fpago='CC';}
			$clase="TableShowD";$estado='';	
			if (GLO_TURRiesgo($row['Riesgo'],$row['FPago'])!=0){$clase="TableShowD TBlue";$estado='Riesgo';}
			if ($row['Bloqueado']!=0){$clase="TableShowD TRed";$estado='Bloq';}
			if ($row['SA']==1){$altaturno="NO";}else{$altaturno="";}//sin alta
			//valido sin alta modo temporal(ctdo+sinalta+tiene dias y fecha)
			if(GLO_TURSinAltaHT($row['FPago'],$row['SA'],$row['DiasSA'],$row['FechaSA'])==1){$htemp=' HT';}else{$htemp='';}
			//
			$tablaclientes .=" <tr> ";
			$tablaclientes .='<td class="'.$clase.'">'.substr($row['Usuario'],0,30)."</td>";  
			$tablaclientes .='<td class="'.$clase.'">'.substr($row['Apellido'].' '.$row['Nombre'],0,20)."</td>"; 
			$tablaclientes .='<td class="'.$clase.'">'.substr($row['RSF'],0,22)."</td>";  			
			$tablaclientes .='<td class="'.$clase.'">'.substr($row['CUITF'],0,15)."</td>";  
			$tablaclientes .='<td class="'.$clase.'">'.$fpago."</td>"; 
			$tablaclientes .='<td class="'.$clase.'"'." style='font-weight:bold'> ".$estado.' '.GLO_FormatoFecha($row['FechaBL'])."</td>";  
			$tablaclientes .='<td class="'.$clase.'"'." style='font-weight: bold;'> ".$altaturno.$htemp."</td>";  			
			$tablaclientes .='<td class="'.$clase.'"'." style='text-align:right;'>"; 
			$tablaclientes .='<button name="CmdVer" type="submit" class="iconbtn2"   value="" title="Ver" id="'.$row['Usuario'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"><i class="fas fa-edit iconsmallbt iconlgray"></i></button>';
			$tablaclientes .='&nbsp; <button name="CmdBorrar" type="submit" class="iconbtn2"   value="" title="Borrar" id="'.$row['Usuario'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');"><i class="fas fa-trash iconsmallbt iconlgray"></i></button>';
			$tablaclientes .='&nbsp; <button name="CmdClave" type="submit" class="iconbtn2"   value="" title="Clave" id="'.$row['Usuario'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickclave.');"><i class="fa fa-key iconsmallbt iconlgray"></i></button>';
			$tablaclientes .="</td>";  
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


GLO_InitHTML($_SESSION["NivelArbol"],'TxtBusqueda','BannerConMenuHVCMIT','Clientes/zConsulta',0,0,0,0);
GLO_tituloypath(0,650,'InicioCMIT.php','USUARIOS DE CLIENTES','linksalir');

include("Clientes/Includes/zCamposFiltros.php");
GLO_Hidden('TxtId',0);GLO_Hidden('TxtConsultaCli',0);
?>


<table  width="650" border="0" cellspacing="0" cellpadding="0">
<tr><td  height=3 ></td></tr>
<tr><td><input name="CmdAgregar" type="submit" class="boton"  value="Agregar" onClick="document.Formulario.target='_self'"> <input name="CmdEmpresas" type="submit" class="boton"  value="Empresas" onClick="document.Formulario.target='_self'"> <? if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2 or $_SESSION["IdPerfilUser"]==10){echo '<input name="CmdAcciones" type="submit" class="boton"  value="Acciones" onClick="document.Formulario.target='."'_self'".'">';}?> </td></tr>
</table>



<? 
GLO_mensajeerror();
MostrarTabla($conn);
mysql_close($conn);
GLO_cierratablaform();

GLO_initcomment(1000,0);
echo 'La Empresa que se muestra es la principal, las empresas adjuntas pueden consultarse haciendo click en <font class="comentario3">Empresas</font><br>';
echo 'Los Usuarios con Forma de Pago <font class="comentario2">Cuenta Corriente</font> podr&aacute;n optar por abonar Contado o Cuenta Corriente<br>';
echo 'Los Usuarios con Forma de Pago <font class="comentario3">Contado</font> s&oacute;lo podr&aacute;n pagar Contado anticipado al envio del paciente<br>';
echo 'Los Usuarios con Forma de Pago <font class="comentario3">Contado</font> son Clientes de <font class="comentario2">Riesgo</font><br>';
echo 'Los Usuarios sin <font class="comentario3">Alta de Turnos</font> con <font class="comentario2">HT</font>, estan habilitados temporalmente<br>';
GLO_endcomment();
include ("Codigo/FooterConUsuario.php");
?>