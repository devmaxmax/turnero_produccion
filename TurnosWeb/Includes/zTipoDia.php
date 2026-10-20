<? 
//domingo?
if(date('w',strtotime($fecha))==0){$domingo=1;}else{$domingo=0;}
//sabado fuera de horario de atencion?  
if(date('w',strtotime($fecha))==6 and ($horamin<GLO_horainicioS() or $horamin>GLO_horafinS() )){$sabado=1;}else{$sabado=0;}
//es sabado dentro del horario de atencion?
if(date('w',strtotime($fecha))==6 and ($sabado==0)){$essabadook=1;}else{$essabadook=0;}
//horario no vigente hoy?
if((($horaminactual+$varminreserva)>$horamin) and (strtotime($fecha)==strtotime(date("d-m-Y")))){$horavieja=1;}else{$horavieja=0;}
//feriado?
$feriado=GLO_TURFeriado($fecha,$conn);		
	
	
//si algun horario lleva cantidad distinta de turnos ($horamin: hora en minutos)
$varturnos=$varturnosotros;
//si es sabado
if($essabadook==1){$varturnos=$varturnossabados;}



//si es lunes a viernes 07:45 lleva cantidad distinta de turnos
if($sabado==0 and $horamin==465){$varturnos=8;}//7.45
if($sabado==0 and $horamin==480){$varturnos=8;}//8
if($sabado==0 and $horamin==495){$varturnos=8;}//8.15
if($sabado==0 and $horamin==510){$varturnos=6;}//8.30
if($sabado==0 and $horamin==525){$varturnos=6;}//8.45
if($sabado==0 and $horamin==540){$varturnos=6;}//9
if($sabado==0 and $horamin==555){$varturnos=6;}//9.15
if($sabado==0 and $horamin==570){$varturnos=6;}//9.30
if($sabado==0 and $horamin==585){$varturnos=6;}//9.45
if($sabado==0 and $horamin==600){$varturnos=6;}// 10.0
if($sabado==0 and $horamin==615){$varturnos=7;}// 10.15
if($sabado==0 and $horamin==630){$varturnos=7;}// 10.30
if($sabado==0 and $horamin==645){$varturnos=7;}// 10.45
if($sabado==0 and $horamin==660){$varturnos=8;}// 11
if($sabado==0 and $horamin==675){$varturnos=9;}// 11.15
if($sabado==0 and $horamin==690){$varturnos=9;}// 11.30
if($sabado==0 and $horamin==705){$varturnos=9;}// 11.45






//SAbados
if($essabadook==1 and $horamin==585){$varturnos=$varturnoss5t;}
if($essabadook==1 and $horamin==600){$varturnos=6;}
if($essabadook==1 and $horamin==615){$varturnos=$varturnoss5t;}
if($essabadook==1 and $horamin==630){$varturnos=$varturnoss5t;}
if($essabadook==1 and $horamin==645){$varturnos=$varturnoss5t;}


//si es lunes a viernes 13:00 lleva cantidad distinta de turnos
//if($sabado==0 and $horamin==780){$varturnos=$varturnos1t;}
//si es lunes a viernes 13:15 lleva cantidad distinta de turnos
//if($sabado==0 and $horamin==795){$varturnos=$varturnos1t;}


//si es sobreturno lleva otra cantidda de turnos
if($sabado==0 and $horamin==825){$varturnos=$varsobreturnos;}//Ajuste Lucas por error en agregar sobre turnos
if($j>$varhorarios){$varturnos=$varsobreturnos;}


//busco si hay turno disponible(y cuantos) no eliminado(estado<>3)
$ocupado=0;$cantdisp=$varturnos;
$query="Select Count(Id) as Cant From turnos Where Estado<>3 and IdAgenda=$varagenda and Fecha='".FechaMySql($fecha)."' and Hora='$hora'";
$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
if(mysql_num_rows($rs)!=0){if($row['Cant']>=$varturnos){$ocupado=1;$cantdisp=0;}
else{$cantdisp=$cantdisp-$row['Cant'];}}
mysql_free_result($rs);
		
?>