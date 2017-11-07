<?php
include ("validacao.php");
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>SISADM</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="css/font-awesome.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-responsive.css" rel="stylesheet" />

    </head>
    <body>
        <section id="container" class="sidebar-closed" style="padding-left: 7%; padding-right: 7%">
            <!--header start-->
            <header class="header blue-bg" style="background-color: #00cccc;text-align: center" >
                <!--logo start-->
                <a href="index.php" class="logo" ><center>SISADM</center></a>
                <!--logo end-->
                <div class="top-nav ">
                    <ul class="nav pull-right top-menu" style="margin-top: 7px">
                        <div class="btn-group">
                            <a href="logout.php">
                                <button id="editable-sample_new" class="btn green">
                                    Sair <i class="fa fa-reply-all"></i>
                                </button>
                            </a>
                        </div>
                    </ul>
                </div>
            </header>
            <!--header end-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper ">
                    <!-- page start-->
                    <form class="form-signin" id="f">
                        <h2 class="form-signin-heading">Escolha o sistema:</h2>
                        <div class="login-wrap">
                            <input class="btn btn-lg btn-login btn-block" type="button" value="Portifolio usuários"  onclick="enviar('portfolio_usuario')"/>
                            <input class="btn btn-lg btn-login btn-block" type="button" value="SAMCJF usuários" onclick="enviar('samcjf_usuario')" />
                            <input class="btn btn-lg btn-login btn-block" type="button" value="SAMJF usuários" onclick="enviar('samjf_usuario')" />
                            <input class="btn btn-lg btn-login btn-block" type="button" value="SAMPRO usuários" onclick="enviar('sampro_usuario')" />
                            <input class="btn btn-lg btn-login btn-block" type="button" value="SAPJE usuários" onclick="enviar('sapje_tb_usuario')" />
                            <input class="btn btn-lg btn-login btn-block" type="button" value="Notícias usuários" onclick="enviar('tb_noticias_usuario')" />
                            <input class="btn btn-lg btn-login btn-block" type="button" value="SISADM usuários" onclick="enviar('tb_sisadm_usuario')" />
                            <input class="btn btn-lg btn-login btn-block" type="button" value="Logs" onclick="window.location.href = 'logs.php'" />
                        </div>
                    </form>
                    <!--page end-->
                </section>

            </section>
            <!--main content end-->
        </section>

        <script src="js/jquery-3.2.1.min.js"></script>
        <!-- js placed at the end of the document so the pages load faster -->
        <script>
            function enviar(tabela) {
                console.log(tabela);
                location.href = 'usuarios.php?tabela='+tabela;
            }
        </script>
    </body>

</html>