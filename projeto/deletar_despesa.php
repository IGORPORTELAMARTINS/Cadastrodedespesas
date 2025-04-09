<?php
include("conecta.php");

$id = $_GET["id"];
mysqli_query($conexao, "DELETE FROM desp WHERE id_desp=$id");

header("Location: visualiza_despesa.php");
exit();
?>