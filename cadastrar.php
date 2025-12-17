<?php
require_once("includes/header.php");
?>

    <div class="d-flex min-vh-100">

        <!-- Menu lateral -->
        <?php require_once("includes/menu.php"); ?>

        <!-- Formulário -->
        <div class="container">

            <div class="flex-grow-1 overflow-auto" style="max-height: 100vh;">
                <div class="card p-3 border-0 rounded-0" style="background-color:rgb(172, 201, 244);">

                    <h2 class="mt-3">Cadastrar Novo Sócio</h2>

                    <div class="card border-0 py-3 px-4 mt-4">

                        <form action="includes/acoes.php" method="POST">

                            <div class="row">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-user me-2 fa-2x"></i>
                                    <h4 class="my-4">Dados Pessoais</h4>
                                </div>
                                <hr>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-8">
                                    <label>Nome Completo</label>
                                    <input type="text" name="nome" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Nº Matrícula</label>
                                    <input type="text" name="matricula" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Data de Nascimento</label>
                                    <input type="date" name="data_nascimento" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Natural de</label>
                                    <input type="text" name="nasc_cidade" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>CPF</label>
                                    <input type="text" name="cpf" class="form-control" required>
                                    <div class="alert alert-danger mt-2 d-none" role="alert">Insira somente números.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>RG</label>
                                    <input type="text" name="rg" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>Órgão Emissor</label>
                                    <input type="text" name="orgao" class="form-control">
                                </div>

                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Sexo</label>
                                    <select name="sexo" class="form-select">
                                        <option value=""></option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Feminino">Feminino</option>
                                        <option value="Outro">Outro</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Nacionalidade</label>
                                    <select name="nacionalidade" class="form-select">
                                        <option value="Brasileiro(a)" selected>Brasileiro(a)</option>
                                        <option value="Estrangeiro(a)">Estrangeiro(a)</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Celular</label>
                                    <input type="text" name="celular" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>Telefone Fixo</label>
                                    <input type="text" name="telefone" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Grau de instrução</label>
                                    <select name="instrucao" class="form-select">
                                        <option value=""></option>
                                        <option value="Analfabeto(a)">Analfabeto(a)</option>
                                        <option value="Ensino Fundamental Completo">Ensino Fundamental Completo</option>
                                        <option value="Ensino Fundamental Incompleto">Ensino Fundamental Incompleto
                                        </option>
                                        <option value="Ensino Médio Completo">Ensino Médio Completo</option>
                                        <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
                                        <option value="Superior Completo">Superior Completo</option>
                                        <option value="Superior Incompleto">Superior Incompleto</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Situação socioeconômica</label>
                                    <input type="text" name="economic" class="form-control">
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
                                    <input type="text" name="pai" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Nome da Mãe</label>
                                    <input type="text" name="mae" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Estado Civil</label>
                                    <select name="civil" class="form-select">
                                        <option value=""></option>
                                        <option value="Solteiro(a)">Solteiro(a)</option>
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Divorciado(a)">Divorciado(a)</option>
                                        <option value="Viúvo(a)">Viúvo(a)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label>Nome do Cônjuge</label>
                                    <input type="text" name="conjuge" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>Data de Nasc. do Cônjuge</label>
                                    <input type="date" name="nasc_conjuge" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Telefone para Recados</label>
                                    <input type="text" name="fone_recado" class="form-control">
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
                                    <input type="text" name="cep" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label>Rua</label>
                                    <input type="text" name="rua" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label>Nº casa</label>
                                    <input type="text" name="numero" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label>Complemento</label>
                                    <input type="text" name="complemento" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-5">
                                    <label>Bairro</label>
                                    <input type="text" name="bairro" class="form-control">
                                </div>
                                <div class="col-md-5">
                                    <label>Cidade</label>
                                    <input type="text" name="cidade" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label>Estado</label>
                                    <select name="estado" class="form-select">
                                        <option value="AC">AC</option>
                                        <option value="AL">AL</option>
                                        <option value="AP">AP</option>
                                        <option value="AM">AM</option>
                                        <option value="BA">BA</option>
                                        <option value="CE">CE</option>
                                        <option value="DF">DF</option>
                                        <option value="ES">ES</option>
                                        <option value="GO">GO</option>
                                        <option value="MA">MA</option>
                                        <option value="MT">MT</option>
                                        <option value="MS">MS</option>
                                        <option value="MG">MG</option>
                                        <option value="PA">PA</option>
                                        <option value="PB">PB</option>
                                        <option value="PR">PR</option>
                                        <option value="PE">PE</option>
                                        <option value="PI">PI</option>
                                        <option value="RJ">RJ</option>
                                        <option value="RN">RN</option>
                                        <option value="RS">RS</option>
                                        <option value="RO">RO</option>
                                        <option value="RR">RR</option>
                                        <option value="SC">SC</option>
                                        <option value="SP" selected>SP</option>
                                        <option value="SE">SE</option>
                                        <option value="TO">TO</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <label>Tipo de Moradia</label>
                                    <select name="moradia" class="form-select">
                                        <option value=""></option>
                                        <option value="Própria">Própria</option>
                                        <option value="Alugada">Alugada</option>
                                        <option value="Cedida">Cedida</option>
                                        <option value="Outros">Outros</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>Mora: </label>
                                    <select name="acomp" class="form-select">
                                        <option value="Sozinho(a)">Sozinho(a)</option>
                                        <option value="C/Companheiro(a)">C/Companheiro(a)</option>
                                        <option value="C/Familiares">C/Familiares</option>
                                        <option value="Outros">Outros</option>
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
                                        <option value=""></option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Fator RH</label>
                                    <select name="rh" class="form-select">
                                        <option value=""></option>
                                        <option value="Positivo">Positivo</option>
                                        <option value="Negativo">Negativo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label>PCD / Mobilidade Reduzida</label>
                                    <input type="text" name="pcd" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <label>Alergias</label>
                                    <textarea name="alergias" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="d-flex align-items-center">
                                    <h4 class="my-4">Status</h4>
                                </div>
                                <hr>
                                <div class="col-md-4">
                                    <select name="stat" class="form-select">
                                        <option value="Ativo(a)" selected>Ativo(a)</option>
                                        <option value="Inativo(a)">Inativo(a)</option>
                                        <option value="Suspenso(a)">Suspenso(a)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="listar.php" class="btn btn-secondary mt-4 me-2">Voltar</a>
                                <button type="submit" name="salvar" class="btn btn-primary mt-4">Salvar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="js/cep.js"></script>

<?php require_once("includes/footer.php"); ?>