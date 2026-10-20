<? 
		//libre,no domingo,sabado dentro de horario,horariovigente,no feriado
		if($ocupado==0 and $domingo==0 and $sabado==0 and $horavieja==0 and $feriado==0){
			//muestro cant disponible
			${'sturnosdispdiario'.$i}=${'sturnosdispdiario'.$i}+$cantdisp;
			if($cantdisp==1){$cantdispley='(1 sobreturno disponible)';}else{$cantdispley='('.$cantdisp.' sobreturnos disponibles)';}
			$tablaclientes .="<td "." class="."TablaDato2"."  style='text-align:center;background-color:#0099cc;height:18px;'>".'<input name="CmdTurno" type="submit" class="botondisp" style="background-color:#0099cc;" value="'.$hora.'" id="'.$fecha.'|'.$hora.'|'.$varagenda.'"  title="'.date("d-m",strtotime("$fecha")).' '.$hora.' '.$cantdispley.'" onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'">'."</td>";
		}


?>