<? 

function GLO_CbClienteTurno($campo,$criterio,$conn){//si dio de alta cmit y no asign usuario pongo buscador de RS
$idcombo=intval($_SESSION[$campo]);
//busco RSF de usuarios y usuariosclientes
$query1="SELECT 0 as Id,u.RSF,u.Usuario,u.FPago,u.SA,u.DiasSA,u.FechaSA FROM usuarios u Where usuario <>'ngrunmann@gmail.com' and u.Bloqueado=0 and u.RSF Like '%".$criterio."%'";
$query2="SELECT uc.Id,uc.RSF,uc.IdUsuario as Usuario,u.FPago,u.SA,u.DiasSA,u.FechaSA FROM usuariosclientes uc,usuarios u where uc.Id<>0 and uc.IdUsuario=u.Usuario and u.Bloqueado=0 and uc.RSF Like '%".$criterio."%'";
$query="Select uu.* From ($query1 UNION ALL $query2)uu Order by uu.RSF";$rs=mysql_query($query,$conn);
$combo='<option value=""></option>';
while($row=mysql_fetch_array($rs)){ 
	//valido sin alta / habilitado temporal
	$sinalta=$row['SA'];$habiltemp=0;
	if($sinalta==1){$habiltemp=GLO_TURSinAltaHT($row['FPago'],$row['SA'],$row['DiasSA'],$row['FechaSA']);}
	if($sinalta==0 or ($sinalta==1 and $habiltemp==1)){$combo .= " <option value='".$row['Id'].'|'.$row['Usuario']."'>".$row['RSF'].' ('.$row['Usuario'].')'."</option>\n"; }	 
}
echo $combo;
}


function GLO_ComboEstado(){
$combo="";
if( "99" == $_SESSION['CbEstado']) { $combo .= " <option value="."'99'"." selected='selected'>".""."</option>\n";}
else{$combo .= " <option value="."'99'"." >".""."</option>\n";}
if( "0" == $_SESSION['CbEstado']) { $combo .= " <option value="."'0'"." selected='selected'>"."SIN ATENDER"."</option>\n";}
else{$combo .= " <option value="."'0'"." >"."SIN ATENDER"."</option>\n";}
if( "1" == $_SESSION['CbEstado']) { $combo .= " <option value="."'1'"." selected='selected'>"."ATENDIDO"."</option>\n";}
else{$combo .= " <option value="."'1'"." >"."ATENDIDO"."</option>\n";}
if( "3" == $_SESSION['CbEstado']) { $combo .= " <option value="."'3'"." selected='selected'>"."ELIMINADO"."</option>\n";}
else{$combo .= " <option value="."'3'"." >"."ELIMINADO"."</option>\n";}

echo $combo;
}


function GLO_ComboFPago(){
$combo="";
if( "99" == $_SESSION['CbFP']) { $combo .= " <option value="."'99'"." selected='selected'>".""."</option>\n";}
else{$combo .= " <option value="."'99'"." >".""."</option>\n";}
if( "0" == $_SESSION['CbFP']) { $combo .= " <option value="."'0'"." selected='selected'>"."CONTADO"."</option>\n";}
else{$combo .= " <option value="."'0'"." >"."CONTADO"."</option>\n";}
if( "1" == $_SESSION['CbFP']) { $combo .= " <option value="."'1'"." selected='selected'>"."CTA.CTE"."</option>\n";}
else{$combo .= " <option value="."'1'"." >"."CTA.CTE"."</option>\n";}
echo $combo;
}

?>