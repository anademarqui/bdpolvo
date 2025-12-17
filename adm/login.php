<?php
require_once("../includes/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        body {
            background-color:rgb(172, 201, 244);
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo {
            width: 150px;
            border-radius: 50%;
        }
    </style>


    <title>Entrar</title>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="col-md-4 border p-4 rounded shadow bg-white">
            
            <div class="col mb-4 d-flex justify-content-center align-items-center">
                <img src="../img/logo.png" class="logo">
            </div>


            <form action="action.php" method="POST">

                <div class="row mb-4">
                    <div class="col">
                        <i class="fa-solid fa-user mx-2"></i>
                        <label class="form-label">Administrador</label>
                        <input type="text" name="usuario" class="form-control">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <i class="fa-solid fa-lock mx-2"></i>
                        <label class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control">
                    </div>
                </div>
                <div>
                    <input type="submit" class="btn btn-primary mt-3 w-100" name="entrar" value="ENTRAR">
                </div>

            </form>

        </div>
    </div>

</body>

</html>