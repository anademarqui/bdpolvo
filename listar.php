<?php
require_once("includes/header.php");
require_once("includes/list.php");
?>

<div class="d-flex min-vh-100">

    <?php require_once("includes/menu.php"); ?><!-- MENU LATERAL -->

    <div class="container">
        <div class="flex-grow-1 overflow-auto" style="max-height: 100vh;">

            <div id="area-para-impressao">

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <h2>Sócios Cadastrados</h2>

                    <button onclick="imprimirSecao('area-para-impressao')" class="btn btn-primary d-print-none">
                        <i class="fas fa-print me-2"></i>
                        Imprimir Lista
                    </button>
                </div>

                <!-- Card da Tabela -->
                <div class="card border-0 p-3 mt-4">

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

                </div><!-- fim card da tabela -->

            </div><!-- fim área de impressão -->

        </div>
    </div>
</div>

<script src="js/imprimir.js"></script>

<?php require_once("includes/footer.php"); ?>