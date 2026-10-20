<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";

//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT2.php");}




$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);



function MostrarTabla($conn){
$query=$_SESSION[TxtConsultaCli];$query=str_replace("\\", "", $query);
if ( ($query!="")){
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		//Titulos de la tabla		
		$tablaclientes="";
		$tablaclientes .="<table width="."970"." border="."0"." cellspacing="."0"." cellpadding="."0"." >";
		$tablaclientes .="<tr><td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."200"." class="."TablaTituloDato"."> Usuario</td>";  
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."280"." class="."TablaTituloDato"."> Nombre</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."270"." class="."TablaTituloDato"."> Razón Social</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."100"." class="."TablaTituloDato"."> CUIT</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."50"." class="."TablaTituloDato"."> Pago</td>"; 
		$tablaclientes .="<td class="."TablaTituloLeft"."> </td>"; 
		$tablaclientes .="<td "."width="."60"." class="."TablaTituloDato"."></td>"; 
		$tablaclientes .="<td class="."TablaTituloRight"."> </td>";  
		$tablaclientes .=" </tr> ";    
		$recuento=0;          
		while($row=mysql_fetch_array($rs)){
			$clickeliminar="'Eliminar Usuario ".substr($row['Usuario'],0,15)."'";	
			$clickclave="'Cambiar clave Usuario ".substr($row['Usuario'],0,15)."'";	
			if($row['FPago']==0){$fpago='Ctdo';}else{$fpago='CC';}
			if ($row['Bloqueado']==0){$clase="TablaDato";}else{$clase="TablaDatoR";}
			$tablaclientes .=" <tr> ";
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".substr($row['Usuario'],0,40)."</td>";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".substr($row['Apellido'].' '.$row['Nombre'],0,30)."</td>"; 
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase."> ".substr($row['RSF'],0,30)."</td>";  			
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
			$tablaclientes .="<td class=".$clase."> ".substr($row['CUITF'],0,15)."</td>";  
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>";  
			$tablaclientes .="<td class=".$clase."> ".$fpago."</td>";  			
			$tablaclientes .="<td class="."TablaMostrarLeft"."> </td>"; 
			$tablaclientes .="<td class=".$clase." style='text-align:right;'>"; 
			$tablaclientes .='<input name="CmdVer" type="submit" class="botonlupa"   value="" title="Ver" id="'.$row['Usuario'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'"> ';
			$tablaclientes .='<input name="CmdBorrar" type="submit" class="botonborrar"   value="" title="Borrar" id="'.$row['Usuario'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');"> ';
	$tablaclientes .='<input name="CmdClave" type="submit" class="botonclave"   value="" title="Clave" id="'.$row['Usuario'].'"  onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickclave.');">';
			$tablaclientes .="</td><td class="."TablaMostrarRight"."> </td>";  
			$tablaclientes .=" </tr> "; 
			$recuento=$recuento+1;
		}	
		//Cerrar tabla
		$tablaclientes .="</table>"; 
		$tablaclientes .="<p class="."recuento"." align="."right"."> $recuento clientes</p>"; 
		$tablaclientes .='<table align="right" ><tr> <td></td></tr><tr><td><input name="CmdExcel"  type="submit" class="botonexcel"  value="" onClick="document.Formulario.target='."'_self'".'"></td></tr></table>';
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center">No existen datos</p>';}
	//Cierra consulta
	mysql_free_result($rs);
	
}
}


function ComboFPago(){
$combo="";
if( "99" == $_SESSION[CbFP]) { $combo .= " <option value="."'99'"." selected='selected'>".""."</option>\n";}
else{$combo .= " <option value="."'99'"." >".""."</option>\n";}
if( "0" == $_SESSION[CbFP]) { $combo .= " <option value="."'0'"." selected='selected'>"."CONTADO"."</option>\n";}
else{$combo .= " <option value="."'0'"." >"."CONTADO"."</option>\n";}
if( "1" == $_SESSION[CbFP]) { $combo .= " <option value="."'1'"." selected='selected'>"."CONTADO Y CTA.CTE"."</option>\n";}
else{$combo .= " <option value="."'1'"." >"."CONTADO Y CTA.CTE"."</option>\n";}
echo $combo;
}





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">-->
<html>
<head>
<? include ("Codigo/Head.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css">
<meta http-equiv="REFRESH" content="300"> 
</head>



<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="document.forms['Formulario']['CmdBuscar'].focus()">
<? include ("Codigo/BannerConMenuHVCMIT.php");?>

<form  name="Formulario" action="Clientes/zConsulta.php" method="post">
<table width="100%" border="0"  cellpadding="0" cellspacing="0"   >
<tr> <td height="5"></td></tr>
<tr > <td align="right" valign="top" ></td></tr>						
<tr><td align="center">
<table width="980" border="0"  cellpadding="0" cellspacing="0" class="fondo" >
<tr > <td height="20" align="center" valign="bottom" class="Titulo" >USUARIOS DE CLIENTES REGISTRADOS</td></tr>
</table>


<table width="880" border="0"  cellpadding="0" cellspacing="0" class="Tabla" >
<tr> <td height="5" width="70"></td><td width="100"></td><td width="110"></td><td width="70"></td><td width="170"></td><td width="260"></td><td width="100"></td></tr>
<tr> <td height="18"  align="right">Empresa:</td><td  colspan="2" >&nbsp;<input name="TxtBusqueda" type="text" class="TextBox" style="width:170px" maxlength="20" onKeyDown="enterxtab(event)"></td><td height="18" align="right">F.Pago:</td><td >&nbsp;<select name="CbFP" class="campos" id="CbEstado"  style="width:130px" onKeyDown="enterxtab(event)"><? ComboFPago(); ?></select></td><td ><input name="ChkBloq"  type="checkbox"  value="1" > Bloqueados &nbsp;&nbsp;&nbsp;<input name="ChkBloqAA"  type="checkbox"  value="1" > Bloq. por Alta Usuario</td><td   align="right" ><input  name="TxtId"  type="hidden"  value="<? echo $_SESSION[TxtId]; ?>"><input  name="TxtConsultaCli"  type="hidden"   value="<? echo $_SESSION[TxtConsultaCli]; ?>"><input name="CmdBuscar"  type="submit" class="botonbuscarG"  value="" onClick="document.Formulario.target='_self'">&nbsp;<input name="CmdSalir"  type="submit" class="botonsalirG"   value="" onClick="document.Formulario.target='_self'">&nbsp;
</td></tr>
<tr><td  height=3 ></td></tr>
</table>

<table  width="880" border="0" cellspacing="0" cellpadding="0" >
<tr><td  height=3 ></td></tr>
<tr><td><input name="CmdAgregar" type="submit" class="boton"  value="Agregar" onClick="document.Formulario.target='_self'"> <input name="CmdEmpresas" type="submit" class="boton"  value="Empresas" onClick="document.Formulario.target='_self'"></td></tr>
</table>


<table  width="970" border="0" cellspacing="0" cellpadding="0" >
<tr  valign="bottom"><td align="left" valign="bottom" ></td>	</tr>
<tr align="center"> <td align="center" class="MuestraError" > <?php echo $_GET['msgE']; ?> </td> </tr>
<tr align="center"> <td align="center" class="MuestraConf" > <?php echo $_GET['msgC']; ?> </td> </tr>
<tr><td  height=3 ></td></tr>
<tr valign="top"> 	<td  align="center" valign="top" > 	<?php MostrarTabla($conn); ?>	</td>	</tr>
</table>


</td></tr>      
</table>
<? mysql_close($conn);

$_SESSION[TxtId]=""; 
$_SESSION[TxtBusqueda]="";
$_SESSION[CbFP]="";
$_SESSION['ChkBloq']="";
$_SESSION['ChkBloqAA']="";
?>
</Form>		
<!-- Comentario-->
<table  width="920" border="0" cellspacing="0" cellpadding="0"  >
<tr><td class="comentario1">
Muestra los Usuarios registrados.<br>
La Empresa que se muestra es la principal, las empresas adjuntas pueden consultarse haciendo click en <font class="comentario3">Empresas</font>.<br>
Los Usuarios con Forma de Pago <font class="comentario2">Cuenta Corriente</font> podrán optar por abonar Contado o Cuenta Corriente.<br>
Los Usuarios con Forma de Pago <font class="comentario3">Contado</font> sólo podrán pagar Contado anticipado al envio del paciente.
</td></tr>
</table>
<!-- fin Comentario-->


<? include ("Codigo/FooterConUsuario.php");?>
</body>
</html>
