<?php
require_once("includes/header.php");
require_once("includes/list.php");
?>


<div class="d-flex min-vh-100">

    <!-- Menu lateral -->
    <?php require_once("includes/menu.php"); ?>

    <!-- Lista de Sócios -->
    <div class="container">
        <div class="flex-grow-1 overflow-auto" style="max-height: 100vh;">
            <div class="card p-3 border-0 rounded-0" style="background-color:rgb(172, 201, 244);">

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <h2>Sócios Cadastrados</h2>
                    <button onclick="imprimirSecao('area-para-impressao')" class="btn btn-primary d-print-none">
                        <i class="fas fa-print me-2"></i>
                        Imprimir
                    </button>
                </div>

                <!-- Cards Contagem -->
                <div class="row my-4">
                    <div class="col-md-3">
                        <div class="card p-3 d-flex flex-column justify-content-center position-relative">
                            <h6>Total</h6>
                            <h2><?= $total ?></h2>
                            <i
                                class="fa-solid fa-people-group position-absolute end-0 top-50 translate-middle-y me-3 fa-2x"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 d-flex flex-column justify-content-center position-relative">
                            <h6>Ativos</h6>
                            <h2><?= $ativos ?></h2>
                            <i
                                class="fa-solid fa-circle-check position-absolute end-0 top-50 translate-middle-y me-3 fa-2x"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 d-flex flex-column justify-content-center position-relative">
                            <h6>Adimplentes</h6>
                            <h2 class="text-success"><?= $adimplentes ?></h2>
                            <i
                                class="fa-solid fa-coins position-absolute end-0 top-50 translate-middle-y me-3 fa-2x text-success"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 d-flex flex-column justify-content-center position-relative">
                            <h6>Inadimplentes</h6>
                            <h2 class="text-danger"><?= $inadimplentes ?></h2>
                            <i
                                class="fa-solid fa-coins position-absolute end-0 top-50 translate-middle-y me-3 fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="card border-0 p-3">
                    <h4 class="my-2"><i class="fa-solid fa-filter"></i> Filtros</h4>

                    <form class="row my-3" method="get">
                        <div class="col-md-3">
                            <label>Buscar</label>
                            <input type="text" name="busca" class="form-control"
                                placeholder="Nome, CPF ou Matrícula..." value="<?= htmlspecialchars($busca) ?>">
                        </div>
                        <div class="col-md-3">
                            <label>Status</label>
                            <select name="filtro_status" class="form-select">
                                <option value="Todos" <?= $filtro_status == 'Todos' ? 'selected' : '' ?>>Todos</option>
                                <option value="Ativo(a)" <?= $filtro_status == 'Ativo(a)' ? 'selected' : '' ?>>Ativo
                                </option>
                                <option value="Inativo(a)" <?= $filtro_status == 'Inativo(a)' ? 'selected' : '' ?>>
                                    Inativo</option>
                                <option value="Suspenso(a)" <?= $filtro_status == 'Suspenso(a)' ? 'selected' : '' ?>>
                                    Suspenso</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Adimplência</label>
                            <select name="filtro_adimplencia" class="form-select">
                                <option value="Todos" <?= $filtro_adimplencia == 'Todos' ? 'selected' : '' ?>>Todos
                                </option>
                                <option value="Adimplente" <?= $filtro_adimplencia == 'Adimplente' ? 'selected' : '' ?>>
                                    Adimplentes</option>
                                <option value="Inadimplente" <?= $filtro_adimplencia == 'Inadimplente' ? 'selected' : '' ?>>Inadimplentes</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Aniversários</label>
                            <select name="filtro_aniversario" class="form-select">
                                <option value="Todos" <?= $filtro_aniversario == 'Todos' ? 'selected' : '' ?>>Todos
                                </option>
                                <option value="MesAtual" <?= $filtro_aniversario == 'MesAtual' ? 'selected' : '' ?>>
                                    Aniversariantes deste mês</option>
                                <option value="ProximoMes" <?= $filtro_aniversario == 'ProximoMes' ? 'selected' : '' ?>>
                                    Aniversariantes do próximo mês</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-3 d-flex justify-content-end gap-2">
                            <button class="btn btn-primary" type="submit">Filtrar</button>
                            <a href="inicio.php" class="btn btn-secondary">Limpar</a>
                        </div>
                    </form>
                </div>

                <!-- Tabela -->
                <div class="card border-0 p-3 mt-4">

                    <div id="area-para-impressao">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Resultados</h4>

                        </div>

                        <div class="table-responsive mt-2">
                            <table class="table table-hover align-middle">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Nascimento</th>
                                        <th>Idade</th>
                                        <th>Contato</th>
                                        <th>Situação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($socios_filtrados as $row): ?>
                                        <tr class="position-relative" style="cursor:pointer">

                                            <td><?= htmlspecialchars($row['matricula']) ?>

                                                <a href="exibir-socio.php?id=<?= $row['id'] ?>" class="stretched-link"
                                                    aria-label="Ver sócio <?= htmlspecialchars($row['nome']) ?>"></a>

                                            </td>

                                            <td><?= htmlspecialchars($row['nome']) ?></td>
                                            <td><?= htmlspecialchars(formatarCPF($row['cpf'])) ?></td>
                                            <td>
                                                <?php
                                                $dataNascimento = new DateTime($row['data_nascimento']);
                                                $hoje = new DateTime();
                                                $idade = $hoje->diff($dataNascimento)->y;

                                                echo $dataNascimento->format('d/m/Y');
                                                ?>
                                            </td>
                                            <td><?php echo $idade . ' anos'; ?></td>
                                            <td><?= htmlspecialchars(formatarTelefone($row['celular'])) ?></td>
                                            <td>
                                                <?php
                                                // Lógica para definir a situação e a cor do badge
                                                $situacao = '';
                                                $cor_badge = '';

                                                if ($row['stat'] === 'Inativo(a)') {
                                                    $situacao = 'Inativo(a)';
                                                    $cor_badge = 'bg-secondary';
                                                } elseif ($row['stat'] === 'Suspenso(a)') {
                                                    $situacao = 'Suspenso(a)';
                                                    $cor_badge = 'bg-warning text-dark';
                                                } else {
                                                    // Se estiver Ativo, verificamos a adimplência calculada
                                                    if ($row['adimplencia_calculada'] === 'Adimplente') {
                                                        $situacao = 'Adimplente';
                                                        $cor_badge = 'bg-success';
                                                    } else {
                                                        $situacao = 'Inadimplente';
                                                        $cor_badge = 'bg-danger';
                                                    }
                                                }
                                                ?>
                                                <span class="badge <?= $cor_badge ?>">
                                                    <?= $situacao ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<script src="js/imprimir.js"></script>


<?php require_once("includes/footer.php"); ?>