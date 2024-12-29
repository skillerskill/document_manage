<?php
session_start();

// Verifica se o usuário está logado
if (isset($_SESSION['username']) && isset($_SESSION["user_id"] ) && isset($_SESSION["role"])) {
    // Destroi a sessão
    session_unset();
    session_destroy();
}

// Redireciona para a página de login
header('Location: index.php');
exit();
?>
