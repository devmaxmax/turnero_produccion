<? if ($_SESSION["IdPerfilUser"]!=1 and $_SESSION["IdPerfilUser"]!=2 and $_SESSION["IdPerfilUser"]!=3 and $_SESSION["IdPerfilUser"]!=10){ header("Location:".$_SESSION["NivelArbol"]."TurnosWebCMIT.php");}


function CLI_MostrarTablaRS($idpadre,$conn){ 
$query="SELECT * From usuariosclientes where Id<>0 and IdUsuario='$idpadre' Order by RSF";$rs=mysql_query($query,$conn);
//Titulos de la tabla
$tablaclientes="";
$tablaclientes .=GLO_inittabla(700,1,0,0);
$tablaclientes .="<td "."width="."490"." class="."TableShowT"."> Razón Social</td>";   
$tablaclientes .="<td "."width="."140"." class="."TableShowT"."> CUIT</td>";  
$tablaclientes .="<td width="."70"." class="."TableShowT"."> </td>"; 
$tablaclientes .=" </tr> ";             
$recuento=0;  
while($row=mysql_fetch_array($rs)){ 	
	$clickeliminar="'Eliminar ".substr($row['RSF'],0,25)."'";
	$tablaclientes .=" <tr> ";  
	$tablaclientes .="<td class="."TableShowD"."> ".substr($row['RSF'],0,55)."</td>"; 
	$tablaclientes .="<td class="."TableShowD"."> ".substr($row['CUITF'],0,20)."</td>"; 
	$tablaclientes .="<td  class="."TableShowD"." style='text-align:right;'>";
	$tablaclientes .='<button name="CmdVerRS" type="submit"  class="iconbtn2"  value="Ver" id="'.$row['Id'].'" onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';"><i class="fas fa-edit iconsmallbt iconlgray"></i></button> <button name="CmdBorrarRS" type="submit"  class="iconbtn2"  value="Borrar" id="'.$row['Id'].'" onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".';return confirm('.$clickeliminar.');"><i class="fas fa-trash iconvsmall iconlgray"></i></button>';	  
	$tablaclientes .="</td>";  
	$tablaclientes .=" </tr> "; 
	$recuento=$recuento+1;
}mysql_free_result($rs);	
$tablaclientes .=GLO_fintabla(0,0,$recuento);
echo $tablaclientes;	
}

?>


