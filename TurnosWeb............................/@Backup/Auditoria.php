<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

if (empty($_SESSION[TxtFechaAD])){
	$hoy=date("d-m-Y");$_SESSION[TxtFechaAD]=$hoy;$_SESSION[TxtFechaAH]=$hoy;	
}

function MostrarTabla($conn){
$query=$_SESSION[TxtConsulta];$query=str_replace("\\", "", $query);
	if ($query!=""){
		$rs=mysql_query($query,$conn);
		if(mysql_num_rows($rs)!=0){	
			$tablaclientes="";
			$tablaclientes .="<table width="."620"." border="."0"." cellspacing="."0"." cellpadding="."0"." ><tr>";
			$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
			$tablaclientes .="<td "."width="."130"." class="."TablaTituloDato".">Fecha</td>";   
			$tablaclientes .="<td class="."TablaTituloLeft"."> </td>";  
			$tablaclientes .="<td "."width="."100"." class="."TablaTituloDato".">Módulo</td>";   
			$tablaclientes .="<td class="."TablaTituloLeft"."> </td>";  
			$tablaclientes .="<td "."width="."130"." class="."TablaTituloDato".">Acción</td>";   
			$tablaclientes .="<td class="."TablaTituloLeft"."> </td>";  
			$tablaclientes .="<td "."width="."60"." class="."TablaTituloDato"." style='text-align:right;'>Registro</td>"; 
			$tablaclientes .="<td class="."TablaTituloLeft"."> </td>";  
			$tablaclientes .="<td "."width="."200"." class="."TablaTituloDato".">Usuario</td>";   
			$tablaclientes .="<td class="."TablaTituloRight"."> </td>";  
			$tablaclientes .=" </tr> ";
			$recuento=0;              
			//Datos
			while($row=mysql_fetch_array($rs)){ 
				$tablaclientes .=' <tr> ';  
				$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";
				$tablaclientes .="<td class="."TablaDato"."> "." ".FormatoFechaHora($row['Fecha'])."</td>"; 
				$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
				$tablaclientes .="<td class="."TablaDato"."> "." ".$row['Modulo']."</td>"; 
				$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
				$tablaclientes .="<td class="."TablaDato"."> "." ".$row['Accion']."</td>"; 
				$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";			
				$tablaclientes .="<td class="."TablaDato"." style='text-align:right;'> "." ".str_pad($row['IdRegistro'], 6, "0", STR_PAD_LEFT)."</td>"; 
				$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";	
				$tablaclientes .="<td class="."TablaDato"."> "." ".$row['IdUsuario']."</td>"; 
				$tablaclientes .="<td class="."TablaMostrarRight"."> </td>"; 
				$tablaclientes .=" </tr> "; 
				$recuento=$recuento+1;
			}	
			$tablaclientes .="</table>"; 
			$tablaclientes .="<p class="."recuento"." align="."right"."> $recuento registros</p>"; 
			echo $tablaclientes;
		}else{echo '<p class="MuestraConf" align="center">No existen datos que cumplan esos criterios</p>';}	
		mysql_free_result($rs);	
	}	
	
}






function ComboUsuarioAuditoria($conn){ 
$query="SELECT Usuario FROM usuarios Where Usuario<>'ngrunmann@gmail.com' Order by Usuario";$rs=mysql_query($query,$conn);
$combo="";
while($row=mysql_fetch_array($rs)){ 
  if( $row['Usuario'] == $_SESSION[CbUsuario]) {
   $combo .= " <option value='".$row['Usuario']."' selected='"."selected";
   $combo .= "'>".$row['Usuario']."</option>\n";
 }else{
   $combo .= " <option value='".$row['Usuario']."'>".$row['Usuario']."</option>\n";
   }}
echo $combo;
mysql_free_result($rs);
}

?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<? include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<? include ("Codigo/BannerConMenuHVCMIT.php");?>

<form  name="Formulario" action="Auditoria/zAuditoria.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"  >
<tr> <td height="8"></td></tr>
<tr > <td align="right" valign="top" > </td></tr>						
<tr><td>
<table width="750" border="0"  cellpadding="0" cellspacing="0"  align="center" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >AUDITORIA DE CAMBIOS</td></tr>
</table>


<!-- -->       
<table width="600" border="0"  cellpadding="0" cellspacing="0" align="center"  class="Tabla" >
<tr> <td  height="5"  width="70" ></td><td  width="250" ></td> <td  width="180" ></td></tr>
<tr><td height="18"  align="right"  >Módulo: </td><td > &nbsp; <select name="CbTabla" style="width:200px" class="campos" id="CbTabla"  > <option value=""> </option>  <? ComboTablaRFX("auditoriatablas","CbTabla","Nombre","","",$conn); ?></select>&nbsp; </td>
<td align="right" >Fecha:&nbsp; <input name="TxtFechaAD"   type="text" class="TextBox"  style="width:70px" maxlength="10"  onchange="this.value=validarFecha(this.value);" value="<? echo $_SESSION[TxtFechaAD]; ?>"   >&nbsp;al&nbsp;<input name="TxtFechaAH"   type="text" class="TextBox"  style="width:70px" maxlength="10"  onchange="this.value=validarFecha(this.value);" value="<? echo $_SESSION[TxtFechaAH]; ?>"   >&nbsp;</td></tr> 
<tr> <td height="3"></td></tr>
<tr>  <td height="18"  align="right"  >Acción: </td>
<td > &nbsp; <select name="CbAccion" class="campos" id="CbAccion"  style="width:200px"> <option value=""> </option><? ComboTablaRFX("auditoriaacciones","CbAccion","Nombre","","",$conn); ?></select></td>  
 <td align="right" >  </td></tr>
 <tr> <td height="3"></td></tr>
<tr>  <td height="18"  align="right"  >Usuario: </td>
<td > &nbsp; <select name="CbUsuario" class="campos" id="CbUsuario"  style="width:200px"> <option value=""> </option><? ComboUsuarioAuditoria($conn); ?></select></td>  
 <td align="right" ><input  name="TxtId"  type="hidden"  value="<? echo $_SESSION[TxtId]; ?>"> <input  name="TxtConsulta"  type="hidden"   value="<? echo $_SESSION[TxtConsulta]; ?>">
   <input name="CmdBuscar"  type="submit" class="botonbuscarG"  value="" title="Buscar" >&nbsp;<input name="CmdSalir"  type="submit" class="botonsalirG"  title="Salir" value="" onClick="document.Formulario.target='_self'">&nbsp; </td></tr>
<tr> <td height="5"></td></tr>   
</table>

<table  width="600" border="0" cellspacing="0" cellpadding="0"  align="center">
<tr><td  height=3 ></td></tr>
<tr  valign="bottom"><td><input name="CmdEliminar" type="submit" class="boton"  title="" value="Eliminar"></td>	</tr>
</table>


<!--Boton agregar y tabla-->
<table  width="620" border="0" cellspacing="0" cellpadding="0"  align="center">
<tr><td  height=3 ></td></tr>	
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>	
<tr><td  height=3 ></td></tr>			
<tr valign="top"> 	<td  align="center" valign="top" ><?php MostrarTabla($conn); ?></td></tr>
<tr> <td  height="3" ></td></tr>
</table>
</td>
</tr>
</table>
<?    mysql_close($conn); 
$_SESSION[CbTabla]= "";
$_SESSION[CbAccion]= "";
$_SESSION[CbUsuario]= "";
$_SESSION[TxtFechaAD]= "";
$_SESSION[TxtFechaAH]= "";
$_SESSION[TxtConsulta]="";


?>
</Form>		

<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>
