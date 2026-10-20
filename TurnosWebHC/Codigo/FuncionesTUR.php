<? 
//variables horarios general
function GLO_horainicioLV(){
 $res='08:00';//2/11/20 
 return $res;	
}
function GLO_horainicioS(){
 $res=540;// 09:00
 return $res;	
}
function GLO_horafinS(){
 $res=780;// 13:00
 return $res;	
}



//variables horarios sobreturnos
function GLO_horasobreturno(){
 $res='13:45';
 return $res;	
}
function GLO_horasobreturnomysql(){
 $res='13:45:00';
 return $res;	
}
function GLO_horasobreturnover(){
 $res='';//21/5/20
 return $res;	
}
function GLO_horasobreturnovermysql(){
 $res='00:00:00';//21/5/20 
 return $res;	
}






//acciones horarios
function GLO_TURSumo15Min($hora){//sumo 15 minutos a la hora
	//valido
	if($hora=='07:50'){$varminentreturnos=10;}else{$varminentreturnos=15;}
	//sumo
	list($h1,$m1)=explode(":",$hora);$minutos1=$m1+($h1*60)+$varminentreturnos;
	$H= intval($minutos1/60);$M = ($minutos1-($H*60));$hora=date("H:i",strtotime($H.":".$M));  
	return $hora;
}




//sobreturno mostrar
function GLO_TURSobreturnoLY($sturno){//mostrar leyenda
	$res=''; if($sturno==1){$res='SOBRETURNO';}	
	return $res;
}
function GLO_TURSobreturnoHora($hora,$sturno){//a que hora ve el cliente los sobreturnos
	$h1=GLO_horasobreturnover();
	$res=$hora;	if($sturno==1){$res=$h1;}
	return $res;
}
function GLO_TURSobreturnoES($hora){//en alta, masivo y reagendar, segun la hora lo marca como sobreturno
	$h1=GLO_horasobreturnomysql();$h2=GLO_horasobreturno();
	$res=0; if($hora==$h1 or $hora==$h2){$res=1;}
	return $res;
}









//habilitaciones temporales, sin alta y riesgo
function GLO_TURSinAltaHT($fp,$sa,$diassa,$fechasa){//valido sin alta modo temporal(ctdo+sinalta+tiene dias y fecha)
	$res=0;
	if($fp==0 and $sa==1 and $diassa!=0 and $fechasa!='0000-00-00'){
		$diast=GLO_diastranscurridosCS(date("d-m-Y"),GLO_FormatoFecha($fechasa));
		if($diast>=0 and $diast<$diassa){$res=1;}
	}
	return $res;
}
function GLO_TURSinAltaHTFin($fp,$sa,$diassa,$fechasa){//valida si esta habilitado temporalmente
	$res='';
	if($fp==0 and $sa==1 and $diassa!=0 and $fechasa!='0000-00-00'){
		$diassa=$diassa-1;
		$res=date("d-m-Y", strtotime("$fechasa +$diassa day"));
	}
	return $res;
}
function GLO_TURSinAlta($id,$conn){//sin alta turno
	$res=0;
	$id=mysql_real_escape_string($id);
	$query="SELECT FPago,SA From usuarios where Usuario='$id'";$rs2=mysql_query($query,$conn);$row2=mysql_fetch_array($rs2);
	if(mysql_num_rows($rs2)!=0){
		if($row2['SA']==1){$res=1;}
	}mysql_free_result($rs2);
	return $res;
}
function GLO_TURRiesgo($riesgo,$fpago){//si riesgo tiene check o es ctdo, es riesgo
	if($riesgo==1 or $fpago==0){$res=1;}else{$res=0;}
	return $res;
}
function GLO_TURRiesgo2($riesgo,$fpago){//si riesgo tiene check o es ctdo, es riesgo
	//(no considera check riesgo 06-2021)
	//(no considera ctdo 08-2021)
	//if($fpago==0){$res=1;}else{$res=0;}
	$res=0;
	return $res;
}



//condiciones
function GLO_TURCondicionesMail($conn){//busco condiciones para mostrar en el mail
	$res='';
	$query="SELECT Texto From parametros";$rs2=mysql_query($query,$conn);$row2=mysql_fetch_array($rs2);
	if(mysql_num_rows($rs2)!=0){$res=$row2['Texto'];}mysql_free_result($rs2);
	return $res;
}
function GLO_TURCondicionesWEB($conn){//busco condiciones para mostrar en la pagina(no mail)
	$res='';
	$query="SELECT Texto From parametros";$rs2=mysql_query($query,$conn);$row2=mysql_fetch_array($rs2);
	if(mysql_num_rows($rs2)!=0){$res=$row2['Texto'];}mysql_free_result($rs2);
	//saco los br
	$res=str_replace('<br>','',$res);$res=str_replace('<BR>','',$res);$res=str_replace('<bR>','',$res);$res=str_replace('<Br>','',$res);
	return $res;
}



function GLO_TURFeriado($fecha,$conn){//busco si es feriado	
	$res=0;
	$query="Select Id From feriados Where Fecha='".FechaMySql($fecha)."'";$rs10=mysql_query($query,$conn);$row10=mysql_fetch_array($rs10);
	if(mysql_num_rows($rs10)==0){$res=0;}else{$res=1;} mysql_free_result($rs10);
	return $res;
}


//pdf turno
function GLO_PDFTurno($pdf,$idturno,$nivelarbol,$conn){/*constancia turno */
	$imagen=$nivelarbol."CSS/Imagenes/LogoPDF.jpg";		
	$fechahoy=LugarFechaLargo(date("d-m-Y"));
	//datos
	$query="Select t.Id,t.Fecha,t.Hora,t.Paciente,t.DNIP,t.STurno From turnos t Where t.Id=$idturno";
	$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
	if(mysql_num_rows($rs)!=0){
		$nroturno=str_pad($row['Id'], 6, "0", STR_PAD_LEFT);
		$fecha=ObtenerDiaSemanaCorto(FormatoFecha($row['Fecha'])).' '.FormatoFecha($row['Fecha']);
		$hora=GLO_TURSobreturnoHora(date("H:i",strtotime($row['Hora'])),$row['STurno']);
		$paciente=GLO_textoFPDF($row['Paciente']);
		$dni=GLO_textoFPDF($row['DNIP']);
	}mysql_free_result($rs);
	//pdf
	$pdf->AddPage();
	//banner
	$pdf->Image($imagen,20,12,70);
	$pdf->Line(20,32,190,32);
	//fecha
	$pdf->SetFont('Arial','',14);
	$pdf->SetXY(20,38);$pdf->Cell(170,5,$fechahoy,0,0,'R');
	//titulo
	$pdf->SetFont('Arial','BU',16);$pdf->SetXY(20,53);$pdf->Cell(170,5,'CONSTANCIA DE TURNO MEDICO',0,0,'C');
	$pdf->SetFont('Arial','B',16);$pdf->SetXY(20,60);$pdf->Cell(170,5,'NRO. '.$nroturno,0,0,'C');
	//texto
	$pdf->SetFont('Arial','',16);
	$pdf->SetXY(20,75);$pdf->Cell(0,5,'A los efectos que corresponda, se deja constancia que:',0,0,'L');
	//turno
	$pdf->SetFont('Arial','B',16);
	$pdf->SetXY(20,94);$pdf->Cell(0,5,'El Sr/a: '.$paciente,0,0,'L');
	$pdf->SetXY(20,100);$pdf->Cell(0,5,'DNI: '.$dni,0,0,'L');
	
	$pdf->SetXY(20,115);$pdf->Cell(0,5,'Debera presentarse en nuestros consultorios ubicados en:',0,0,'L');
	$pdf->SetXY(20,130);$pdf->Cell(0,5,'JUAN B JUSTO Nro. 825 de Neuquen Capital',0,0,'L');
	
	$pdf->SetXY(20,145);$pdf->Cell(0,5,'FECHA: '.$fecha,0,0,'L');
	$pdf->SetXY(20,151);$pdf->Cell(0,5,'HORA: '.$hora,0,0,'L');
	//aviso
	$pdf->Line(20,175,128,175);
	$pdf->SetXY(20,178);$pdf->Cell(0,5,'PRESENTAR DNI ORIGINAL CON FOTO',0,0,'L');
	$pdf->Line(20,185,128,185);
	//sello
	$pdf->SetFont('Arial','',14);
	$pdf->SetXY(20,210);$pdf->Cell(0,5,'Area Examenes',0,0,'L');
	$pdf->SetXY(20,216);$pdf->Cell(0,5,'CMIT de SALUD OCUPACIONAL SRL',0,0,'L');
	$pdf->SetXY(20,222);$pdf->Cell(0,5,'CUIT: 30-70997141-3',0,0,'L');
	$pdf->SetXY(20,228);$pdf->Cell(0,5,'Habilitada por:',0,0,'L');
	$pdf->SetXY(20,234);$pdf->Cell(0,5,'DISPOSICION NRO. 1113/17',0,0,'L');
	$pdf->SetXY(20,240);$pdf->Cell(0,5,'Subsecretaria de Salud',0,0,'L');
	$pdf->SetXY(20,246);$pdf->Cell(0,5,'Provincia del Neuquen',0,0,'L');
	//pie
	$pdf->SetFont('Arial','',10);
	$pdf->Line(20,265,190,265);
	$pdf->SetXY(20,267);$pdf->Cell(0,5,'JUAN B JUSTO 825 (8300) Neuquen Argentina',0,0,'L');
	$pdf->SetXY(100,267);$pdf->Cell(90,5,'Tel./Fax: +54 299 4474371',0,0,'R');
}

?>