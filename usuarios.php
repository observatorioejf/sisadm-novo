<?php
include("validacao.php");
$validTables = Array('portfolio_usuario', 'samcjf_usuario', 'samjf_usuario', 'sampro_usuario', 'sapje_tb_usuario', 'tb_noticias_usuario', 'tb_sisadm_usuario');
if (isset($_GET['tabela'])) {
    $tabela = $_GET['tabela'];
    if (!in_array($tabela, $validTables))
        header("Location: index.php");
} else
    header("Location: index.php");
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
    <link href="css/font-awesome.css" rel="stylesheet"/>
    <!--        <link rel="stylesheet" type="text/css" href="assets/gritter/css/jquery.gritter.css" />-->
    <!--dynamic table-->
    <link href="css/demo_page.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/DT_bootstrap.css"/>
    <!--toastr-->
    <link href="css/toastr.css" rel="stylesheet" type="text/css"/>
    <!--right slidebar-->
    <!--        <link href="css/slidebars.css" rel="stylesheet">-->
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <style>
        th, td {
            text-align: center;
        }

        .modal-open {
            overflow: scroll;
        }

        html {
            min-height: 101%;
        }
    </style>
</head>
<body>
<section id="container" class="sidebar-closed" style="padding-left: 7%; padding-right: 7%">
    <!--header start-->
    <header class="header blue-bg" style="background-color: #00cccc;text-align: center">
        <!--logo start-->
        <a href="index.php" class="logo">
            <center>SISADM</center>
        </a>
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
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <i class="fa fa-check-square-o fa-1x"></i> <font size="3"><a href="index.php"><b>Voltar</b></a></font><br><br>
                            <a href="#modalInserir" data-toggle="modal">
                                <button id="editable-sample_new" class="btn green">
                                    Adicionar Usuário <i class="fa fa-plus"></i>
                                </button>
                            </a>
                            <center><h3>Tabela "<?php echo $tabela; ?>"</h3></center>
                        </header>
                        <div class="panel-body">
                            <div class="adv-table">
                                <div class="space15"></div>
                                <table style="width: 100%" class="display table table-bordered table-striped "
                                       id="example" data-order="[[ 0, &quot;desc&quot; ]]">
                                    <thead>
                                    <tr align="center">
                                        <td width="6%"><b>ID</b></td>
                                        <td><b>Login</b></td>
                                        <td><b>Senha</b></td>
                                        <td width="10%"><b>Tipo de acesso</b></td>
                                        <td width="10%"><b>Operações</b></td>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div aria-hidden="true" aria-labelledby="modalInserir" role="dialog" tabindex="-1" id="modalInserir"
                 class="modal fade top-modal-without-space">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title">Inserir/editar usuário</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" id="frmInserir" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="login">Login</label>
                                    <input type="text" class="form-control" id="login" name="login" required>
                                </div>
                                <div class="form-group">
                                    <label for="senha">Senha</label>
                                    <input type="text" class="form-control" id="senha" name="senha" required>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_acesso">Tipo de acesso</label>
                                    <input type="number" class="form-control" id="tipo_acesso" name="tipo_acesso"/>
                                </div>
                                <input type="hidden" name="id" id="idAlterar">
                                <div class="modal-footer">
                                    <button type="submit" id="inserir" class="btn btn-default" name="enviar"
                                            value="enviar">Confirmar
                                    </button>
                                    <button type="button" id="btnFecharModal" class="btn btn-default"
                                            data-dismiss="modal">Fechar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modalExcluir" class="modal fade " role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Excluir usuário</h4>
                        </div>
                        <form id="frmExcluir" role="form" enctype="multipart/form-data">
                            <div class="modal-body">
                                <center>Tem certeza que deseja excluir o usuário de id <span id="id-excluir" class="bold"></span>?</center>
                            </div>
                            <div class="modal-footer">
                                <center>
                                    <input type="hidden" name="id" id="idExcluir"/>
                                    <input type="hidden" name="tabela" value="<?php echo $tabela; ?>"/>
                                    <input type="hidden" name="tipo_de_requisicao" value="remover"/>
                                    <button id="btnExcluir" type="submit" class="btn btn-default" name="enviar"
                                            value="enviar">Excluir
                                    </button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                </center>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--page end-->
        </section>
    </section>
    <!--main content end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--toastr-->
<script src="js/toastr.js"></script>
<script src="js/toastr-index.js"></script>

<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.js"></script>
<!--botones DataTables-->
<script src="js/dataTables.buttons.min.js"></script>

<script>
    var tabela = "<?php echo $tabela; ?>";

        var dataTable = $('#example').DataTable({
            "ajax": {
                "type": "POST",
                "url": "router.php",
                "data": {
                    "action": "buscarTodos",
                    "tabela": tabela
                }
            },
            "columns": [
                {"data": "id_usuario"},
                {"data": "login_usuario"},
                {"data": "senha_usuario"},
                {"data": "id_tipo_acesso"},
                {"data": "operacoes"}
            ],
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Não foram encontrados registros",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtered from _MAX_ total records)"
            },
            responsive: true
        });

        ///////////////////////////////////////////////////////////////////////////////////////////

        $("#frmInserir").submit(function (event) {
            event.preventDefault();
            var action;
            if ($("#idAlterar").val().length > 0)
                action = 'alterar';
            else
                action = 'inserir';

            var data = $("#frmInserir").serialize() + '&action=' + action + '&tabela=' + tabela;
            $.ajax({
                url: 'router.php',
                type: 'POST',
                data: data,
                success: function (response) {
                    var resposta = JSON.parse(response);
                    if (resposta.code == 200)
                        msgSucesso("Operação efetuada com sucesso.", "Sucesso");
                    else
                        msgErro("Houve um erro na solicitação.", "Erro");
                    dataTable.ajax.reload();
                    $("#modalInserir").modal('hide');
                }, error: function () {
                    msgErro("Houve um erro na solicitação.", "Erro");
                }
            });
        });

        /////////////////////////////////////////////////////////////////////

        $(document).on('click', '.update', function () {
            var id = $(this).attr("id");
            var data = 'action=buscarPorId&id=' + id + '&tabela=' + tabela;
            $.ajax({
                url: 'router.php',
                type: 'POST',
                data: data,
                success: function (response) {
                    var user = JSON.parse(response);
                    if (typeof user.id_usuario !== 'undefined') {
                        $("#idAlterar").val(user.id_usuario);
                        $("#login").val(user.login_usuario);
                        $("#senha").val(user.senha_usuario);
                        $("#tipo_acesso").val(user.id_tipo_acesso);
                        $("#modalInserir").modal('show');
                    } else{
                        alert('Houve um erro na solicitação.');
                    }
                }, error: function () {
                    alert('Houve um erro na solicitação.');
                }
            });
        });

        //////////////////////////////////////////////////////////////////////////////////////////////////

        $(document).on('click', '.excluir', function () {
            var id = $(this).attr("id");
            $("#idExcluir").val(id);
            $("#id-excluir").html(id);
            $("#modalExcluir").modal('show');
        });

        /////////////////////////////////////////////////////////////////////////////////////////
        $("#frmExcluir").submit(function (event) {
            event.preventDefault();
            var id = $("#idExcluir").val();
            var data = 'action=remover&tabela=' + tabela + '&id=' + id;
            $.ajax({
                url: 'router.php',
                type: 'POST',
                data: data,
                success: function (response) {
                    response = JSON.parse(response);
                    if (response.code == 200)
                        msgSucesso("Excluído com sucesso.", "Sucesso");
                    else
                        msgErro("Houve um erro na solicitação.", "Erro");
                    dataTable.ajax.reload();
                    $("#modalExcluir").modal('hide');
                }, error: function () {
                    alert('Houve um erro na solicitação');
                }
            });
        });

        /////////////////////////////////////////////////////////////////////////////////////////////////

        $('#modalInserir').on('hidden.bs.modal', function () {
            $("#tipo_de_requisicao").val("inserir");
            $("#frmInserir")[0].reset();
        });
        ////////////////////////////////////////////////////////////////////////////////////////////

</script>
</body>

</html>