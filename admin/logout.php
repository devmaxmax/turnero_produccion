<?php
session_start();
// Borramos toda la sesion
session_destroy();
@header('Location: login.php');
?>
<SCRIPT LANGUAGE="javascript">
location.href = "index.php";
</SCRIPT>