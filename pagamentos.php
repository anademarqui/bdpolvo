<?php
require_once("includes/header.php");

// require_once("includes/seguranca.php");
// require_once("includes/conexao.php");

// Variável de controle para verificar se temos um id válido
$row = null;

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca o CPF associado ao ID
    $cpf_query = $mysqli->query("SELECT id, cpf FROM socios WHERE id = $id");

    // Se o ID existir na base, recupera os dados
    if ($cpf_query->num_rows > 0) {
        $row = $cpf_query->fetch_assoc();
    } else {
        echo "Sócio não encontrado!";
        exit; // Encerra o script se o sócio não for encontrado
    }
}

?>

    <div class="d-flex min-vh-100">

        <!-- Menu lateral -->
        <?php require_once("includes/menu.php"); ?>


        <!-- FORMS -->
        <div class="container">
            <div class="flex-grow-1 overflow-auto" style="max-height: 100vh;">
                <div class="card p-3 border-0 rounded-0" style="background-color:rgb(172, 201, 244);">

                    <h2 class="mt-3">Inserir Pagamento</h2>

                    <div class="card border-0 py-3 px-4 mt-4">

                        <form action="includes/acoes.php" method="POST">

                            <?php if ($row) { ?>

                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <label>CPF</label>
                                        <input type="text" name="cpf" id="cpf" class="form-control"
                                            value="<?php echo htmlspecialchars($row['cpf']); ?>" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Data do Pagamento</label>
                                        <input type="date" name="data_pg" class="form-control" required>
                                    </div>
                                </div>
                               
                            <?php } else { ?>
                                <!-- Quando não temos o id, permite inserir um novo CPF -->

                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <label>CPF</label>
                                        <input type="text" name="cpf" id="cpf" class="form-control" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Data do Pagamento</label>
                                        <input type="date" name="data_pg" class="form-control" required>
                                    </div>
                                </div>
                                     <?php } ?>
                            
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <small id="nome-socio" class="text-muted"></small>
                                </div>
                            </div>


                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Forma de Pagamento</label>
                                    <select name="forma_pg" class="form-select">
                                        <option value="PIX" selected>PIX</option>
                                        <option value="Dinheiro">Dinheiro</option>
                                        <option value="Crédito">Crédito</option>
                                        <option value="Débito">Débito</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>Valor R$</label>
                                    <input type="text" name="valor" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Quantidade Parcelas</label>
                                    <input type="number" min="1" name="parcelas" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Vencimento do Próximo Pagamento</label>
                                    <input type="date" name="vencimento" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col">
                                    <label>Observação:</label>
                                    <textarea name="obs" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="inicio.php" class="btn btn-secondary mt-4 me-2">Voltar</a>
                                <button type="submit" name="salvar-pg" class="btn btn-primary mt-4">Salvar</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>


        <script>
            document.getElementById('cpf').addEventListener('input', function () {
                const cpf = this.value.trim();

                // Para evitar muitas requisições, só buscar se tiver ao menos 8 caracteres
                if (cpf.length >= 8) {
                    fetch('includes/acoes.php?cpf=' + encodeURIComponent(cpf))
                        .then(response => response.json())
                        .then(data => {
                            const nomeSpan = document.getElementById('nome-socio');
                            if (data.nome) {
                                nomeSpan.textContent = 'Nome: ' + data.nome;
                                nomeSpan.classList.remove('text-danger');
                                nomeSpan.classList.add('text-success');
                            } else {
                                nomeSpan.textContent = 'Sócio não encontrado';
                                nomeSpan.classList.remove('text-success');
                                nomeSpan.classList.add('text-danger');
                            }
                        })
                        .catch(() => {
                            document.getElementById('nome-socio').textContent = 'Erro ao buscar nome';
                        });
                } else {
                    document.getElementById('nome-socio').textContent = '';
                }
            });
        </script>
    </div>

<?php require_once("includes/footer.php"); ?>