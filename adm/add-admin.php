<?php

require_once("../includes/conexao.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

    <title>ADM</title>
</head>
<body>
    
    <?php
    
        if (isset($_POST['enviar'])) {

            $user = $_POST['usuario'];
            $password = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $verifica = $mysqli->query("SELECT polvo_usuario FROM polvo_adm WHERE polvo_usuario = '$user'");
            if ($verifica->num_rows > 0) {
                echo "<p>Nome de usuário já existente. Escolha outro.</p>";
            } else {

                $insere = $mysqli -> query("INSERT INTO polvo_adm (
                    polvo_usuario,
                    polvo_senha
                    ) VALUES (
                        '$user',
                        '$password'
                    ) ");

                if ($insere) {
                    echo "<p>Cadastro realizado com sucesso!</p>";
                } else {
                    echo "<p>Erro ao cadastrar: " . $mysqli->error . "</p>";
                }

            } 
        }
        
    ?>


    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="col-md-6 border p-4 rounded shadow bg-light">
            <h2 class="text-center mb-4">Cadastro de Administrador</h2>
            
            <form action="" method="POST" enctype="multipart/form-data">
        
     
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="usuario" class="form-label">Usuário:</label>
                        <input type="text" class="form-control" name="usuario" placeholder="seunome">
                    </div>
                    <div class="col-md-6">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" class="form-control" name="senha" placeholder="********">
                    </div>
                </div>
        
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="enviar">Cadastrar</button>
                </div>

            </form>

        </div>
    </div>

</body>
</html>

