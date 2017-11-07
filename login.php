<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISADM - Login</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="css/font-awesome.css" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
</head>

<body class="login-body">
<div class="container">
    <form id="frmLogin" class="form-signin" action="controle.php" method="post">
        <h2 class="form-signin-heading">SISADM</h2>
        <div class="login-wrap">
            <input type="text" name="login" class="form-control" placeholder="Usuário" autofocus>
            <input type="password" name="senha" class="form-control" placeholder="Senha">
            <button class="btn btn-lg btn-login btn-block" type="submit" name="enviar" value="Login">Entrar</button>
            <center><a href="../../login.php" style="">Voltar</a></center>
        </div>
    </form>
</div>

<!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    //Ao clicar no botão de login, é feita uma requisição ajax
    $("#frmLogin").submit(function (event) {
        //Previne que seja feito o submit autmático do form
        event.preventDefault();

        //Transforma os dados do form em string e adiciona qual a ação a ser feita
        var data = $("#frmLogin").serialize() + '&action=login';

        $.ajax({
            url: 'router.php',
            type: 'POST',
            data: data,
            success: function (data) {
                var resposta = JSON.parse(data);
                if (resposta.result == true)
                    window.location = 'index.php';
                else
                    alert('Login ou senha incorretos.');
            }, error: function () {
                alert('Houve um erro no servidor.')
            }
        });

    });
</script>

</body>

</html>
