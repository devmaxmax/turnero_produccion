<? include("Codigo/SeguridadCMIT.php") ;include("Codigo/Config.php") ;include("Codigo/Funciones.php") ;$_SESSION["NivelArbol"]="";require_once('Codigo/calendar/classes/tc_calendar.php');
//perfiles
if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=4 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}

//completa fecha por defecto
if (empty($_SESSION['TxtFechaD'])){
	$hoy=date("d-m-Y"); list($d,$m,$a)=explode("-",$hoy);
	$primerdiames="01-01-".$a;$ultimodiames="31-12-".$a;
	$_SESSION['TxtFechaD']=date("d-m-Y", strtotime("$primerdiames -0 month"));
	$_SESSION['TxtFechaH']=date("d-m-Y", strtotime("$ultimodiames -0 month"));
	
}

$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);

function MostrarTabla($conn){
$query=$_SESSION['TxtQFERIADOS'];$query=str_replace("\\", "", $query);
if (  ($query!="")){	
	$rs=mysql_query($query,$conn);
	if(mysql_num_rows($rs)!=0){	
		$tablaclientes="";
		$tablaclientes .=GLO_inittabla(500,1,0,0);
		$tablaclientes .="<td "."width="."70"." class="."TableShowT"."> Fecha</td>";   
		$tablaclientes .="<td "."width="."300"." class="."TableShowT"."> Nombre</td>";   
		$tablaclientes .="<td "."width="."100"." class="."TableShowT"."> Dia</td>";   
		$tablaclientes .="<td "."width="."30"." class="."TableShowT"."></td>";   
		$tablaclientes .=" </tr> ";    
		$recuento=0; $estilo=" style='cursor:pointer;'"; $clase="TableShowD";        
		while($row=mysql_fetch_array($rs)){ 
			$link=" onclick="."location='Feriados/Modificar.php?Flag1=True&id=".$row['Id']."'";
			//muestro
			$tablaclientes .=" <tr".$estilo."> ";  
			$tablaclientes .="<td class=".$clase.$link."> ".GLO_FormatoFecha($row['Fecha'])."</td>"; 
			$tablaclientes .="<td class=".$clase.$link."> ".substr($row['Nombre'],0,40)."</td>"; 
			$tablaclientes .="<td class=".$clase.$link."> ".substr(ObtenerDiaSemana($row['Fecha']),0,20)."</td>"; 
			$tablaclientes .="<td class="."TableShowD"." style='text-align:center;'>".'<button name="CmdBorrarFila" type="submit"  class="iconbtn2" title="Eliminar" value=""  id="'.$row['Id'].'"  onclick="document.Formulario.TxtId.value=this.id;return confirm('."'Eliminar'".');"><i class="fas fa-trash iconsmallbt iconlgray"></i></button>'. "</td>";  
			$tablaclientes .=" </tr> "; 
			$recuento=$recuento+1;
		}	
		$tablaclientes .=GLO_fintabla(1,0,$recuento);
		echo $tablaclientes;	
	}else{echo '<p class="MuestraConf" align="center">No existen datos que cumplan esos criterios</p>';}
	mysql_free_result($rs);
}
}



GLO_InitHTML($_SESSION["NivelArbol"],'TxtFechaD','BannerConMenuHVCMIT','Feriados/zFeriados',0,0,0,0);
GLO_tituloypath(0,500,'InicioCMIT.php','FERIADOS','linksalir'); 
?>


<table width="500" border="0"  cellspacing="0" class="Tabla" >
<tr><td  height=3 width="155" ></td><td  height=3 width="105"></td><td  height=3 width="130"></td><td  height=3 width="10"></td><td  height=3 width="30"></td><td  height=3 width="70"></td></tr>
<tr><td  align="right" >Fecha Inicio:</td><td  >&nbsp;<?php  GLO_calendario("TxtFechaD","Codigo/","actual",1); ?></td><td  > al&nbsp; <?php  GLO_calendario("TxtFechaH","Codigo/","actual",1); ?></td><td  align="right" colspan="3"><? GLOF_Search('CmdBuscar',0); ?>&nbsp;</td></tr>
</table>


<?
GLO_Hidden('TxtId',0);GLO_Hidden('TxtQFERIADOS',0);
GLO_linkbutton(500,'Agregar','Feriados/Alta.php','','','','');
GLO_mensajeerror();
MostrarTabla($conn); 
mysql_close($conn);
GLO_cierratablaform();
include ("Codigo/FooterConUsuario.php");
?>