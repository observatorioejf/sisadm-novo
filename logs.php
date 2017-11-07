<?php
include("validacao.php");
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
    <link href="css/font-awesome.css" rel="stylesheet"/>
    <!--dynamic table-->
    <link href="css/demo_page.css" rel="stylesheet"/>
    <link href="css/demo_table.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/DT_bootstrap.css"/>
    <!--toastr-->
    <link href="css/toastr.css" rel="stylesheet" type="text/css"/>
    <!--right slidebar-->
    <!--        <link href="css/slidebars.css" rel="stylesheet">-->
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>

    <style>
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
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <i class="fa fa-check-square-o fa-1x"></i> <font size="3"><a href="index.php"><b>Voltar</b></a></font><br><br>
                            <center><h3>Registros de log</h3></center>
                        </header>
                        <div class="panel-body">
                            <div class="adv-table">
                                <table class="display table table-bordered" id="hidden-table-info">
                                    <thead>
                                    <tr align="center">
                                        <td><b>ID</b></td>
                                        <td><b>Hora</b></td>
                                        <td><b>Usuário</b></td>
                                        <td><b>Sistema</b></td>
                                        <td><b>Tabela</b></td>
                                        <td><b>IP</b></td>
                                        <td><b>Mensagem</b></td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    include_once 'conn.php';
                                    include_once 'control/UsuarioController.php';


                                    $funcoes = new UsuarioController($conn, []);

                                    $resultado = $funcoes->carregarLogs();

                                    while ($obj = $resultado->fetch_object()) :
                                        $id = $obj->id;
                                        $hora = $obj->hora;
                                        $ip = $obj->ip;
                                        $mensagem = $obj->mensagem;
                                        $tabela = $obj->tabela;
                                        $usuario = $obj->usuario;
                                        $sistema = $obj->sistema;
                                        ?>
                                        <tr align="center">
                                            <td width="5%"><?php echo $id ?></td>
                                            <td><?php echo $hora ?></td>
                                            <td><?php echo $usuario ?></td>
                                            <td width=""><?php echo $sistema ?></td>
                                            <td width="20%"><?php echo $tabela ?></td>
                                            <td width="20%"><?php echo $ip ?></td>
                                            <td width="20%"><?php echo $mensagem ?></td>
                                        </tr>


                                    <?php endwhile; ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
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
    function fnFormatDetails(oTable, nTr) {
        var aData = oTable.fnGetData(nTr);
        var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
        sOut += '<tr><td></td><td>' + aData[7] + '</td></tr>';

        return sOut;
    }

    $(document).ready(function () {

        $('#dynamic-table').dataTable({
            "aaSorting": [[4, "desc"]]
        });

        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement('th');
        var nCloneTd = document.createElement('td');
        nCloneTd.innerHTML = '<img src="css/images/details_open.png">';
        nCloneTd.className = "center";
        $('#hidden-table-info thead tr').each(function () {
            this.insertBefore(nCloneTh, this.childNodes[0]);
        });

        $('#hidden-table-info tbody tr').each(function () {
            this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
        });

        /*
         * Initialse DataTables, with no sorting on the 'details' column
         */
        var oTable = $('#hidden-table-info').dataTable({
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [0]},
//                        {"bVisible": false, "aTargets": [6]},
                {"bVisible": false, "aTargets": [7]}
            ],
            "aaSorting": [[2, 'desc']]
        });

        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $(document).on('click', '#hidden-table-info tbody td img', function () {
            var nTr = $(this).parents('tr')[0];
            if (oTable.fnIsOpen(nTr)) {
                /* This row is already open - close it */
                this.src = "css/images/details_open.png";
                oTable.fnClose(nTr);
            } else {
                /* Open this row */
                this.src = "css/images/details_close.png";
                oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
            }
        });
    });
</script>

</body>

</html>