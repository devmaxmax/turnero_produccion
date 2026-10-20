<? 
//muestra tipo examen

//muestra en el mail
if($mostrartipoex==1){
    $tipoex1='';
    if($row2['E1']==1){$tipoex1=$tipoex1.'- PCR COVID 19<BR>';}
    if($row2['E2']==1){$tipoex1=$tipoex1.'- TEST RAPIDO ANTIGENO COVID 19<BR>';}
    if($row2['E3']==1){$tipoex1=$tipoex1.'- TEST RAPIDO ANTICUERPOS COVID 19<BR>';}
    if($row2['E4']==1){$tipoex1=$tipoex1.'- ELISA ANTICUERPOS IGG<BR>';}
    if($row2['E5']==1){$tipoex1=$tipoex1.'- ELISA ANTICUERPOS IGM';}
}


//muestra en la pagina
if($mostrartipoex==2){
    $tipoex1='';
    if($row['E1']==1){if($tipoex1!=''){$tipoex1=$tipoex1.', ';}$tipoex1=$tipoex1.'PCR COVID 19';}
    if($row['E2']==1){if($tipoex1!=''){$tipoex1=$tipoex1.', ';}$tipoex1=$tipoex1.'TEST RAPIDO ANTIGENO COVID 19';}
    if($row['E3']==1){if($tipoex1!=''){$tipoex1=$tipoex1.', ';}$tipoex1=$tipoex1.'TEST RAPIDO ANTICUERPOS COVID 19';}
    if($row['E4']==1){if($tipoex1!=''){$tipoex1=$tipoex1.', ';}$tipoex1=$tipoex1.'ELISA ANTICUERPOS IGG';}
    if($row['E5']==1){if($tipoex1!=''){$tipoex1=$tipoex1.', ';}$tipoex1=$tipoex1.'ELISA ANTICUERPOS IGM';}
}

?>

