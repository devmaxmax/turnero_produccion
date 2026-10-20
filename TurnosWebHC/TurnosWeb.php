<? include ("Codigo/HeadFull.php");?>
<link rel="STYLESHEET" type="text/css" href="CSS/Estilo.css" >
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
<? include ("Codigo/BannerInicio.php");?>
<form name="Formulario" action="Intranet/zIntranet.php" method="post">

<table width="100%"  style="max-width:750px;"  border="0" cellspacing="0" cellpadding="0">
<tr><td  height="5"></td></tr>
<tr> <td>
<div class="post">
<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="tablanotif" style="border:1px #e1e1e1 solid; padding:14px;border-radius:4px;color: #484848;">
<tr><td  width="570"></td><td  width="180" style="min-width:180px;"></td></tr>
<? include("Codigo/Config.php") ;
$conn=mysql_connect($server,$dbuser,$dbpass);mysql_select_db($database);
$query="SELECT * From noticias";$rs=mysql_query($query,$conn);$row=mysql_fetch_array($rs);
if(mysql_num_rows($rs)!=0){
	$titulo = $row['Titulo'];
	$stitulo = $row['Subtitulo'];
	$texto = $row['Texto'];
}mysql_free_result($rs);mysql_close($conn);

echo '<tr><td><h2 class="title">'.$titulo.'</h2></td><td valign="top" align="right"><input name="CmdSistema"  type="submit" class="boton"   style="width:160px;font-size: 12px;height:27px;" value="Turnos Hisopados COVID" onClick="document.Formulario.target='."'_self'".'" >&nbsp;</td></tr>';
echo '<tr><td colspan="2"><p class="title2">'.$stitulo.'</p>';
echo '<p class="entry">'.$texto.'</p></td></tr>';
?> 
</table>
</div>
</td></tr>     
</table>
<!-- fin Campos -->	

</Form>
<? include ("Codigo/FooterSinUsuario.php");?>