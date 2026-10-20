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
		<? echo $_SESSION["NombreUsuario"].' | Turnos On Line';?>&nbsp;
	</td>
</tr>

<!--fin tabla--> 
</Table>
<?php include("Codigo/Root.php") ;?>
<?php include("../Codigo/Root.php") ;?>
<script src="<?=$general['root'];?>/js/bootstrap.min.js"></script>
<script src="<?=$general['root'];?>/js/scrollreveal.min.js"></script>
<script src="<?=$general['root'];?>/js/jquery.easing.min.js"></script>
<script src="<?=$general['root'];?>/js/jquery.fittext.js"></script>
<script src="<?=$general['root'];?>/js/creative.js"></script>

            </div>
        </div>
    </div>
</section>

</body>
</html>

<? include ($_SESSION["NivelArbol"]."Codigo/LimpiarSession.php");?>