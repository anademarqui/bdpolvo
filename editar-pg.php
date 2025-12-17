<?php
require_once("includes/header.php");

// require_once("includes/seguranca.php");

// require_once("includes/conexao.php");

// Verifica se o ID do pagamento foi informado
if (!isset($_GET['id_pagamento'])) {
    die("ID do pagamento não fornecido.");
}

$id_pagamento = $_GET['id_pagamento'];

// Busca os dados do pagamento a ser editado
$stmt = $mysqli->prepare("SELECT * FROM pagamento WHERE id_pagamento = ?");
$stmt->bind_param("i", $id_pagamento);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Pagamento não encontrado.");
}

$pagamento = $result->fetch_assoc();
$stmt->close();
?>

    <div class="d-flex min-vh-100">
        <div class="text-white" style="width: 200px; flex-shrink: 0; background-color: #426dae;">
            <div class="text-center mt-3 py-2">
                <img src="img/logo.png" class="w-75" alt="Logo">
            </div>
            <ul class="nav flex-column mt-3">
                <li class="nav-item py-2"><a class="nav-link" href="inicio.php">INÍCIO</a></li>
                <li class="nav-item py-2"><a class="nav-link" href="listar.php">LISTAR</a></li>
                <li class="nav-item py-2"><a class="nav-link" href="cadastrar.php">CADASTRAR</a></li>
                <li class="nav-item py-2"><a class="nav-link" href="pagamentos.php">PAGAMENTOS</a></li>
                <li class="nav-item py-2"><a class="nav-link" href="listar.php">SAIR<i
                            class="fa-solid fa-right-from-bracket text-white ms-3"></i></a></li>
            </ul>
        </div>

        <div class="container">
            <div class="flex-grow-1 overflow-auto" style="max-height: 100vh;">
                <div class="card p-3 border-0 rounded-0" style="background-color:rgb(172, 201, 244);">

                    <h2 class="mt-3">Editar Pagamento</h2>

                    <div class="card border-0 py-3 px-4 mt-4">


                        <form action="includes/acoes.php" method="POST">

                            <input type="hidden" name="id_pagamento" value="<?= htmlspecialchars($pagamento['id_pagamento']) ?>">
                            <input type="hidden" name="id_socio" value="<?= htmlspecialchars($pagamento['id_socio']) ?>">


                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Data do Pagamento</label>
                                    <input type="date" name="data_pg" class="form-control" value="<?= htmlspecialchars($pagamento['data_pg']) ?>" required>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Forma de Pagamento</label>
                                    <select name="forma_pg" class="form-select">
                                        <option value="PIX" <?= $pagamento['forma_pg'] == 'PIX' ? 'selected' : '' ?>>PIX</option>
                                        <option value="Dinheiro" <?= $pagamento['forma_pg'] == 'Dinheiro' ? 'selected' : '' ?>>Dinheiro</option>
                                        <option value="Crédito" <?= $pagamento['forma_pg'] == 'Crédito' ? 'selected' : '' ?>>Crédito</option>
                                        <option value="Débito" <?= $pagamento['forma_pg'] == 'Débito' ? 'selected' : '' ?>>Débito</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Valor R$</label>
                                    <input type="text" name="valor" class="form-control" value="<?= htmlspecialchars($pagamento['valor']) ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Quantidade Parcelas</label>
                                    <input type="number" min="1" name="parcelas" class="form-control" value="<?= htmlspecialchars($pagamento['parcelas']) ?>" required>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Vencimento do Próximo Pagamento</label>
                                    <input type="date" name="vencimento" class="form-control" value="<?= htmlspecialchars($pagamento['vencimento']) ?>" required>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <label>Observação:</label>
                                    <textarea name="obs" class="form-control"><?= htmlspecialchars($pagamento['obs']) ?></textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="exibir-socio.php?id=<?= $pagamento['id_socio'] ?>" class="btn btn-secondary mt-4 me-2">Cancelar</a>
                                <button type="submit" name="salvar_edicao_pg" class="btn btn-primary mt-4">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php require_once("includes/footer.php"); ?>