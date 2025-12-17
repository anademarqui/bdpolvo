<?php
require_once("includes/header.php");

// require_once("includes/seguranca.php");
// require_once("includes/conexao.php");
?>


    <div class="d-flex min-vh-100">

        <!-- Menu lateral -->
        <?php require_once("includes/menu.php"); ?>

        <!-- Formulário -->
        <div class="container">

            <div class="flex-grow-1 overflow-auto" style="max-height: 100vh;">
                <div class="card p-3 border-0 rounded-0" style="background-color:rgb(172, 201, 244);">

                    <?php if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        $socio = $mysqli->query("SELECT * FROM socios WHERE id = $id");
                        $endereco = $mysqli->query("SELECT * FROM endereco_socios WHERE id_socio = $id");


                        if ($socio->num_rows > 0) {
                            $row = $socio->fetch_assoc();
                        }

                        if ($endereco->num_rows > 0) {
                            $rowEndereco = $endereco->fetch_assoc();
                        }
                        ?>

                        <h2 class="mt-3">Alterar Dados</h2>

                        <div class="card border-0 py-3 px-4 mt-4">

                            <form action="includes/acoes.php" method="POST">

                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                <div class="row mt-2">

                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-user me-2 fa-2x"></i>
                                        <h4 class="my-4">Dados Pessoais</h4>
                                    </div>
                                    <hr>

                                    <div class="col-md-8">
                                        <label>Nome Completo</label>
                                        <input type="text" name="nome" class="form-control" required
                                            value="<?php echo htmlspecialchars($row['nome']); ?>">
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <label>Nº Matrícula</label>
                                        <input type="text" name="matricula" class="form-control" required
                                            value="
                                            
                                            ">
                                    </div> -->
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <label>Data de Nascimento</label>
                                            <input type="date" name="data_nascimento" class="form-control" required
                                                value="<?php echo $row['data_nascimento']; ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Natural de</label>
                                            <input type="text" name="nasc_cidade" class="form-control"
                                                value="<?php echo $row['nasc_cidade']; ?>">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <label>CPF</label>
                                            <input type="text" name="cpf" class="form-control"
                                                value="<?php echo htmlspecialchars($row['cpf']); ?>" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>RG</label>
                                            <input type="text" name="rg" class="form-control"
                                                value="<?php echo htmlspecialchars($row['rg']); ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Órgão Emissor</label>
                                            <input type="text" name="orgao" class="form-control"
                                                value="<?php echo htmlspecialchars($row['orgao']); ?>">
                                        </div>

                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <label>Sexo</label>
                                            <select name="sexo" class="form-select">
                                                <option value="Masculino" <?php echo ($row['sexo'] == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                                                <option value="Feminino" <?php echo ($row['sexo'] == 'Feminino') ? 'selected' : ''; ?>>Feminino</option>
                                                <option value="Outro" <?php echo ($row['sexo'] == 'Outro') ? 'selected' : ''; ?>>
                                                    Outro
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nacionalidade</label>
                                            <select name="nacionalidade" class="form-select">
                                                <option value="Brasileiro(a)" <?php echo ($row['nacionalidade'] == 'Brasileiro(a)') ? 'selected' : ''; ?>>
                                                    Brasileiro(a)
                                                </option>
                                                <option value="Estrangeiro(a)" <?php echo ($row['nacionalidade'] == 'Estrangeiro(a)') ? 'selected' : ''; ?>>
                                                    Estrangeiro(a)</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <label>Celular</label>
                                            <input type="text" name="celular" class="form-control"
                                                value="<?php echo htmlspecialchars($row['celular']); ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Telefone Fixo</label>
                                            <input type="text" name="telefone" class="form-control"
                                                value="<?php echo htmlspecialchars($row['telefone']); ?>">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <label>Grau de instrução</label>
                                            <select name="instrucao" class="form-select">
                                                <option value="Analfabeto(a)" <?php echo ($row['instrucao'] == 'Analfabeto(a)') ? 'selected' : ''; ?>>Analfabeto(a)
                                                </option>
                                                <option value="Ensino Fundamental Completo" <?php echo ($row['instrucao'] == 'Ensino Fundamental Completo') ? 'selected' : ''; ?>>
                                                    Ensino Fundamental Completo
                                                </option>
                                                <option value="Ensino Fundamental Incompleto" <?php echo ($row['instrucao'] == 'Ensino Fundamental Incompleto') ? 'selected' : ''; ?>>
                                                    Ensino Fundamental Incompleto
                                                </option>
                                                <option value="Ensino Médio Completo" <?php echo ($row['instrucao'] == 'Ensino Médio Completo') ? 'selected' : ''; ?>>Ensino Médio Completo</option>
                                                <option value="Ensino Médio Incompleto" <?php echo ($row['instrucao'] == 'Ensino Médio Incompleto') ? 'selected' : ''; ?>>
                                                    Ensino Médio Incompleto</option>
                                                <option value="Superior Completo" <?php echo ($row['instrucao'] == 'Superior Completo') ? 'selected' : ''; ?>>Superior Completo</option>
                                                <option value="Superior Incompleto" <?php echo ($row['instrucao'] == 'Superior Incompleto') ? 'selected' : ''; ?>>Superior Incompleto</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Situação socioeconômica</label>
                                            <input type="text" name="economic" class="form-control"
                                                value="<?php echo htmlspecialchars($row['economic']); ?>">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-user-group me-2 fa-2x"></i>
                                            <h4 class="my-3">Família</h4>
                                        </div>
                                        <hr>

                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label>Nome do Pai</label>
                                            <input type="text" name="pai" class="form-control"
                                                value="<?php echo htmlspecialchars($row['pai']); ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Nome da Mãe</label>
                                            <input type="text" name="mae" class="form-control"
                                                value="<?php echo htmlspecialchars($row['mae']); ?>">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <label>Estado Civil</label>
                                            <select name="civil" class="form-select">
                                                <option value="Solteiro(a)" <?php echo ($row['civil'] == 'Solteiro(a)') ? 'selected' : ''; ?>>Solteiro(a)</option>
                                                <option value="Casado(a)" <?php echo ($row['civil'] == 'Casado(a)') ? 'selected' : ''; ?>>Casado(a)</option>
                                                <option value="Divorciado(a)" <?php echo ($row['civil'] == 'Divorciado(a)') ? 'selected' : ''; ?>>Divorciado(a)</option>
                                                <option value="Viúvo(a)" <?php echo ($row['civil'] == 'Viúvo(a)') ? 'selected' : ''; ?>>Viúvo(a)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <label>Nome do Cônjuge</label>
                                            <input type="text" name="conjuge" class="form-control"
                                                value="<?php echo htmlspecialchars($row['conjuge']); ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Data de Nasc. do Cônjuge</label>
                                            <input type="date" name="nasc_conjuge" class="form-control"
                                                value="<?php echo $row['nasc_conjuge']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <label>Telefone para Recados</label>
                                            <input type="text" name="fone_recado" class="form-control"
                                                value="<?php echo $row['fone_recado']; ?>">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-location-dot me-2 fa-2x"></i>
                                            <h4 class="my-4">Endereço</h4>
                                        </div>
                                        <hr>
                                        <div class="col-md-4">
                                            <label>CEP</label>
                                            <input type="text" name="cep" class="form-control"
                                                value="<?php echo htmlspecialchars($rowEndereco['cep']); ?>">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <label>Rua</label>
                                            <input type="text" name="rua" class="form-control"
                                                value="<?php echo htmlspecialchars($rowEndereco['rua']); ?>">
                                        </div>

                                        <div class="col-md-3">
                                            <label>Nº casa</label>
                                            <input type="text" name="numero" class="form-control"
                                                value="<?php echo htmlspecialchars($rowEndereco['numero']); ?>">
                                        </div>

                                        <div class="col-md-3">
                                            <label>Complemento</label>
                                            <input type="text" name="complemento" class="form-control"
                                                value="<?php echo htmlspecialchars($rowEndereco['complemento']); ?>">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-5">
                                            <label>Bairro</label>
                                            <input type="text" name="bairro" class="form-control"
                                                value="<?php echo htmlspecialchars($rowEndereco['bairro']); ?>">
                                        </div>
                                        <div class="col-md-5">
                                            <label>Cidade</label>
                                            <input type="text" name="cidade" class="form-control"
                                                value="<?php echo htmlspecialchars($rowEndereco['cidade']); ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label>Estado</label>
                                            <select name="estado" class="form-select">
                                                <option value="AC" <?php echo ($rowEndereco['estado'] == 'AC') ? 'selected' : ''; ?>>
                                                    AC</option>
                                                <option value="AL" <?php echo ($rowEndereco['estado'] == 'AL') ? 'selected' : ''; ?>>
                                                    AL</option>
                                                <option value="AP" <?php echo ($rowEndereco['estado'] == 'AP') ? 'selected' : ''; ?>>
                                                    AP</option>
                                                <option value="AM" <?php echo ($rowEndereco['estado'] == 'AM') ? 'selected' : ''; ?>>
                                                    AM</option>
                                                <option value="BA" <?php echo ($rowEndereco['estado'] == 'BA') ? 'selected' : ''; ?>>
                                                    BA</option>
                                                <option value="CE" <?php echo ($rowEndereco['estado'] == 'CE') ? 'selected' : ''; ?>>
                                                    CE</option>
                                                <option value="DF" <?php echo ($rowEndereco['estado'] == 'DF') ? 'selected' : ''; ?>>
                                                    DF</option>
                                                <option value="ES" <?php echo ($rowEndereco['estado'] == 'ES') ? 'selected' : ''; ?>>
                                                    ES</option>
                                                <option value="GO" <?php echo ($rowEndereco['estado'] == 'GO') ? 'selected' : ''; ?>>
                                                    GO</option>
                                                <option value="MA" <?php echo ($rowEndereco['estado'] == 'MA') ? 'selected' : ''; ?>>
                                                    MA</option>
                                                <option value="MT" <?php echo ($rowEndereco['estado'] == 'MT') ? 'selected' : ''; ?>>
                                                    MT</option>
                                                <option value="MS" <?php echo ($rowEndereco['estado'] == 'MS') ? 'selected' : ''; ?>>
                                                    MS</option>
                                                <option value="MG" <?php echo ($rowEndereco['estado'] == 'MG') ? 'selected' : ''; ?>>
                                                    MG</option>
                                                <option value="PA" <?php echo ($rowEndereco['estado'] == 'PA') ? 'selected' : ''; ?>>
                                                    PA</option>
                                                <option value="PB" <?php echo ($rowEndereco['estado'] == 'PB') ? 'selected' : ''; ?>>
                                                    PB</option>
                                                <option value="PR" <?php echo ($rowEndereco['estado'] == 'PR') ? 'selected' : ''; ?>>
                                                    PR</option>
                                                <option value="PE" <?php echo ($rowEndereco['estado'] == 'PE') ? 'selected' : ''; ?>>
                                                    PE</option>
                                                <option value="PI" <?php echo ($rowEndereco['estado'] == 'PI') ? 'selected' : ''; ?>>
                                                    PI</option>
                                                <option value="RJ" <?php echo ($rowEndereco['estado'] == 'RJ') ? 'selected' : ''; ?>>
                                                    RJ</option>
                                                <option value="RN" <?php echo ($rowEndereco['estado'] == 'RN') ? 'selected' : ''; ?>>
                                                    RN</option>
                                                <option value="RS" <?php echo ($rowEndereco['estado'] == 'RS') ? 'selected' : ''; ?>>
                                                    RS</option>
                                                <option value="RO" <?php echo ($rowEndereco['estado'] == 'RO') ? 'selected' : ''; ?>>
                                                    RO</option>
                                                <option value="RR" <?php echo ($rowEndereco['estado'] == 'RR') ? 'selected' : ''; ?>>
                                                    RR</option>
                                                <option value="SC" <?php echo ($rowEndereco['estado'] == 'SC') ? 'selected' : ''; ?>>
                                                    SC</option>
                                                <option value="SP" <?php echo ($rowEndereco['estado'] == 'SP') ? 'selected' : ''; ?>>
                                                    SP</option>
                                                <option value="SE" <?php echo ($rowEndereco['estado'] == 'SE') ? 'selected' : ''; ?>>
                                                    SE</option>
                                                <option value="TO" <?php echo ($rowEndereco['estado'] == 'TO') ? 'selected' : ''; ?>>
                                                    TO</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <label>Tipo de Moradia</label>
                                            <select name="moradia" class="form-select">
                                                <option value="Própria" <?php echo ($rowEndereco['moradia'] == 'Própria') ? 'selected' : ''; ?>>Própria</option>
                                                <option value="Alugada" <?php echo ($rowEndereco['moradia'] == 'Alugada') ? 'selected' : ''; ?>>Alugada</option>
                                                <option value="Cedida" <?php echo ($rowEndereco['moradia'] == 'Cedida') ? 'selected' : ''; ?>>Cedida</option>
                                                <option value="Outros" <?php echo ($rowEndereco['moradia'] == 'Outros') ? 'selected' : ''; ?>>Outros</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Mora: </label>
                                            <select name="acomp" class="form-select">
                                                <option value="Sozinho(a)" <?php echo ($row['acomp'] == 'Sozinho(a)') ? 'selected' : ''; ?>>Sozinho(a)</option>
                                                <option value="C/Companheiro(a)" <?php echo ($row['acomp'] == 'C/Companheiro(a)') ? 'selected' : ''; ?>>
                                                    C/Companheiro(a)</option>
                                                <option value="C/Familiares" <?php echo ($row['acomp'] == 'C/Familiares') ? 'selected' : ''; ?>>C/Familiares</option>
                                                <option value="Outros" <?php echo ($row['acomp'] == 'Outros') ? 'selected' : ''; ?>>Outros</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row mt-4">
                                        <div class="d-flex align-items-center me-2 fa-2x">
                                            <i class="fa-solid fa-heart-pulse"></i>
                                            <h4 class="my-4">Dados - Saúde</h4>
                                        </div>
                                        <hr>
                                        <div class="col-md-3">
                                            <label>Grupo Sanguíneo</label>
                                            <select name="tipo_sang" class="form-select">
                                                <option value="A" <?php echo ($row['tipo_sang'] == 'A') ? 'selected' : ''; ?>>
                                                    A
                                                </option>
                                                <option value="B" <?php echo ($row['tipo_sang'] == 'B') ? 'selected' : ''; ?>>
                                                    B
                                                </option>
                                                <option value="AB" <?php echo ($row['tipo_sang'] == 'AB') ? 'selected' : ''; ?>>AB
                                                </option>
                                                <option value="O" <?php echo ($row['tipo_sang'] == 'O') ? 'selected' : ''; ?>>
                                                    O
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Fator RH</label>
                                            <select name="rh" class="form-select">
                                                <option value="Positivo" <?php echo ($row['rh'] == 'Positivo') ? 'selected' : ''; ?>>
                                                    Positivo</option>
                                                <option value="Negativo" <?php echo ($row['rh'] == 'Negativo') ? 'selected' : ''; ?>>
                                                    Negativo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <label>PCD / Mobilidade Reduzida</label>
                                            <input type="text" name="pcd" class="form-control"
                                                value="<?php echo htmlspecialchars($row['pcd']); ?>">
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <label>Alergias</label>
                                            <textarea name="alergias"
                                                class="form-control"><?php echo htmlspecialchars($row['alergias']); ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="d-flex align-items-center">
                                            <h4 class="my-4">Status</h4>
                                        </div>
                                        <hr>
                                        <div class="col-md-4">
                                            <select name="stat" class="form-select">
                                                <option value="Ativo(a)" <?php echo ($row['stat'] == 'Ativo(a)') ? 'selected' : ''; ?>>Ativo(a)</option>
                                                <option value="Inativo(a)" <?php echo ($row['stat'] == 'Inativo(a)') ? 'selected' : ''; ?>>Inativo(a)</option>
                                                <option value="Suspenso(a)" <?php echo ($row['stat'] == 'Suspenso(a)') ? 'selected' : ''; ?>>Suspenso(a)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <a href="listar.php" class="btn btn-secondary mt-4 me-2">Voltar</a>
                                        <button type="submit" name="salvar_edicao"
                                            class="btn btn-primary mt-4">Salvar</button>
                                    </div>
                            </form>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <script src="includes/cep.js"></script>

<?php require_once("includes/footer.php"); ?>