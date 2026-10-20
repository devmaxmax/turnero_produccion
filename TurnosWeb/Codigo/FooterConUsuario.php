<!--fin contenedor-->  
</td></tr></table>
</td></tr>

<!--footer--> 

<tr>
	<td class="footerspace" colspan="2">

	</td>
</tr>

<tr>
	<td class="footerUSR"  style="text-transform:lowercase;" colspan="2">
		<i class="fa fa-user" style="margin-right: 5px; color:#ccc"></i> <? echo $_SESSION["NombreUsuario"].' | <i class="fa fa-clock" style="margin-right: 5px; color:#ccc"></i>  Turnos On Line';?>&nbsp;
	</td>
</tr>

<!--fin tabla--> 
</Table>
<?php include("Codigo/Root.php") ;?>
<?php include("../Codigo/Root.php") ;?>
<script src="<?=$general['root'];?>/js/bootstrap.js"></script>
<script src="<?=$general['root'];?>/js/scrollreveal.min.js"></script>
<script src="<?=$general['root'];?>/js/jquery.easing.min.js"></script>
<script src="<?=$general['root'];?>/js/jquery.fittext.js"></script>
<script src="<?=$general['root'];?>/js/creative.js"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

            </div>
        </div>
    </div>
</section>

</body>
</html>

<? include ($_SESSION["NivelArbol"]."Codigo/LimpiarSession.php");?>