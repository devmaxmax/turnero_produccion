<? 

//variables
$varminreserva=30;

//cantidad turnos simultaneos
$varturnos=5;
$varturnosotros=5;//defaul 
$varturnossabados=7;//sabados

$varturnoss10t=7; //(Sábados 9:00 - 9:15 - 9:30)
$varturnoss5t=5; //(Sábados 9:00 - 9:15 - 9:30)

//otros horarios lunes a viernes
$varturnos745hs=9;//(7:45 lunes a viernes)
$varturnoss10hs=5;//(7:45 lunes a viernes)
$varturnos8hs=12;//(8:00 lunes a viernes )
$varturnos815hs=7;//(8:15  lunes a viernes )
$varturnos13hs=1;//(13:00  lunes a viernes )
$varturnos1t=1;//(13:15  lunes a viernes )
$varturnos6t=6;//(7:45 lunes a viernes)
$varturnos7t=7;//(7:45 lunes a viernes)


//sobreturnos
$varsobreturnos=21;//sobreturnos, muestra al final


//cantidad de horarios x dia
$varhorarios=17;//(antes 2/11/20 $varhorarios=20;)

//sobreturnos
$varhorast=GLO_horasobreturno();
$varhorariosst=$varhorarios+1;

?>