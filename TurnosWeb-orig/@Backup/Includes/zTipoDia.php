<? 
//domingo?
if(date('w',strtotime($fecha))==0){$domingo=1;}else{$domingo=0;}
//sabado fuera de horario de atencion?
if(date('w',strtotime($fecha))==6 and ($horamin<540 or $horamin>615 )){$sabado=1;}else{$sabado=0;}
//horario no vigente hoy?
if((($horaminactual+$varminreserva)>$horamin) and (strtotime($fecha)==strtotime(date("d-m-Y")))){$horavieja=1;}else{$horavieja=0;}
//feriado?
$feriado=GLO_TURFeriado($fecha,$conn);		
	
	
//si es horario 08:00 lleva cantidad distinta de turnos ($horamin: hora en minutos)
$varturnos=$varturnosotros;
if($sabado==0 and $horamin==480){$varturnos=$varturnos8hs;}
//si es horario 07:45 lleva cantidad distinta de turnos
if($sabado==0 and $horamin==470){$varturnos=$varturnos750hs;}
//si es sobreturno lleva otra cantidda de turnos
if($j>$varhorarios){$varturnos=$varsobreturnos;}


//busco si hay turno disponible(y cuantos) no eliminado(estado<>3)
$ocupado=0;$cantdisp=$varturnos;
$query="Select Count(Id) as Cant From turnos Where Estado<>3 and IdAgenda=$varagenda and Fecha='".FechaMySql($fecha)."' and Hora='$hora'";
$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
if(mysql_num_rows($rs)!=0){if($row['Cant']>=$varturnos){$ocupado=1;$cantdisp=0;}
else{$cantdisp=$cantdisp-$row['Cant'];}}
mysql_free_result($rs);
		
?>