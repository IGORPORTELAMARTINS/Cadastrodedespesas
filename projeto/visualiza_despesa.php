<?php
// Inclui a conexão com o banco de dados
include("conecta.php");

// Busca todos os registros da tabela 'desp'
$resultado = mysqli_query($conexao, "SELECT * FROM desp");

// Verifica se há registros retornados
$temRegistros = mysqli_num_rows($resultado) > 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Despesas</title>

    <!-- Fonte personalizada -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600&display=swap" rel="stylesheet">

    <!-- Estilos do DataTables e botões de exportação -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

    <style>
        /* Estilos gerais da página */
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f3e7;
            padding: 40px;
        }

        h1 {
            font-weight: 600;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
        }

        .voltar {
            display: inline-block;
            margin-bottom: 20px;
            background-color: #a7c4a0;
            color: #2e4f3e;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
        }

        /* Estilização da tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        th, td, tfoot th {
            padding: 14px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2e4f3e;
            color: #fff;
        }

        tfoot {
            background-color: #2e4f3e;
            color: #fff;
            font-weight: 600;
        }

        .acoes a {
            color: #2e4f3e;
            font-weight: 600;
            margin: 0 6px;
            text-decoration: none;
        }

        .acoes a:hover {
            text-decoration: underline;
        }

        /* Espaçamento para os botões de exportação */
        .dt-buttons {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h1>Lista de Despesas</h1>
<a class="voltar" href="index.html">← Voltar</a>

<?php if ($temRegistros): ?>
    <!-- Tabela com as despesas -->
    <table id="tabelaDespesas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Despesa</th>
                <th>Data</th>
                <th>Categoria</th>
                <th>Pagamento</th>
                <th>Parcelamento</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Volta o ponteiro da consulta para o início
            mysqli_data_seek($resultado, 0);

            // Exibe cada linha de resultado na tabela
            while($linha = mysqli_fetch_assoc($resultado)) {
            ?>
            <tr>
                <td><?php echo $linha["id_desp"] ?? "vazio"; ?></td>
                <td><?php echo $linha["DESPESA"] ?? "vazio"; ?></td>
                <td><?php echo $linha["DATA_DA_DESPESA"] ?? "vazio"; ?></td>
                <td><?php echo $linha["CATEGORIA"] ?? "vazio"; ?></td>
                <td><?php echo $linha["FORMA_DE_PAGAMENTO"] ?? "vazio"; ?></td>
                <td><?php echo $linha["PARCELAMENTO"] ?? "vazio"; ?></td>
                <td><?php echo $linha["TIPO_DE_DESPESA"] ?? "vazio"; ?></td>
                <td><?php echo !empty($linha["VALOR"]) ? 'R$ ' . number_format($linha["VALOR"], 2, ',', '.') : "vazio"; ?></td>
                <td class="acoes">
                    <a href="editar_despesa.php?id=<?php echo $linha['id_desp']; ?>">Editar</a> |
                    <a href="deletar_despesa.php?id=<?php echo $linha['id_desp']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7" style="text-align:right">Total:</th>
                <th colspan="2" id="totalValor">R$ 0,00</th>
            </tr>
        </tfoot>
    </table>
<?php else: ?>
    <!-- Caso não haja despesas -->
    <p style="text-align:center;">Nenhuma despesa cadastrada.</p>
<?php endif; ?>

<!-- Inclusão dos scripts do DataTables e extensões -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

<script>
$(document).ready(function() {
    let totalGlobal = 0;

    // Inicializa a tabela com DataTables
    const tabela = $('#tabelaDespesas').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json' // Tradução
        },
        dom: 'Bfrtip', // Define a posição dos botões
        footerCallback: function ( row, data, start, end, display ) {
            const api = this.api();

            // Função auxiliar para converter o valor string para número
            const parseValor = val => {
                if (typeof val === 'string') {
                    return parseFloat(val.replace('R$', '').replace(/\./g, '').replace(',', '.')) || 0;
                }
                return val;
            };

            // Soma os valores da coluna "Valor"
            const total = api.column(7, { page: 'current' }).data()
                .reduce((a, b) => parseValor(a) + parseValor(b), 0);

            totalGlobal = total;

            // Exibe o total no rodapé
            $('#totalValor').html('R$ ' + total.toFixed(2).replace('.', ','));
        },
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Exportar Excel',
                filename: 'despesas',
                title: 'Lista de Despesas',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclui a coluna de ações
                },
                messageBottom: function () {
                    // Adiciona o total ao final do Excel
                    return 'Total: R$ ' + totalGlobal.toFixed(2).replace('.', ',');
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'Exportar PDF',
                filename: 'despesas',
                title: 'Lista de Despesas',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: ':not(:last-child)' // Exclui a coluna de ações
                },
                customize: function(doc) {
                    doc.defaultStyle.fontSize = 10;

                    // Adiciona o total ao final do PDF
                    doc.content.push({
                        text: 'Total: R$ ' + totalGlobal.toFixed(2).replace('.', ','),
                        margin: [0, 20, 0, 0],
                        alignment: 'right',
                        bold: true
                    });
                }
            }
        ]
    });
});
</script>

</body>
</html>
