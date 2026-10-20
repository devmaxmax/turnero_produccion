<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

if (empty($_SESSION['TxtFechaAD'])){
	$hoy=date("d-m-Y");$_SESSION['TxtFechaAD']=$hoy;$_SESSION['TxtFechaAH']=$hoy;	
}

function MostrarTabla($conn){
$query=$_SESSION['TxtConsulta'];$query=str_replace("\\", "", $query);
	if ($query!=""){
		$rs=mysql_query($query,$conn);
		if(mysql_num_rows($rs)!=0){	
			$tablaclientes="";
			$tablaclientes .=GLO_inittabla(620,1,0,0);
			$tablaclientes .="<td "."width="."130"." class="."TableShowT".">Fecha</td>";   
			$tablaclientes .="<td "."width="."100"." class="."TableShowT".">M&oacute;dulo</td>";   
			$tablaclientes .="<td "."width="."130"." class="."TableShowT".">Acci&oacute;n</td>";   
			$tablaclientes .="<td "."width="."60"." class="."TableShowT"." style='text-align:right;'>Registro</td>"; 
			$tablaclientes .="<td "."width="."200"." class="."TableShowT".">Usuario</td>";   
			$tablaclientes .=" </tr> ";
			$recuento=0;              
			//Datos
			while($row=mysql_fetch_array($rs)){ 
				$tablaclientes .=' <tr> ';  
				$tablaclientes .="<td class="."TableShowD"."> "." ".FormatoFechaHora($row['Fecha'])."</td>"; 
				$tablaclientes .="<td class="."TableShowD"."> "." ".$row['Modulo']."</td>"; 
				$tablaclientes .="<td class="."TableShowD"."> "." ".$row['Accion']."</td>"; 
				$tablaclientes .="<td class="."TableShowD"." style='text-align:right;'> "." ".str_pad($row['IdRegistro'], 6, "0", STR_PAD_LEFT)."</td>"; 
				$tablaclientes .="<td class="."TableShowD"."> "." ".$row['IdUsuario']."</td>"; 
				$tablaclientes .=" </tr> "; 
				$recuento=$recuento+1;
			}	
			$tablaclientes .=GLO_fintabla(0,0,$recuento);
			echo $tablaclientes;
		}else{echo '<p class="MuestraConf" align="center">No existen datos que cumplan esos criterios</p>';}	
		mysql_free_result($rs);	
	}	
	
}






function ComboUsuarioAuditoria($conn){ 
$query="SELECT Usuario FROM usuarios Where Usuario<>'ngrunmann@gmail.com' Order by Usuario";$rs=mysql_query($query,$conn);
$combo="";
while($row=mysql_fetch_array($rs)){ 
  if( $row['Usuario'] == $_SESSION['CbUsuario']) {
   $combo .= " <option value='".$row['Usuario']."' selected='"."selected";
   $combo .= "'>".$row['Usuario']."</option>\n";
 }else{
   $combo .= " <option value='".$row['Usuario']."'>".$row['Usuario']."</option>\n";
   }}
echo $combo;
mysql_free_result($rs);
}


GLO_InitHTML($_SESSION["NivelArbol"],'','BannerConMenuHVCMIT','Auditoria/zAuditoria',0,0,0,0);
GLO_tituloypath(0,600,'InicioCMIT.php','AUDITORIA DE CAMBIOS','linksalir'); 
?> 

<table width="600" border="0"   cellspacing="0" align="center"  class="Tabla">
	<tr>
		<td  height="5" width="70" ></td>
		<td width="250"></td>
		<td  width="180"></td>
	</tr>
	<tr>
		<td height="18" align="right">M&oacute;dulo: </td>
		<td> &nbsp; <select name="CbTabla" style="width:200px" class="campos" id="CbTabla"  > <option value=""> </option>  <? ComboTablaRFX("auditoriatablas","CbTabla","Nombre","","",$conn); ?></select>&nbsp; </td>
		<td align="left" >Fecha:&nbsp; <input name="TxtFechaAD"   type="text" class="TextBox"  style="width:70px" maxlength="10"  onchange="this.value=validarFecha(this.value);" value="<? echo $_SESSION['TxtFechaAD']; ?>"   >&nbsp;al&nbsp;<input name="TxtFechaAH"   type="text" class="TextBox"  style="width:70px" maxlength="10"  onchange="this.value=validarFecha(this.value);" value="<? echo $_SESSION['TxtFechaAH']; ?>"   >&nbsp;</td>
	</tr> 
	<tr>
		<td height="18" align="right">Acci&oacute;n: </td>
		<td> &nbsp; <select name="CbAccion" class="campos" id="CbAccion"  style="width:200px"> <option value=""> </option><? ComboTablaRFX("auditoriaacciones","CbAccion","Nombre","","",$conn); ?></select></td>
		<td align="right">  </td>
	</tr>
	<tr>
		<td height="18" align="right">Usuario: </td>
		<td > &nbsp; <select name="CbUsuario" class="campos" id="CbUsuario"  style="width:200px"> <option value=""> </option><? ComboUsuarioAuditoria($conn); ?></select></td>
		<td align="right" ></td>
	</tr>
	<tr>
		<td height="18" align="right"></td>
		<td></td>
		<td align="left"><input  name="TxtId"  type="hidden"  value="<? echo $_SESSION['TxtId']; ?>"> <input  name="TxtConsulta"  type="hidden"   value="<? echo $_SESSION['TxtConsulta']; ?>"><? GLOF_Search('CmdBuscar',0); ?>&nbsp;</td>
	</tr>
</table>


<?
GLO_linkbutton(600,'Eliminar','Auditoria/Eliminar.php','','','','');
GLO_mensajeerror();
MostrarTabla($conn);
mysql_close($conn);
GLO_cierratablaform();
include ("Codigo/FooterConUsuario.php");
?>