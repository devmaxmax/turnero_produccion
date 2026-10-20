<? 
		//libre,no domingo,sabado dentro de horario,horariovigente,no feriado
		if($ocupado==0 and $domingo==0 and $sabado==0 and $horavieja==0 and $feriado==0){
			//muestro cant disponible
			${'turnosdispdiario'.$i}=${'turnosdispdiario'.$i}+$cantdisp;
			if($cantdisp==1){$cantdispley='(1 turno disponible)';}else{$cantdispley='('.$cantdisp.' turnos disponibles)';}
			$tablaclientes .="<td "." class="."TablaDato2"."  style='text-align:center;background-color:#2bca6e;height:20px; '>".'<input name="CmdTurno" type="submit" class="botondisp" value="'.$hora.'" id="'.$fecha.'|'.$hora.'|'.$varagenda.'" data-toggle="tooltip" data-placement="right" title="'.date("d-m",strtotime("$fecha")).' '.$hora.' '.$cantdispley.'" onclick="document.Formulario.TxtId.value=this.id;document.Formulario.target='."'_self'".'">'."


			</td>";
		}


?>