<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Turnos</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<? //encabezados con path
echo '<link rel="icon" href="'.$_SESSION["NivelArbol"].'favicon.ico" type="image/x-icon" />';
echo '<link rel="shortcut icon" href="'.$_SESSION["NivelArbol"].'favicon.ico" type="image/x-icon" />';

echo '<link href="'.$_SESSION["NivelArbol"].'Codigo/calendar/calendar.css" rel="stylesheet" type="text/css" />';
echo '<script language="javascript" src="'.$_SESSION["NivelArbol"].'Codigo/calendar/calendar.js"></script>';
echo '<script type="text/javascript" src="'.$_SESSION["NivelArbol"].'Codigo/jquery/jquery.js"></script>';
echo '<script type="text/javascript" src="'.$_SESSION["NivelArbol"].'Codigo/jquery/maskedinput.js"></script>';

//turnos plantilla web
echo '<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> ';
echo '<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">';
echo '<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700" rel="stylesheet">';

echo '<link rel="STYLESHEET" type="text/css" href="'.$_SESSION["NivelArbol"].'CSS/fontawesome/css/all.css">';	

//no guarda cache y refresca
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>

<script type="text/javascript">

/*fecha y hora*/
$(document).ready(function() { $("input[type=text][id*=time]").mask("99:99");});
$(document).ready(function() { $("input[type=text][id*=date]").mask("99-99-9999");});


/*entero*/
function validarEntero(valor){
	valor = parseInt(valor,10);
	if (isNaN(valor)) {
		alert('Por favor ingresar un numero entero') 
		return ""
	}else{
		return valor
	}

}


/*decimal*/
function validarNumero(valor){
	if (isNaN(valor)) {
		alert('Por favor ingresar un numero')
		return ""
	}else{
		return valor
	}
}

/* check color  */
function CheckRow(n,valor){	
		var elemento = document.getElementById(n);
		if(valor==1){elemento.style.backgroundColor="#e9efef";}else{elemento.style.backgroundColor="#ffffff";} 	
} 
function CheckTableRow(n,valor){
	for (var i=1;i < document.getElementById(n).rows.length;i++){	
		var elemento = document.getElementById(n).rows[i];
		if(valor==1 && elemento.id!=0){elemento.style.backgroundColor="#e9efef";}else{elemento.style.backgroundColor="#ffffff";} 	
	}
} 
function CheckMasivoColor(){	
	for (var i=0;i < document.Formulario.elements.length;i++){
		var elemento = document.Formulario.elements[i];
		if (elemento.type == "checkbox" && elemento.id!="ro"){
			elemento.checked = document.Formulario.ChkAll.checked;
			if (elemento.checked==1) {elemento.value=1;}else{elemento.value=0;}
			
		}
	}
	CheckTableRow("tshow",document.Formulario.ChkAll.value);		

} 


/*check*/
function CheckMasivo(){	
	for (var i=0;i < document.Formulario.elements.length;i++){
		var elemento = document.Formulario.elements[i];
		if (elemento.type == "checkbox"){elemento.checked = document.Formulario.ChkAll.checked;elemento.value = document.Formulario.ChkAll.value;}
	}
} 

function CheckMasivo2(){	
	for (var i=0;i < document.Formulario.elements.length;i++){
		var elemento = document.Formulario.elements[i];
		if (elemento.type == "checkbox"  && elemento.id == "5"){elemento.checked = document.Formulario.ChkAll.checked;elemento.value = document.Formulario.ChkAll.value;}
	}
} 



/*fecha*/
function validarFecha(Cadena){  
	if (Cadena!=""){
		 var Fecha= new String(Cadena)   
		 var RealFecha= new Date()  
	  
	  	if (Fecha.lastIndexOf("-")>0){
			 var Anio= new String(Fecha.substring(Fecha.lastIndexOf("-")+1,Fecha.length))   
			 var Mes= new String(Fecha.substring(Fecha.indexOf("-")+1,Fecha.lastIndexOf("-")))  
			 var Dia= new String(Fecha.substring(0,Fecha.indexOf("-"))) 
		 }else{		  
			 var Anio= new String(Fecha.substring(4)) 
			 var Mes= new String(Fecha.substring(2,4))
			 var Dia= new String(Fecha.substring(0,2))
		}

		 if (isNaN(Anio) || (Anio.length<4) || (parseFloat(Anio)<1900) || (Anio=='')){  
			 alert('Por favor ingresar formato ddmmyyyy')  
			 return ""  
		 }  
	 
		 if (isNaN(Mes) || parseFloat(Mes)<1 || parseFloat(Mes)>12 || (Mes=='')){  
			 alert('Por favor ingresar formato ddmmyyyy')  
			 return ""  
		 }  
	
		 if (isNaN(Dia) || parseInt(Dia, 10)<1 || parseInt(Dia, 10)>31  || (Anio=='')){  
			 alert('Por favor ingresar formato ddmmyyyy')  
			 return ""  
		 }  
		 if (Mes==4 || Mes==6 || Mes==9 || Mes==11) {  
			 if (Dia>30) {  
				 alert('Por favor ingresar formato ddmmyyyy')  
				 return ""  
			 }  
		 } 
		 if (Mes==2) {  
			 if (Dia > 29) {  
				 alert('Por favor ingresar formato ddmmyyyy')  
				 return ""  
			 } 
			 if ((Anio % 4 == 0) && ((Anio % 100 != 0) || (Anio % 400 == 0))){var Bisiesto=1;}else{var Bisiesto=0;}		
			 if (Dia == 29 && Bisiesto==0) {  
				 alert('Por favor ingresar formato ddmmyyyy')  
				 return ""  
			 } 
		 } 
		return Dia + "-" + Mes + "-" + Anio
	}
	else{
		return ""
	}
 }  



</script>