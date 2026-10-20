<? 
//variables horarios general
function GLO_horainicioLV(){
 $res='07:45';//2/11/20 
 return $res;	
}
function GLO_horainicioS(){
 $res=540;// 09:00
 return $res;	
}
function GLO_horafinS(){
 $res=645;// 10:45 SABADOS
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
	$lugaruu = utf8_decode('Neuquén Capital');
	$lugaruuu = utf8_decode('Área Exámenes');
	$lugaruuuu = utf8_decode('Neuquén');
	//pdf
	$pdf->AddPage();
	//banner
	$pdf->SetDrawColor(0, 116, 175);
	$pdf->Image($imagen,20,8,70);
	$pdf->Line(20,30,190,30);
	//fecha
	$pdf->SetFont('Arial','',12);
	$pdf->SetXY(120,12);
	$pdf->Cell(70,8,$fechahoy,0,0,'R');
	//titulo
	$pdf->SetFont('Arial','B',16);
	$pdf->SetXY(20,40);
	$pdf->Cell(20,5,'CONSTANCIA DE TURNO MEDICO',0,0,'L');
	$pdf->SetFont('Arial','B',16);
	$pdf->SetXY(130,40);
	$pdf->Cell(60,5,'NRO. '.$nroturno,0,0,'R');
	//texto

	//turno
	$pdf->SetFont('Arial','B',14);
	$pdf->SetXY(20,60);
	$pdf->Cell(0,5,'El Sr/a: '.$paciente,0,0,'L');
	$pdf->SetXY(20,67);
	$pdf->Cell(0,5,'DNI: '.$dni,0,0,'L');
	
	$pdf->SetFont('Arial','',14);
	$pdf->SetXY(20,80);$pdf->Cell(0,5,'Su turno:',0,0,'L');
	
	$pdf->SetXY(50,95);
	$pdf->Cell(60,10,'FECHA: '.$fecha,1,0,'C');
	$pdf->SetXY(120,95);
	$pdf->Cell(40,10,'HORA: '.$hora,1,0,'C');


	$pdf->SetFont('Arial','',14);
	$pdf->SetXY(20,120);
	$pdf->Cell(0,5,'Debera presentarse en nuestros consultorios ubicados en:',0,0,'L');
	$pdf->SetXY(20,130);
	$pdf->Cell(0,5,'JUAN B JUSTO Nro. 825 de '.$lugaruu,0,0,'L');

	//aviso
	$pdf->Line(20,175,128,175);
	$pdf->SetXY(20,178);$pdf->Cell(0,5,'PRESENTAR DNI ORIGINAL CON FOTO',0,0,'L');
	$pdf->Line(20,185,128,185);
	//sello
	$pdf->SetFont('Arial','',14);
	$pdf->SetXY(20,210);$pdf->Cell(0,5,''.$lugaruuu,0,0,'L');
	$pdf->SetXY(20,216);$pdf->Cell(0,5,'CMIT de SALUD OCUPACIONAL SRL',0,0,'L');
	$pdf->SetXY(20,222);$pdf->Cell(0,5,'CUIT: 30-70997141-3',0,0,'L');
	$pdf->SetXY(20,228);$pdf->Cell(0,5,'Habilitada por:',0,0,'L');
	$pdf->SetXY(20,234);$pdf->Cell(0,5,'Subsecretaria de Salud',0,0,'L');
	$pdf->SetXY(20,240);$pdf->Cell(0,5,'Provincia del '.$lugaruuuu,0,0,'L');
	//pie
	$pdf->SetFont('Arial','',10);
	$pdf->Line(20,265,190,265);
	$pdf->SetXY(20,267);$pdf->Cell(0,5,'JUAN B JUSTO 825 (8300) Neuquen Argentina',0,0,'L');
	$pdf->SetXY(100,267);$pdf->Cell(90,5,'Tel./Fax: +54 299 4474371',0,0,'R');
}

?>