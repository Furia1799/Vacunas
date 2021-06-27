<?php
    include('../conexionOracle.php');

    session_start();

    if (!isset($_SESSION["CURP"]))
    {
        header("location: index.php");
    }

    $bandera_eliminar_vacuna = false;

    include('funciones_centro.php');

    ?>

    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Base de Datos</title>

        <!-- Bootstrap -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/dataTables.bootstrap.min.css" rel="stylesheet">

        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style type="text/css">

            body{
                background: url(../fondo3.jpg);
                background-size: 100vw 100vh;
                background-attachment: fixed;
            }
            a{
                color: #000;
                padding: 5px 5px;
            }
            a:active{
                background: #2EFE64;
            }

            nav.menu{
                margin: 0;
                padding: 0;
            }
            nav.menu li{
                display: block;
                float: left;
                padding: 0 10px;
            }

        </style>


    </head>
    <body>

    <section>
        <nav class="menu">
            <menu>
                <li><a href="../index1.php">Inicio</a><br /><br /></li>
                <?php if($_SESSION['TIPO_USUARIO'] == 2) { ?>
                    <li><a href="../index_vacunas.php.">Mostrar Vacunas</a><br /><br /></li>
                    <li><a href="index_centros.php">Monstrar Centros</a><br /><br /></li>
                <?php } ?>
                <li><a href="../editar_usuario.php?accion=editar&id_usuario=<?php echo $_SESSION['CURP']; ?>">Mis Datos</a><br /><br /></li>
                <li><a href="../salir.php">Cerrar Sesi&oacute;n</a><br /><br /></li>
            </menu>
        </nav>

        <div class="container">
            <br>
            <h2 class="text-center">BIENVENIDO <?php echo $_SESSION['NOMBRE'];  ?></h2>
            <br>
            <h1>TABLA CENTROS</h1>
            <br>
            <a class="btn btn-warning" href="agregar_centro.php">Agregar Centro</a>
            <br>
            <br>

            <?php if(isset($_SESSION['eliminado'])){ ?>
                <div class="alert alert-danger">
                    <strong>Eliminado!</strong>El Centro se a Eliminado correctamente
                </div>
            <?php unset($_SESSION['eliminado']); } ?>

            <table class="table table-striped table-bordered table-hover" id="tablaCentros">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>DIRRECION</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>DIRRECION</th>
                </tr>
                </tfoot>
                <tbody>

                <?php
                $query="SELECT * FROM CENTROS ORDER BY ID_CENTRO";
                $stid = oci_parse($conn, $query);
                oci_execute($stid);

                while ($rows=oci_fetch_array($stid, OCI_ASSOC)) {

                    ?>
                    <tr>
                        <td> <?php echo $rows['ID_CENTRO']; ?></td>
                        <td> <?php echo $rows['NOMBRE']; ?></td>
                        <td> <?php echo $rows['DIRECCION']; ?></td>
                        <td>
                            <a class="btn btn-info" href="editar_centro.php?accion=editar&id_centro=<?php echo $rows['ID_CENTRO']; ?>">Editar</a> |
                            <a class="btn btn-danger" href="agregar_centro.php?accion=eliminar&id_centro=<?php echo $rows['ID_CENTRO']; ?>">Eliminar</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="../js/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables.bootstrap.min.js"></script>
        <script>
            $('#tablaCentros').dataTable();
        </script>
    </section>
    </body>
    </html>