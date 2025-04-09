<?php
include("conecta.php");

$despesa = $_POST["despesa"];
$data = $_POST["data"];
$categoria = $_POST["categoria"];
$pagamento = $_POST["pagamento"];
$parcelamento = $_POST["parcelamento"];
$tipo = $_POST["tipo"];
$valor = $_POST["valor"];

$query = "INSERT INTO desp (DESPESA, DATA_DA_DESPESA, CATEGORIA, FORMA_DE_PAGAMENTO, PARCELAMENTO, TIPO_DE_DESPESA, VALOR)
          VALUES ('$despesa', '$data', '$categoria', '$pagamento', '$parcelamento', '$tipo', '$valor')";

if (!mysqli_query($conexao, $query)) {
    die("Erro na inserção: " . mysqli_error($conexao));
}

header("Location: visualiza_despesa.php");
exit();
?>
