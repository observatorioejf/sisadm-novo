<?php
// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['UsuarioID'])) {
    session_destroy();
    header("Location:login.php");
    exit;
}
