<?php
require_once("includes/header.php");

// require_once("includes/seguranca.php");

// require_once("includes/conexao.php");
// require_once("includes/funcoes.php");
require_once("includes/list.php");


$sql = "SELECT 
            p.*, 
            s.nome, 
            a.polvo_usuario
        FROM 
            pagamento AS p
        LEFT JOIN 
            socios AS s ON p.id_socio = s.id
        LEFT JOIN 
            polvo_adm AS a ON p.id_adm = a.id
        ORDER BY 
            p.data_pg DESC";

$result = $mysqli->query($sql);
if (!$result) {
    // Se a query falhou, pare o script e mostre o erro exato do MySQL
    die("Erro na consulta SQL: " . $mysqli->error); 
}
?>

    <div class="d-flex min-vh-100">

        <!-- Menu lateral -->
        <?php require_once("includes/menu.php"); ?>

        <!-- Listagem de Pagamentos -->
        <div class="container">
            <div class="flex-grow-1 overflow-auto" style="max-height: 100vh;">
                <div class="card p-3 border-0 rounded-0" style="background-color:rgb(172, 201, 244);">

                <h2 class="mt-3">Histórico de Pagamentos</h2>

                    <!-- Tabela -->
                    <div class="card border-0 p-3 mt-4">

                        <div class="d-flex justify-content-between align-items-center">
                                <a href="pagamentos.php" class="btn btn-primary">Adicionar
                                    Novo Pagamento</a>
                         <button onclick="imprimirSecao('area-para-impressao')" class="btn btn-primary d-print-none">
                                <i class="fas fa-print me-2"></i>
                                Imprimir
                            </button>
                            </div>
                        <div id="area-para-impressao">

                        <div class="table-responsive mt-4">
                            <table class="table table-hover align-middle">
                                <thead class="table-primary">
                                    <tr>
                                    <tr>
                                        <th>Data Pagamento</th>
                                        <th>Nome do Sócio</th>
                                        <th>Valor R$</th>
                                        <th>Método</th>
                                        <th>Parcelas</th>
                                        <th>Próx. Vencimento</th>
                                        <th>Admin</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php

                                    if ($result->num_rows > 0) {
                                        while ($row_pg = $result->fetch_assoc()):
                                            ?>
                                            <tr>
                                                <th><?php echo formatarData($row_pg['data_pg']); ?></th>
                                                <td><?php echo htmlspecialchars($row_pg['nome']); ?></td>

                                                <td><?php echo number_format($row_pg['valor'], 2, ',', '.'); ?></td>
                                                <td><?php echo htmlspecialchars($row_pg['forma_pg']); ?></td>
                                                <td><?php echo htmlspecialchars($row_pg['parcelas']); ?></td>
                                                <td><?php echo formatarData($row_pg['vencimento']); ?></td>
                                                <td><?php echo htmlspecialchars($row_pg['polvo_usuario']); ?></td> 

                                            </tr>
                                        <?php endwhile;
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    </div>
    <script src="js/imprimir.js"></script>

<?php require_once("includes/footer.php"); ?>