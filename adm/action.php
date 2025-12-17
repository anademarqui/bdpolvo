<?php
require_once("../includes/conexao.php");

// ------------------------- ENTRAR / LOGIN ADM
if (isset($_POST['entrar'])) {
    session_start(); 

    $usuario = $_POST['usuario']; 
    $senha = $_POST['senha']; 

    // Preparar a consulta para procurar o usuário no banco de dados
    $stmt = $mysqli->prepare("SELECT id, polvo_senha FROM polvo_adm WHERE polvo_usuario = ?");
    $stmt->bind_param("s", $usuario); 
    $stmt->execute(); 
    $stmt->store_result();

    // Verifica se encontrou o usuário no banco
    if ($stmt->num_rows > 0) {
        // Se o usuário existe, vincula o resultado da senha
        $stmt->bind_result($admin_id, $senha_hash);
        $stmt->fetch();

        // Verifica se a senha fornecida corresponde à senha no banco
        if (password_verify($senha, $senha_hash)) {
            // Se a senha estiver correta, inicia a sessão
            $_SESSION['user'] = $usuario;
            $_SESSION['admin_id'] = $admin_id;
            
            header("Location: ../inicio.php");
            exit;
        } else {
            // Se a senha estiver incorreta
            echo "<script>
                    alert('Senha incorreta. Tente novamente.');
                    window.location.href = 'login.php';
                </script>";
            exit;
        }

    } else {
        // Se o usuário não for encontrado no banco
        echo "<script>
                alert('Usuário não encontrado. Tente novamente.');
                window.location.href = 'login.php';
            </script>";
        exit;
    }
}
// ------------------------- FIM - LOGIN