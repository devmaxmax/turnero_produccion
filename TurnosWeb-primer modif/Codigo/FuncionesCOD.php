<? 


//mensajes
function GLO_feedback($tipo){
	switch ($tipo) {
	case 1:
		$_SESSION['GLO_msgC']="Los cambios se grabaron correctamente";break;
	case 2:
		$_SESSION['GLO_msgE']="Los cambios no se grabaron";break;
	case 3:
		$_SESSION['GLO_msgE']="Por favor complete los campos requeridos";break;
	case 4:
		$_SESSION['GLO_msgE']="Por favor revise el CUIT";break;
	case 5:
		$_SESSION['GLO_msgE']="La clave actual no es correcta";break;
	case 6:
		$_SESSION['GLO_msgE']="La clave y su confirmacion no coinciden";break;
	case 7:
		$_SESSION['GLO_msgE']="La clave debe tener 8 caracteres";break;
	case 8:
		$_SESSION['GLO_msgE']="La clave debe tener al menos un caracter numerico";break;
	case 9:
		$_SESSION['GLO_msgE']="La clave debe tener al menos una letra";break;
	case 10:
		$_SESSION['GLO_msgE']="Por favor verifique las fechas";break;
	case 11:
		$_SESSION['GLO_msgE']="Por favor verifique la disponibilidad para el periodo";break;
	case 12:
		$_SESSION['GLO_msgE']="Por favor elimine primero los items asociados";break;
	case 13:
		$_SESSION['GLO_msgE']="El Codigo ya existe";break;
	case 14:
		$_SESSION['GLO_msgE']="Ya existe el documento. Las nuevas versiones deben generarse desde el documento";break;
	case 15:
		$_SESSION['GLO_msgC']="El mail fue enviado correctamente";break;
	case 16:
		$_SESSION['GLO_msgE']="El mail no pudo enviarse";break;
	case 17:
		$_SESSION['GLO_msgE']="Por favor aplique algun filtro de busqueda";break;
	case 18:
		$_SESSION['GLO_msgE']="El registro no se grabo. Ya existe";break;
	case 19:
		$_SESSION['GLO_msgC']="Los cambios se grabaron. Por favor complete el nuevo nombre";break;
	case 20:
		$_SESSION['GLO_msgC']="Los Pagos a Cuenta no son suficientes para armar el Paquete";break;
	case 21:
		$_SESSION['GLO_msgE']="Existe otro registro con ese CUIT/DNI";break;
	case 22:
		$_SESSION['GLO_msgE']="Por favor seleccione Tipo de IVA";break;
	case 23:
		$_SESSION['GLO_msgE']="Por favor NO seleccione Tipo de IVA";break;
	case 24:
		$_SESSION['GLO_msgE']="El Numero de cheque no pertenece a esta chequera";break;
	case 25:
		$_SESSION['GLO_msgE']="Por favor seleccione un lote menor o igual a 100 cheques";break;
	case 26:
		$_SESSION['GLO_msgE']="Por favor agregue una Orden de Compra";break;
	case 27:
		$_SESSION['GLO_msgE']="No existen datos que cumplan esos criterios";break;
	case 28:
		$_SESSION['GLO_msgE']="EL CUIT YA EXISTE, confirma que desea CREARLO?";break;
	case 29:
		$_SESSION['GLO_msgE']="No se grabo. El Turno fue ocupado en el ultimo minuto";break;
		
	}
}


function GLO_mensajeerror(){
echo '<table  width="100%" border="0" cellspacing="0" cellpadding="0" >';
echo '<tr align="center"> <td align="center" class="MuestraError" style="font-size:14px">'; if (!(empty($_SESSION['GLO_msgE']))){echo '<i class="fas fa-exclamation-circle iconvsmallsp"></i> '.$_SESSION['GLO_msgE'];} echo '</td> </tr>';
echo '<tr align="center"> <td align="center" class="MuestraConf" >'; if (!(empty($_SESSION['GLO_msgC']))){echo '<div class="alert-success"><i class="fas fa-check-circle iconvsmallsp"></i> '.$_SESSION['GLO_msgC'];} echo '</div></td> </tr>';
echo '</table>';
}

function GLO_mensajeerrorE(){
echo '<table  width="100%" border="0" cellspacing="0" cellpadding="0">';
echo '<tr align="center"> <td align="center" class="MuestraError" style="font-size:14px">'; if (!(empty($_SESSION['GLO_msgE']))){echo '<i class="fas fa-exclamation-circle iconvsmallsp"></i> '.$_SESSION['GLO_msgE'];} echo '</td> </tr>';
echo '</table>';
}




//html
function GLO_InitHTML($arbol,$body,$banner,$form,$tform,$v1,$v2,$v3){
	include ($arbol."Codigo/HeadFull.php");
    echo '<link rel="STYLESHEET" type="text/css" href="'.$arbol.'CSS/Estilo.css">';
	GLO_bodyform($body,0,0);
	include ($arbol."Codigo/".$banner.".php");
	GLO_formform('Formulario',$form.'.php',$tform,0,0);
}

function GLO_bodyform($campo,$flag1,$flag2){
if($campo==''){$onload='';}else{$onload='onLoad="document.forms['."'Formulario'"."]['".$campo."'].focus()".'"';}
echo '</head>';
echo '<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" '.$onload.'>';
}

function GLO_formform($name,$action,$flag1,$flag2,$flag3){
if($flag1==1){$keypress='onKeyPress="if (event.which == 13 || event.keyCode == 13){return false;}"';}else{$keypress='';}
if($flag2==1){$enctype='enctype="multipart/form-data"';}else{$enctype='';}
echo '<form name="'.$name.'" action="'.$action.'" method="post" '.$keypress.' '.$enctype.'>'; 
}


//titulo page
function GLO_tituloypath($w1,$w2,$ruta,$titulo,$tipo){
	echo '<table width="100%" border="0"  cellpadding="0" cellspacing="0"><tr> <td height="8"></td></tr><tr><td align="center">';
	echo '<table width="'.$w2.'" border="0"  cellpadding="0" cellspacing="0" class="fondo" >';
	echo '<tr > <td width="30%" class="ruta"></td><td height="20" align="center" valign="bottom" class="Titulo"width="40%" >'.$titulo.'</td><td width="30%" align="right">';
	//opciones
	switch ($tipo) {
		case 'basica':	echo '<input name="CmdAgregar" type="submit" class="boton"  title="Agregar" value="Agregar"> <button name="CmdSalir" type="submit" class="iconbtn"> <i '.GLO_IconSalir().'></i></button>'; break;
		case 'close':	echo '<i '.GLO_IconSalir().' onClick="window.close();"></i>'; break;
		case 'salir':	echo '<i '.GLO_IconSalir().' onClick="document.Formulario.target='."'_self'".';document.Formulario.CmdSalir.click();"  ></i>'; break;
		//ahorro peticiones
		case 'linksalir':	echo '<i '.GLO_IconSalir().' onClick="document.Formulario.target='."'_self'".';window.location.href='."'".$ruta."'".'"></i>'; break;	
	}	
	//fin opciones	
	echo '</td></tr><tr> <td height="3"></td></tr></table> ';
}



//cierra page
function GLO_cierratablaform(){
echo '<input name="CmdLinkRow"  type="submit" style="visibility:hidden" value="" >'; //click modificar fila tabla
echo '<input name="CmdLinkRow1" type="submit" style="visibility:hidden" value="" >'; //click modificar fila tabla
echo '<input name="CmdLinkRow2" type="submit" style="visibility:hidden" value="" >'; //click modificar fila tabla
echo '<input name="CmdLinkRow3" type="submit" style="visibility:hidden" value="" >'; //click modificar fila tabla
echo '<input name="CmdLinkRow4" type="submit" style="visibility:hidden" value="" >'; //click modificar fila tabla
echo '<input name="CmdLinkRow5" type="submit" style="visibility:hidden" value="" >'; //click modificar fila tabla
echo '<input name="CmdSalir"  	type="submit" style="visibility:hidden" value="">';//click botn salir GLO_tituloypath
echo '<input name="GLO_getid"   type="hidden" value="'; echo $_SESSION['GLO_getid'];  echo '" >';
echo '<input name="GLO_getidp"  type="hidden" value="'; echo $_SESSION['GLO_getidp']; echo '" >';
echo '<input name="GLO_getidf"  type="hidden" value="'; echo $_SESSION['GLO_getidf']; echo '" >';
echo '</td></tr></table>';
echo '</Form>';
}



//buttons
function GLO_botonesform($w1,$flag1,$flag2){//flag1: 'Guardar' (0 muestra,1 oculta),flag2: 'Cerrar' (0 muestra,1 close, 2 oculta)
	echo '<table width="'.$w1.'" border="0"   cellspacing="0" class="Tabla TMT" >'; 
	echo '<tr> <td height="5"  ></td></tr><tr><td height="18"  align="center">';
	if($flag1==0){echo '<input name="CmdAceptar" type="submit" class="boton"  value="Guardar" onClick="document.Formulario.target='."'_self'".'">';}
	if($flag2==0){echo '&nbsp;&nbsp;<input name="CmdCancelar" type="submit" class="boton"  value="Cerrar" onClick="document.Formulario.target='."'_self'".'">';}
	if($flag2==1){echo '&nbsp;&nbsp;<input name="CmdCancelar"  type="button" class="boton"  value="Cerrar" onClick="window.close();">';}
	echo '</td> </tr></table>'; 
	}



//tabla
function GLO_linkbutton($w,$n1,$l1,$n2,$l2,$n3,$l3){
echo '<table  width="'.$w.'" border="0" cellspacing="0" cellpadding="0" >
<tr><td  height=3 ></td></tr>
<tr><td align="left" valign="bottom" >
<input name="Cmd'.$n1.'" type="button" class="boton" value="'.$n1.'" onClick="document.Formulario.target='."'_self'".';window.location.href='."'".$l1."'".'">';
if($n2!=''){echo ' <input name="Cmd'.$n2.'" type="button" class="boton" value="'.$n2.'" onClick="document.Formulario.target='."'_self'".';window.location.href='."'".$l2."'".'">';}
if($n3!=''){echo ' <input name="Cmd'.$n3.'" type="button" class="boton" value="'.$n3.'" onClick="document.Formulario.target='."'_self'".';window.location.href='."'".$l3."'".'">';}
echo '</td></tr></table>';
}



function GLO_inittabla($w,$v1,$v2,$v3){//$v1=1 TShow
	$texto='<table  width="'.$w.'" border="0" cellspacing="0" cellpadding="0" ><tr> <td  height="3" ></td></tr><tr valign="top"><td  align="center" valign="top" >';
	if($v1==0){$texto .='<table width="'.$w.'" border="0" cellspacing="0" cellpadding="0"><tr>';}
	if($v1==1){$texto .='<table width="'.$w.'" class="TableShow" id="tshow"><tr>';}//TShow
	return $texto;
}


function GLO_fintabla($v1,$v2,$v3){///ojo cmdexcel 90px en turnos!!!
	//nombre
	$nombre=' registros';
	if($v2==1){$nombre=' examenes';}
	//recuento
	$texto='</table></td></tr>';	
	if($v3!=0){$texto .='<tr><td class="comentario" style="vertical-align:top;text-align:right;">'.$v3.$nombre.'</td></tr>';}
	else{$texto .='<tr><td  height=5 ></td></tr>';}
	//botones
	if($v1==1){$texto .='<tr><td align="right">'.GLO_FAButton('CmdExcel','submit','90','self','Exportar','excel','').'</td></tr>';}
	if($v1==2){$texto .='<tr><td align="right">'.GLO_FAButton('CmdExcel','submit','90','self','Exportar','excel','').' '.GLO_FAButton('CmdExcel2','submit','90','self','Detalle','excel','').'</td></tr>';}
	$texto .='<tr><td  height=5 ></td></tr></table>';
	return $texto;
}


//coment
function GLO_initcomment($w,$v1){
	echo '<table  width="'.$w.'" border="0" cellspacing="0" cellpadding="0" ><tr><td class="comentario" style="line-height:1.4rem;">';
}
function GLO_endcomment(){
	echo '</td></tr></table>';
}


//hidden
function GLO_Hidden($campo,$v1){
echo '<input name="'.$campo.'" type="hidden" value="'; echo $_SESSION[$campo];  echo '" >';
}



//buttons
function GLO_Search($campo,$v1){
echo '<button name="'.$campo.'" type="submit" class="iconbtn2" value="" onClick="document.Formulario.target='."'_self'".';"><i class="fa fa-search iconsmallbt iconblue2"></i></button>';
}

function GLOF_Search($campo,$v1){//ojo boton solo de turnos
	echo GLO_FAButton('CmdBuscar','submit','80','self','Buscar','lupa','');
}

function GLO_IconSalir(){ return 'class="fas fa-arrow-left iconmedium iconblue"';}
function GLO_highlight($id){ return ' id="'.$id.'" onmouseover="CheckRow('.$id.',1);" onmouseout="CheckRow('.$id.',0);"';}

//check
function GLO_CheckColor($texto,$check,$v1){
	if(intval($check)==0){echo '<label style="border:none;">'.$texto.'</label>';}
	else{echo '<label style="border: none;color:#f44336;">'.$texto.'</label>';}
}


//awasome es distinto al resto en turnos!!!
function GLO_FAButton($name,$type,$width,$target,$texto,$icon,$classb){
	//variables
	if($classb==''){$classb='botonlog';}
	//icon
	switch ($icon) {
		case 'excel':  $class='far fa-file-excel'; break;
		case 'mail':   $class='fas fa-envelope'; break;
		case 'unlock': $class='fas fa-unlock'; break;
		case 'lock': $class='fas fa-lock'; break;
		case 'print': $class='fas fa-file-pdf'; break;
		case 'file': $class='far fa-file'; break;
		case 'lupa': $class='fas fa-search'; break;
		case 'pago': $class='fas fa-dollar-sign'; break;
		case 'load': $class='fas fa-redo'; break;
		case 'cross': $class='fas fa-times-circle'; break;
		case 'save': $class='fas fa-save'; break;
		case 'user': $class='fas fa-user'; break;
		case 'bill': $class='fas fa-money-check'; break;
		case 'medrx': $class='fas fa-file-prescription'; break;
		case 'medfile': $class='fas fa-file-medical'; break;
		case 'medcom': $class='fas fa-comment-medical'; break;
		case 'clock': $class='far fa-clock'; break;
		case 'flag': $class='far fa-flag'; break;
		case 'calc': $class='fas fa-calculator'; break;
		case 'cart': $class='fas fa-shopping-cart'; break;
		case 'stock': $class='fas fa-dolly-flatbed'; break;
		case 'folder': $class='fas fa-folder-open'; break;
		case 'key': $class='fas fa-key'; break;
	}		
	//escribe button
	return '<button name="'.$name.'" type="'.$type.'" class="'.$classb.'"  style="width:'.$width.'px;" onClick="document.Formulario.target='."'_".$target."'".'"><i class="'.$class.' iconsmall"></i> '.$texto.'</button>';
}


//////////////////////NEW//////////////////////////////////////////////
//form
function GLOF_init($body,$banner,$form,$tform,$menuh,$v1,$v2,$v3){
	//head
	include ($_SESSION["NivelArbol"]."Codigo/HeadFull.php");
    echo '<link rel="STYLESHEET" type="text/css" href="'.$_SESSION["NivelArbol"].'CSS/Estilo.css">';
	if($body==''){$onload='';}else{$onload='onLoad="document.forms['."'Formulario'"."]['".$body."'].focus()".'"';}
	echo '</head>';
	//body
	echo '<body leftmargin="0" height="100%"  topmargin="0" marginwidth="0" marginheight="0" '.$onload.'>'; 
	include ($_SESSION["NivelArbol"]."Codigo/".$banner.".php");
	if($menuh!=''){$menuh=$menuh.'.php';include($menuh);}
	//form
	if($form!=''){$form=$form.'.php';}
	if($tform==1){$keypress='onKeyPress="if (event.which == 13 || event.keyCode == 13){return false;}"';}else{$keypress='';}
	echo '<form name="Formulario" action="'.$form.'" method="post" '.$keypress.'>'; 
}


//buttons
function GLOF_buttonpanel($class,$value,$onclick,$v1,$v2,$v3){
	echo '<input name="Cmd" type="button" class="'.$class.'" value=" '.$value.'" onClick="window.location.href='."'".$onclick."'".';">';
}


?>