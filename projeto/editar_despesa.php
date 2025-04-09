<?php
// Inclui o arquivo de conexão com o banco de dados
include("conecta.php");

// Verifica se o formulário foi enviado via método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Captura os dados enviados pelo formulário
    $id = $_POST["id"];
    $despesa = $_POST["despesa"];
    $data = $_POST["data"];
    $categoria = $_POST["categoria"];
    $pagamento = $_POST["pagamento"];
    $parcelamento = $_POST["parcelamento"];
    $tipo = $_POST["tipo"];
    $valor = $_POST["valor"];

    // Executa a atualização dos dados no banco
    mysqli_query($conexao, "UPDATE desp SET 
        DESPESA='$despesa', 
        DATA_DA_DESPESA='$data', 
        CATEGORIA='$categoria', 
        FORMA_DE_PAGAMENTO='$pagamento', 
        PARCELAMENTO='$parcelamento', 
        TIPO_DE_DESPESA='$tipo', 
        VALOR='$valor' 
        WHERE id_desp=$id");

    // Redireciona para a página de visualização após salvar
    header("Location: visualiza_despesa.php");
    exit();
}

// Se não for POST, significa que é uma requisição para carregar o formulário
// Pega o ID da despesa pela URL (GET)
$id = $_GET["id"];

// Busca os dados da despesa no banco com base no ID
$consulta = mysqli_query($conexao, "SELECT * FROM desp WHERE id_desp=$id");

// Transforma o resultado em um array associativo para ser usado no formulário
$linha = mysqli_fetch_assoc($consulta);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Despesa</title>

    <!-- Fonte Montserrat do Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap" rel="stylesheet">

    <style>
        /* Estilização geral do corpo */
        body {
            font-family: 'Montserrat', sans-serif;
            font-weight: 300;
            background-color: #f5f3e7;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Formulário estilizado como um card */
        form {
            background-color: #2e4f3e;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            color: #fff;
            max-width: 500px;
            width: 100%;
        }

        h1 {
            font-weight: 600;
            font-size: 2rem;
            margin-bottom: 20px;
            color: #ffff;
            text-align: center;
        }

        /* Estilo dos campos */
        .campo {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }

        input[type="text"],
        input[type="date"],
        button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 300;
            background-color: #f5f3e7;
            color: #333;
            box-sizing: border-box;
        }

        /* Botão de envio */
        button {
            background-color: #a7c4a0;
            color: #2e4f3e;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        button:hover {
            background-color: #92b291;
        }
    </style>
</head>
<body>

<!-- Formulário para editar os dados da despesa -->
<form method="POST">
    <h1>Editar Despesa</h1>

    <!-- Campo oculto para enviar o ID da despesa -->
    <input type="hidden" name="id" value="<?php echo $linha['id_desp']; ?>">

    <div class="campo">
        <label>Despesa:</label>
        <input type="text" name="despesa" value="<?php echo $linha['DESPESA']; ?>">
    </div>

    <div class="campo">
        <label>Data:</label>
        <input type="text" name="data" value="<?php echo $linha['DATA_DA_DESPESA']; ?>">
    </div>

    <div class="campo">
        <label>Categoria:</label>
        <input type="text" name="categoria" value="<?php echo $linha['CATEGORIA']; ?>">
    </div>

    <div class="campo">
        <label>Pagamento:</label>
        <input type="text" name="pagamento" value="<?php echo $linha['FORMA_DE_PAGAMENTO']; ?>">
    </div>

    <div class="campo">
        <label>Parcelamento:</label>
        <input type="text" name="parcelamento" value="<?php echo $linha['PARCELAMENTO']; ?>">
    </div>

    <div class="campo">
        <label>Tipo:</label>
        <input type="text" name="tipo" value="<?php echo $linha['TIPO_DE_DESPESA']; ?>">
    </div>

    <div class="campo">
        <label>Valor:</label>
        <input type="text" name="valor" value="<?php echo $linha['VALOR']; ?>">
    </div>

    <!-- Botão para enviar as alterações -->
    <button type="submit">Salvar</button>
</form>

</body>
</html>
