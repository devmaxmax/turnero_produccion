<?php  include("SeguridadCMIT.php") ; ?>

<script language="javascript">
function items(id){
	var obj = document.getElementById('ul' + id)
	if(obj.style.display == 'block') obj.style.display = 'none'
	else obj.style.display = 'block'  
}
function ocultaItems(){
	listado = document.getElementById('listaUls')
	contenedores = listado.getElementsByTagName('ul')
	numContenedores = contenedores.length
	for(m=0; m < numContenedores; m++){
	if(contenedores[m].id.indexOf('ul') == 0)
	contenedores[m].style.display = 'none'     }  
}  
</script>

<td  height="100%" valign="top"  class="estilomenu"  style="width:1.8rem"> 

<!--menu-->
<table height="100%"  border="0" cellspacing="0" cellpadding="0" valign="top"  >
<tr > <td  style="height:1.8rem;"></td> </tr>
<tr><td valign="top" >	

<div id="menuv">

<ul id="listaUls" >
<?php   


//inicio
echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'InicioCMIT.php">&nbsp;INICIO</a></li>';
//consultar, modificar y cancelar turnos
echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'ConsultaCMIT.php">&nbsp;TURNOS</a></li>';
//asignacion masiva de turnos
echo '<li onclick="ocultaItems();items(7)" id="items">&nbsp;MASIVO</li>';
echo '<ul id="ul7" class="submenu">';
echo '<li id="items">  <a href="'.$_SESSION["NivelArbol"].'MasivoCMIT.php">&nbsp;Calendario</a> </li>';
echo '<li id="items">  <a href="'.$_SESSION["NivelArbol"].'MasivoCMITL.php">&nbsp;Lista</a> </li>';
echo '</ul>';

//usuarios
if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2 or $_SESSION["IdPerfilUser"]==3 or $_SESSION["IdPerfilUser"]==10){
	echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'Clientes.php">&nbsp;CLIENTES</a></li>';
}
if ($_SESSION["IdPerfilUser"]==1 or $_SESSION["IdPerfilUser"]==2){	
    echo '<li onclick="ocultaItems();items(8)" id="items">&nbsp;GENERAL</li>';
    echo '<ul id="ul8" class="submenu">'; 
	echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'Auditoria.php">&nbsp;Auditoria</a></li>'; 	
	echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'Noticias.php">&nbsp;Bienvenida</a></li>';
	echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'Politicas.php">&nbsp;Condiciones</a></li>';
	echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'Eliminar.php">&nbsp;Eliminar</a></li>';
	echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'Usuarios.php">&nbsp;Usuarios</a></li>';
	echo '</ul>';
}

//tablas
echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'Feriados.php">&nbsp;FERIADOS</a></li>';


?>
</ul>
<script type="text/javascript">
ocultaItems()
</script>
</div>

</td></tr>
</table>

<!--fin menu-->


</td>
<td  style="width:1.8rem" class="fondo" >&nbsp; </td>



