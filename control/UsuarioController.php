<?php

include_once 'LogController.php';

class UsuarioController {
    private $conn;
    private $data;

    //Recebe a conexão e os dados da requisição que foi feita
    public function __construct($conn, $data) {
        $this->data = $data;
        $this->conn = $conn;
        mysqli_select_db($this->conn, "adm");

    }

    function buscarTodos() {
        $tabela = $this->data['tabela'];
        $stmt = mysqli_prepare($this->conn, "SELECT * FROM $tabela");
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = Array();
        while ($obj = $result->fetch_assoc()) :
            $oper = "<button id='" . $obj["id_usuario"] . "' title='Editar' type ='submit' class='btn btn-primary btn-xs update'><i class='fa fa-pencil'></i></button>&nbsp;<button id='" . $obj["id_usuario"] . "' title='Excluir' type ='submit' class='btn btn-primary btn-xs excluir'><i class='fa fa-times'></i></button>";
            $obj["operacoes"] = $oper;
            $rows["data"][] = $obj;
        endwhile;

        echo json_encode($rows);
    }

    function buscarPorId() {
        $tabela = $this->data['tabela'];
        $id = $this->data['id'];
        $stmt = mysqli_prepare($this->conn, "SELECT * FROM $tabela WHERE id_usuario=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
//        return $result;
        return json_encode($result->fetch_assoc());
    }

    function alterar() {
        $tabela = $this->data['tabela'];
        $id = $this->data['id'];
        $login = $this->data['login'];
        $senha = $this->data['senha'];
        $tipo_acesso = ($this->data['tipo_acesso'] == "") ? 10 : $this->data['tipo_acesso'];
        $stmt = mysqli_prepare($this->conn, "UPDATE $tabela SET login_usuario=?, senha_usuario=?, id_tipo_acesso=? WHERE id_usuario=?");
        $stmt->bind_param("ssii", $login, $senha, $tipo_acesso, $id);
        $result = $stmt->execute();
        if ($result)
            return '{"code":"200", "message":"Ok"}';
        else
            return '{"code":"400", "message":"Bad request"}';
    }

    function inserir() {
        $tabela = $this->data['tabela'];
        $login = $this->data['login'];
        $senha = $this->data['senha'];
        $tipo_acesso = ($this->data['tipo_acesso'] == "") ? 10 : $this->data['tipo_acesso'];
        $stmt = mysqli_prepare($this->conn, "INSERT INTO $tabela (login_usuario, senha_usuario, id_tipo_acesso) VALUES(?,?,?)") or die('error');
        $stmt->bind_param("ssi", $login, $senha, $tipo_acesso) or die('error');
        $result = $stmt->execute();
        if ($result)
            return '{"code":"200", "message":"Ok"}';
        else
            return '{"code":"400", "message":"Bad request"}';
    }

    function remover() {
        $tabela = $this->data['tabela'];
        $id = $this->data['id'];
        $stmt = mysqli_prepare($this->conn, "DELETE FROM $tabela WHERE id_usuario=?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        if ($result)
            return '{"code":"200", "message":"Ok"}';
        else
            return '{"code":"400", "message":"Bad request"}';
    }

    function login() {
        $login = $this->data['login'];
        $senha = $this->data['senha'];
        $stmt = mysqli_prepare($this->conn, "SELECT * FROM tb_sisadm_usuario where login_usuario=? and senha_usuario=?");
        $stmt->bind_param("ss", $login, $senha);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['UsuarioID'] = $login;
            //Salva no log
            (new LogController($this->conn))->saveLoginSuccess($login);
            return json_encode(Array('result' => true));
        } else {
            //Salva no log
            (new LogController($this->conn))->saveLoginFail($login);
            return json_encode(Array('result' => false));
        }
    }

    function carregarLogs() {
        $stmt = mysqli_prepare($this->conn, "SELECT * FROM logs");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}