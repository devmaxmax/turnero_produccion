<?php  include("Seguridad.php") ; ?>

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

<table  border="0" cellspacing="0" cellpadding="0"  >
<tbody>
<tr > <td  height="22"  ></td> </tr>
<tr><td >&nbsp;</td>
<td>		
<div id="menuv" >
<ul id="listaUls" >
<?php   


//inicio
echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'Inicio.php">&nbsp;INICIO</a></li>';
//consultar, modificar y cancelar turnos
echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'MisTurnos.php">&nbsp;MIS TURNOS</a></li>';
//consultar, modificar datos cuenta usuario
echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'MiCuenta.php">&nbsp;MI CUENTA</a></li>';
//cambio clave
echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'CambioClave.php">&nbsp;CONTRASE&Ntilde;A</a></li>';
//salir
echo '<li onclick="ocultaItems()" id="items"><a href="'.$_SESSION["NivelArbol"].'Codigo/Logout.php">&nbsp;SALIR</a></li>';

?>
</ul>
<script type="text/javascript">
ocultaItems()
</script>
</div>
</td><td width="2" >&nbsp;</td>		
</tr>
</tbody>	
</table>



