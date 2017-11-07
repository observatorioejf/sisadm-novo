<?php

include_once 'conn.php';
include_once 'control/UsuarioController.php';

//Pega qual ação foi solicitada
$action = $_POST['action'];

//Cria uma instância da classe de controle passando a conexão e os dados que foram recebidos no post
$usuarioController = new UsuarioController($conn, $_POST);

//Chama a função que veio na requisição e retorna a resposta
echo $usuarioController->$action();