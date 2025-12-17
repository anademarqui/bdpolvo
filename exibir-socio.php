<?php
require_once("includes/header.php");

// require_once("includes/seguranca.php");

// require_once("includes/conexao.php");
// require_once("includes/funcoes.php");

// Verifica se veio o ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID do sócio não informado.";
    exit;
}

$id = $_GET['id'];

// Busca os dados do sócio (usando prepared statements para segurança)
$stmt = $mysqli->prepare("SELECT s.*, e.* FROM socios s LEFT JOIN endereco_socios e ON s.id = e.id_socio WHERE s.id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Sócio não encontrado.";
    exit;
}
$socio = $result->fetch_assoc();
$stmt->close();

// -- LÓGICA PARA BUSCAR PAGAMENTOS --
$todos_pagamentos = [];
$stmt_pagamentos = $mysqli->prepare("SELECT id_pagamento, forma_pg, valor, parcelas, data_pg, vencimento, obs FROM pagamento WHERE id_socio = ? ORDER BY data_pg DESC");
$stmt_pagamentos->bind_param("i", $id);
$stmt_pagamentos->execute();
$stmt_pagamentos->bind_result($id_pagamento, $forma_pg, $valor, $parcelas, $data_pg, $vencimento, $obs);

// Armazena todos os pagamentos em um array
while ($stmt_pagamentos->fetch()) {
    $todos_pagamentos[] = [
        'id_pagamento' => $id_pagamento,
        'forma_pg' => $forma_pg,
        'valor' => $valor,
        'parcelas' => $parcelas,
        'data_pg' => $data_pg,
        'vencimento' => $vencimento,
        'obs' => $obs
    ];
}
$stmt_pagamentos->close();

// Lógica para definir a situação e a cor do badge
$situacao = '';
$cor_badge = '';

if ($socio['stat'] === 'Inativo(a)') {
    $situacao = 'Inativo(a)';
    $cor_badge = 'bg-secondary';
} elseif ($socio['stat'] === 'Suspenso(a)') {
    $situacao = 'Suspenso(a)';
    $cor_badge = 'bg-warning text-dark';
} else {
    // Se estiver Ativo(a), calculamos a adimplência baseada em seus próprios pagamentos
    $adimplencia_deste_socio = 'Inadimplente';

    if (!empty($todos_pagamentos)) {
        
        $ultimo_pagamento = $todos_pagamentos[0];

        if (!empty($ultimo_pagamento['vencimento'])) {
            $vencimento_correto = new DateTime($ultimo_pagamento['vencimento']);
            $hoje = new DateTime();

            if ($hoje->format('Y-m-d') <= $vencimento_correto->format('Y-m-d')) {
                $adimplencia_deste_socio = 'Adimplente';
            }
        }
    }

    if ($adimplencia_deste_socio === 'Adimplente') {
        $situacao = 'Adimplente';
        $cor_badge = 'bg-success';
    } else {
        $situacao = 'Inadimplente';
        $cor_badge = 'bg-danger';
    }
}


?>


    <div class="d-flex min-vh-100">

        <!-- Menu lateral -->
        <?php require_once("includes/menu.php"); ?>

        <!-- Corpo -->
        <div class="container">
            <div class="flex-grow-1 overflow-auto" style="max-height: 100vh;">

                <div id="area-para-impressao">

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <h2><?php echo htmlspecialchars($socio['nome']) ?></h2>

                        <button onclick="imprimirSecao('area-para-impressao')" class="btn btn-primary d-print-none">
                            <i class="fas fa-print me-2"></i>
                            Imprimir
                        </button>
                    </div>
                
                 
                    <!-- Abas de paginação -->
                    <ul class="nav nav-tabs mt-4" id="tabsSocio" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="dados-tab" data-bs-toggle="tab" data-bs-target="#dados"
                                type="button" role="tab">Dados</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pagamentos-tab" data-bs-toggle="tab"
                                data-bs-target="#pagamentos" type="button" role="tab">Pagamentos</button>
                        </li>
                    </ul>

                    <div class="tab-content p-3 border border-top-0 bg-white" id="tabsSocioContent">

                        <!-- Aba Dados -->
                        <div class="tab-pane fade show active mt-3 p-3" id="dados" role="tabpanel">

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label><strong>Matrícula</strong></label>
                                    <p><?= htmlspecialchars($socio['matricula']) ?></p>
                                </div>

                                <!-- MOSTRAR STATUS DA MATRÍCULA -->
                                <div class="col-md-4">
                                    <label><strong>Status da Matrícula</strong></label>
                                    <p>
                                        <?php
                                        $status_matricula = $socio['stat'];

                                        if ($status_matricula === 'Ativo(a)') {
                                            echo '<span class="badge bg-success">Ativo(a)</span>';
                                        } elseif ($status_matricula === 'Inativo(a)') {
                                            echo '<span class="badge bg-secondary">Inativo(a)</span>';
                                        } else {
                                            echo '<span class="badge bg-warning text-dark">Suspenso(a)</span>';
                                        }
                                        ?>
                                    </p>
                                </div>

                                <!-- MOSTRAR SITUAÇÃO ADIMPLENCIA -->
                                <div class="col-md-4">
                                    <label><strong>Situação </strong></label>
                                    <p><span class="badge <?= $cor_badge ?>">
                                            <?= $situacao ?>
                                        </span></p>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label><strong>Nome Completo</strong></label>
                                    <p><?= htmlspecialchars($socio['nome']) ?></p>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label><strong>Data de Nascimento</strong></label>
                                    <p><?= formatarData($socio['data_nascimento']) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <label><strong>Natural de</strong></label>
                                    <p><?= htmlspecialchars($socio['nasc_cidade']) ?></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label><strong>CPF</strong></label>
                                    <p><?= htmlspecialchars(formatarCPF($socio['cpf'])) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <label><strong>RG</strong></label>
                                    <p><?= htmlspecialchars(formatarRG($socio['rg'])) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <label><strong>Órgão Emissor</strong></label>
                                    <p><?= htmlspecialchars($socio['orgao']) ?></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label><strong>Sexo</strong></label>
                                    <p><?= htmlspecialchars($socio['sexo']) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <label><strong>Nacionalidade</strong></label>
                                    <p><?= htmlspecialchars($socio['nacionalidade']) ?></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label><strong>Celular</strong></label>
                                    <p><?= formatarTelefone($socio['celular']) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <label><strong>Telefone Fixo</strong></label>
                                    <p><?= formatarTelefone($socio['telefone']) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <label><strong>Telefone para Recados</strong></label>
                                    <p><?= formatarTelefone($socio['fone_recado']) ?></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label><strong>Grau de Instrução</strong></label>
                                    <p><?= htmlspecialchars($socio['instrucao']) ?></p>
                                </div>
                                <div class="col-md-4">
                                    <label><strong>Situação Socioeconômica</strong></label>
                                    <p><?= htmlspecialchars($socio['economic']) ?></p>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <h5 class="mb-3">Endereço</h5>
                                    <p><?= htmlspecialchars($socio['rua'] . ", nº " . $socio['numero'] . " - " . $socio['bairro']) ?>
                                    </p>
                                    <p><?= htmlspecialchars($socio['cidade'] . "/" . $socio['estado']) ?></p>
                                    <p>Complemento:<?= htmlspecialchars($socio['complemento']) ?></p>
                                    <p>CEP: <?= htmlspecialchars($socio['cep']) ?></p>
                                    <p>Moradia: <?= htmlspecialchars($socio['moradia']) ?></p>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label><strong>Nome do pai</strong></label>
                                    <p><?= htmlspecialchars($socio['pai']) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <label><strong>Nome da mãe</strong></label>
                                    <p><?= htmlspecialchars($socio['mae']) ?></p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label><strong>Estado Civil</strong></label>
                                    <?= htmlspecialchars($socio['civil']) ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label><strong>Nome do cônjuge</strong></label>
                                    <p><?= htmlspecialchars($socio['conjuge']) ?></p>
                                </div>
                                <div class="col-md-6">
                                    <label><strong>Nasc. Cônjuge</strong></label>
                                    <p><?= formatarData($socio['nasc_conjuge']) ?></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label><strong>Mora </strong></label>
                                    <?= htmlspecialchars($socio['acomp']) ?>
                                </div>
                            </div>

                            <hr>

                            <h5 class="mb-3">Dados de Saúde</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label><strong>Tipo Sanguíneo: </strong></label>
                                    <?= htmlspecialchars($socio['tipo_sang'] . " " . $socio['rh']) ?>
                                </div>
                                <div class="col-md-6">
                                    <label><strong>PCD / Mobilidade Reduzida</strong></label>
                                    <?= htmlspecialchars($socio['pcd']) ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label><strong>Alergias: </strong></label>
                                    <?= htmlspecialchars($socio['alergias']) ?>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="listar.php" class="btn btn-secondary me-2">Voltar</a>
                                <a href="editar.php?id=<?= $socio['id'] ?>" class="btn btn-primary me-2">Editar</a>
                            </div>

                        </div>

                        <!-- Aba Pagamentos -->
                        <div class="tab-pane fade" id="pagamentos" role="tabpanel">

                            <div class="row my-3">
                                <div class="col-md-4">
                                    <a href="pagamentos.php?id=<?= $socio['id'] ?>" class="btn btn-primary">Adicionar
                                        Novo Pagamento</a>
                                </div>
                            </div>

                            <?php if (!empty($todos_pagamentos)): ?>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Data</th>
                                            <th scope="col">Valor R$</th>
                                            <th scope="col">Parcelas</th>
                                            <th scope="col">Método</th>
                                            <th scope="col">Próx Vencimento</th>
                                            <th scope="col">Observações</th>
                                            <th scope="col">Ação</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php foreach ($todos_pagamentos as $row_pg): ?>
                                            <tr>
                                                <th scope="row"><?php echo formatarData($row_pg['data_pg']); ?></th>

                                                <td><?php echo number_format($row_pg['valor'], 2, ',', '.'); ?></td>
                                                <td><?php echo $row_pg['parcelas']; ?></td>
                                                <td><?php echo htmlspecialchars($row_pg['forma_pg']); ?></td>
                                                <td><?php echo formatarData($row_pg['vencimento']); ?></td>
                                                <td><?php echo nl2br(htmlspecialchars($row_pg['obs'])); ?></td>

                                                <td class="d-flex gap-2">
                                                    <a href="editar-pg.php?id_pagamento=<?= $row_pg['id_pagamento'] ?>" class="btn btn-light">
                                                        <i class="fa-solid fa-pen-to-square text-secondary"></i>
                                                    </a>

                                                    <form method="POST" action="includes/acoes.php" onsubmit="return confirm('Tem certeza que deseja excluir este pagamento?');">
                                                        <input type="hidden" name="id_pagamento" value="<?php echo $row_pg['id_pagamento'] ?>">
                                                        <button type="submit" name="excluir" class="btn btn-light">
                                                            <i class="fa-solid fa-trash text-secondary"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p class="text-muted">Nenhum pagamento registrado.</p>
                            <?php endif; ?>
                        </div>

                    </div>

                </div>  
            </div>
        </div>
    </div>

<script src="js/imprimir.js"></script>

<?php require_once("includes/footer.php"); ?>