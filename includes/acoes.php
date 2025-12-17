<?php
session_start();

// Verifica se o admin está logado. Se não estiver, bloqueia todo o resto.
if (!isset($_SESSION['admin_id'])) {
    echo "Acesso negado. Por favor, faça o login.";
    // Ou redireciona para o login:
    // header("Location: login.php");
    exit(); // Para a execução do script IMEDIATAMENTE
}

// Pega o ID do admin que está logado
$id_admin_logado = $_SESSION['admin_id'];


// ------------------------- BUSCAR NOME POR CPF
if (isset($_GET['cpf'])) {
    require_once("conexao.php");
    header('Content-Type: application/json');

    $cpf = $mysqli->real_escape_string($_GET['cpf']);
    $query = $mysqli->query("SELECT nome FROM socios WHERE cpf = '$cpf'");

    if ($query && $query->num_rows > 0) {
        $row = $query->fetch_assoc();
        echo json_encode(['nome' => $row['nome']]);
    } else {
        echo json_encode(['nome' => null]);
    }
    exit;
}
// ------------------------- fim BUSCAR


require_once("conexao.php");

// ------------------------- CADASTRAR
if (isset($_POST['salvar'])) {
    $matricula = $_POST['matricula'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $orgao = $_POST['orgao'];
    $data_nascimento = $_POST['data_nascimento'];
    $nasc_cidade = $_POST['nasc_cidade'];
    $nacionalidade = $_POST['nacionalidade'];
    $sexo = $_POST['sexo'];
    $civil = $_POST['civil'];
    $celular = preg_replace('/\D/', '', $_POST['celular']); // remove parênteses, traços, espaços etc.

    $telefone = $_POST['telefone'];
    $economic = $_POST['economic'];
    $instrucao = $_POST['instrucao'];
    $pai = $_POST['pai'];
    $mae = $_POST['mae'];
    $conjuge = $_POST['conjuge'];
    $nasc_conjuge = $_POST['nasc_conjuge'];
    $fone_recado = $_POST['fone_recado'];
    $acomp = $_POST['acomp'];
    $tipo_sang = $_POST['tipo_sang'];
    $rh = $_POST['rh'];
    $pcd = $_POST['pcd'];
    $alergias = $_POST['alergias'];
    $status = $_POST['stat'];

    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $moradia = $_POST['moradia'];

    $insere_socio = $mysqli->query("INSERT INTO socios (
            matricula, nome, cpf, rg, orgao, data_nascimento, nasc_cidade, nacionalidade, sexo, civil, celular, telefone, economic, instrucao, pai, mae, conjuge, nasc_conjuge, fone_recado, acomp, tipo_sang, rh, pcd, alergias, stat
            ) VALUES (
                '$matricula','$nome','$cpf','$rg','$orgao','$data_nascimento','$nasc_cidade','$nacionalidade','$sexo','$civil','$celular','$telefone','$economic','$instrucao','$pai','$mae','$conjuge','$nasc_conjuge','$fone_recado', '$acomp', '$tipo_sang','$rh','$pcd','$alergias','$status'
            )
        ");

    if ($insere_socio) {
        $id_socio = $mysqli->insert_id;

        $insere_endereco = $mysqli->query("INSERT INTO endereco_socios (
                id_socio, cep, rua, numero, complemento, bairro, cidade, estado, moradia
                ) VALUES (
                    '$id_socio','$cep','$rua','$numero','$complemento','$bairro','$cidade','$estado','$moradia'
                )
            ");

        if ($insere_endereco) {
            header("Location: ../exibir-socio.php?id=" . $id_socio);
        } else {
            echo "Erro ao inserir endereço: " . $mysqli->error;
        }
    } else {
        echo "Erro ao inserir sócio: " . $mysqli->error;
    }
}
// ------------------------- fim CADASTRAR


// ------------------------- EDITAR CADASTRO
if (isset($_POST['salvar_edicao']) && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg'];
    $orgao = $_POST['orgao'];
    $data_nascimento = $_POST['data_nascimento'];
    $nasc_cidade = $_POST['nasc_cidade'];
    $nacionalidade = $_POST['nacionalidade'];
    $sexo = $_POST['sexo'];
    $civil = $_POST['civil'];
    $celular = $_POST['celular'];
    $telefone = $_POST['telefone'];
    $economic = $_POST['economic'];
    $instrucao = $_POST['instrucao'];
    $pai = $_POST['pai'];
    $mae = $_POST['mae'];
    $conjuge = $_POST['conjuge'];
    $nasc_conjuge = $_POST['nasc_conjuge'];
    $fone_recado = $_POST['fone_recado'];
    $acomp = $_POST['acomp'];
    $tipo_sang = $_POST['tipo_sang'];
    $rh = $_POST['rh'];
    $pcd = $_POST['pcd'];
    $alergias = $_POST['alergias'];
    $status = $_POST['stat'];

    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $moradia = $_POST['moradia'];

    $editar = $mysqli->query("UPDATE socios SET
                            nome = '$nome',
                            cpf = '$cpf',
                            rg = '$rg',
                            orgao = '$orgao',
                            data_nascimento = '$data_nascimento',
                            nasc_cidade = '$nasc_cidade',
                            nacionalidade = '$nacionalidade',
                            sexo = '$sexo',
                            civil = '$civil',
                            celular = '$celular',
                            telefone = '$telefone',
                            economic = '$economic',
                            instrucao = '$instrucao',
                            pai = '$pai',
                            mae = '$mae',
                            conjuge = '$conjuge',
                            nasc_conjuge = '$nasc_conjuge',
                            fone_recado = '$fone_recado',
                            acomp = '$acomp',
                            tipo_sang = '$tipo_sang',
                            rh = '$rh',
                            pcd = '$pcd',
                            alergias = '$alergias',
                            stat = '$status'
                        WHERE id = $id");

    $editarEndereco = $mysqli->query("UPDATE endereco_socios SET
                                    cep = '$cep',
                                    rua = '$rua',
                                    numero = '$numero',
                                    complemento = '$complemento',
                                    bairro = '$bairro',
                                    cidade = '$cidade',
                                    estado = '$estado',
                                    moradia = '$moradia'
                                WHERE id_socio = $id");

    if ($editar && $editarEndereco) {
        header("Location: ../exibir-socio.php?id=" . $id);
        exit;
    } else {
        echo "Erro ao atualizar dados: " . $mysqli->error;
    }
} else {
    echo "ID do sócio não informado.";
}
// ------------------------- fim EDITAR


// ------------------------- CADASTRAR PAGAMENTOS
if (isset($_POST['salvar-pg']) && isset($_POST['cpf'])) {
    $cpf = $_POST['cpf'];

    // Verificar se o CPF existe na tabela socios
    $result = $mysqli->query("SELECT id FROM socios WHERE cpf = '$cpf'");

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_socio = $row['id'];
    } else {
        echo "Erro: Sócio com CPF $cpf não encontrado!";
        exit;
    }

    $forma_pg = $_POST['forma_pg'];
    $valor = $_POST['valor'];
    $parcelas = $_POST['parcelas'];
    $data_pg = $_POST['data_pg'];
    $vencimento = $_POST['vencimento'];
    $obs = $_POST['obs'];

    $insere_pg = $mysqli->query("INSERT INTO pagamento (
                id_socio, id_adm, forma_pg, valor, parcelas, data_pg, vencimento, obs
            ) VALUES (
                '$id_socio','$id_admin_logado', '$forma_pg', '$valor', '$parcelas', '$data_pg', '$vencimento', '$obs'
            )");

    if ($insere_pg) {
        header("Location: ../exibir-socio.php?id=" . $id_socio);
    } else {
        echo "Erro ao cadastrar pagamento: " . $mysqli->error;
    }
}

// ------------------------- fim PAGAMENTO


// ------------------------ EXCLUIR PAGAMENTO
if (isset($_POST['excluir']) && isset($_POST['id_pagamento'])) {
    $id_pagamento = $_POST['id_pagamento'];

    $result = $mysqli->query("SELECT id_socio FROM pagamento WHERE id_pagamento = $id_pagamento");

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_socio = $row['id_socio'];

            $excluir = $mysqli->query("DELETE FROM pagamento WHERE id_pagamento = $id_pagamento");

            if ($excluir) {
                echo "<script>
                            alert('Pagamento deletado!');
                            window.location.href = '../exibir-socio.php?id=" . $id_socio . "';
                        </script>";
            } else {
                // Caso o DELETE falhe
                echo "<script>
                            alert('Erro ao excluir o pagamento :( Tente novamente.');
                            window.location.href = '../exibir-socio.php?id=" . $id_socio . "';
                    </script>";
            }
        } else {
            // Caso não tenha sido encontrado nenhum pagamento com esse id
            echo "<script>
                        alert('Pagamento não encontrado...');
                        window.location.href = '../exibir-socio.php?id=" . $id_socio . "';
                    </script>";
        }
    } else {
        // Se a consulta SELECT falhou
        echo "<script>
                    alert('Erro ao verificar o pagamento no banco de dados.');
                    window.location.href = '../exibir-socio.php?id=" . $id_socio . "';
                </script>";
    }
}
// ------- FIM EXCLUIR PAGAMENTO

// ------------------------- EDITAR PAGAMENTO
if (isset($_POST['salvar_edicao_pg'])) {
    // 1. Coletar e validar os dados do formulário
    $id_pagamento = (int)$_POST['id_pagamento'];
    $id_socio = (int)$_POST['id_socio']; // Precisamos para o redirecionamento

    $forma_pg = $_POST['forma_pg'];
    $valor = $_POST['valor']; // Considere validar/formatar como número
    $parcelas = (int)$_POST['parcelas'];
    $data_pg = $_POST['data_pg'];
    $vencimento = $_POST['vencimento'];
    $obs = $_POST['obs'];

    // 2. Preparar a consulta SQL para evitar SQL Injection
    $sql = "UPDATE pagamento SET 
                forma_pg = ?, 
                valor = ?, 
                parcelas = ?, 
                data_pg = ?, 
                vencimento = ?, 
                obs = ? 
            WHERE id_pagamento = ?";

    $stmt = $mysqli->prepare($sql);

    // 3. Associar os parâmetros (s=string, d=double, i=integer)
    // Tipos: s, d, i, s, s, s, i
    $stmt->bind_param("sdisssi", $forma_pg, $valor, $parcelas, $data_pg, $vencimento, $obs, $id_pagamento);

    // 4. Executar e verificar o resultado
    if ($stmt->execute()) {
        echo "<script>
            alert('Pagamento atualizado com sucesso!');
            window.location.href = '../exibir-socio.php?id=" . $id_socio . "';
        </script>";
    } else {
        echo "<script>
            alert('Erro ao atualizar o pagamento. Tente novamente.');
            window.location.href = '../editar-pg.php?id_pagamento=" . $id_pagamento . "';
        </script>";
    }

    $stmt->close();
    exit;
}
// ------------------------- fim EDITAR PAGAMENTO
