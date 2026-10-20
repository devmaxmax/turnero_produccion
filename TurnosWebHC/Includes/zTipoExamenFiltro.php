<? 
//filtra tipo examen
$wtipoex='';
$tipoex=intval($_POST['CbEx']);

if($tipoex==1){$wtipoex="and t.E1=1";}

switch ($tipoex) {
    case 1:	$wtipoex="and t.E1=1";break;
    case 2:	$wtipoex="and t.E2=1";break;
    case 3:	$wtipoex="and t.E3=1";break;
    case 4:	$wtipoex="and t.E4=1";break;
    case 5:	$wtipoex="and t.E5=1";break;	
}		


?>

