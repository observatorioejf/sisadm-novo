<?php


class LogController {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
        mysqli_select_db($this->conn, "adm");
    }

    public function saveLoginSuccess($user){
        $ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
        $hora = date('Y-m-d H:i:s');
        $usuario = $user;
        $tabela = "-";
        $sistema = "sisadmin";

        $mensagem = "Logon confirmado.";
        $mensagem = mysqli_real_escape_string($this->conn, $mensagem);

        mysqli_select_db($this->conn, "adm") or print(mysqli_error($this->conn));

        $sql = "INSERT INTO logs VALUES (NULL, '" . $hora . "', '" . $ip . "', '" . $mensagem . "', '" . $tabela . "', '" . $usuario . "', '" . $sistema . "')";
        mysqli_query($this->conn, $sql);
    }

    public function saveLoginFail($login){
        $ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
        $hora = date('Y-m-d H:i:s');
        $usuario = $login;
        $tabela = "-";
        $sistema = "sisadmin";

        $mensagem = "Falha no Logon.";
        $mensagem = mysqli_real_escape_string($this->conn, $mensagem);

        mysqli_select_db($this->conn, "adm") or print(mysqli_error($this->conn));

        $sql = "INSERT INTO logs VALUES (NULL, '" . $hora . "', '" . $ip . "', '" . $mensagem . "', '" . $tabela . "', '" . $usuario . "', '" . $sistema . "')";
        mysqli_query($this->conn, $sql);
    }

}