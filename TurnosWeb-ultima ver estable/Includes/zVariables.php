<? 

//variables
$varminreserva=30;

//cantidad turnos simultaneos
$varturnos=5;$varturnosotros=5;//defaul 
$varturnossabados=9;//sabados  decia 3
//otros horarios lunes a viernes
$varturnos745hs=10;//(7:45 lunes a viernes)
$varturnoss10hs=5;//(7:45 lunes a viernes)
$varturnos8hs=12;//(8:00 lunes a viernes )
$varturnos815hs=7;//(8:15  lunes a viernes )
$varturnos13hs=1;//(13:00  lunes a viernes )
//sobreturnos
$varsobreturnos=20;//sobreturnos, muestra al final


//cantidad de horarios x dia
$varhorarios=24;//(antes 2/11/20 $varhorarios=20;)

//sobreturnos
$varhorast=GLO_horasobreturno();
$varhorariosst=$varhorarios+1;

?>