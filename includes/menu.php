<?php
require_once("conexao.php");
?>

<!-- MENU LATERAL ESQUERDO -->
<div class="text-white" style="width: 200px; flex-shrink: 0; background-color: #426dae;">

    <div class="text-center mt-3 py-2">
        <img src="img/logo.png" class="w-75" alt="Logo do Centro de Convivência da Terceira Idade Polvo">
    </div>

    <ul class="nav flex-column mt-3">
        <li class="nav-item py-2"><a class="nav-link" href="./inicio.php">INÍCIO</a></li>
        <li class="nav-item py-2"><a class="nav-link" href="./listar.php">LISTAR</a></li>
        <li class="nav-item py-2"><a class="nav-link" href="./historico-pg.php">PAGAMENTOS</a></li>
        <li class="nav-item py-2"><a class="nav-link" href="./cadastrar.php">NOVO CADASTRO</a></li>
        <li class="nav-item py-2"><a class="nav-link" href="./adm/logout.php">SAIR<i
                    class="fa-solid fa-right-from-bracket text-white ms-3"></i></a></li>
    </ul>

    <div class="text-center py-3" style="margin-top: 20px; border-top: 1px solid #6c8bc0;">
        <small style="opacity: 0.8;">Admin: <?php echo htmlspecialchars($_SESSION['user']); ?></small>
    </div>

</div>
<!-- FIM DO MENU -->