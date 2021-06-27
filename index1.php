<?php
include('conexionOracle.php');

session_start();

  if (!isset($_SESSION["CURP"]))
  {
    header("location: index.php");
  }
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Base de Datos</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
      
      body{
          background: url(images/fondo_tringular.jpg);
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
        <li><a href="index1.php">Inicio</a><br /><br /></li>
          <?php if($_SESSION['TIPO_USUARIO'] == 2) { ?>
          <li><a href="vacunas/index_vacunas.php">Mostrar Vacunas</a><br /><br /></li>
          <?php } ?>
            <li><a href="centros/index_centros.php">Monstrar Centros</a><br /><br /></li>
          <li><a href="editar_usuario.php?accion=editar&id_usuario=<?php echo $_SESSION['CURP']; ?>">Mis Datos</a><br /><br /></li>
          <li><a href="salir.php">Cerrar Sesi&oacute;n</a><br /><br /></li>
        </menu>
      </nav>

      <div class="container">
          <br>
          <h2 class="text-center"><?php echo $_SESSION['NOMBRE'];  ?></h2>
          <br>
          <h1>CITAS PROGRAMADAS</h1>
          <br>
          <?php if($_SESSION['TIPO_USUARIO'] == 1) { ?>
              <a  href="agendar_citas/index_agendar_cita.php" class="btn btn-success">Agendar Cita</a>
              <br>
          <?php } ?>
          <br>
        <table class="table table-dark table-hover" id="tablaCitas">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>CURP</th>
              <th>CENTRO</th>
              <th>FECHA</th>
              <th>HORA</th>
                <?php if($_SESSION['TIPO_USUARIO'] == 2) { ?>
                <th>CAMBIOS</th>
                <?php } ?>
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>ID</th>
                <th>CURP</th>
                <th>CENTRO</th>
                <th>FECHA</th>
                <th>HORA</th>
                <?php if($_SESSION['TIPO_USUARIO'] == 2) { ?>
                    <th>CAMBIOS</th>
                <?php } ?>
            </tr>
          </tfoot>
          <tbody>

          <?php

          $CURP = $_SESSION['CURP'];

          if($_SESSION['TIPO_USUARIO'] == 2){
              //$query="SELECT ID_CITA,CURP,ID_CENTRO,TO_CHAR(FECHA_CITA,'YYYY-MM-DD') AS FECHA,TO_CHAR(FECHA_CITA,'HH24:MI') AS HORA FROM CITAS";
              $query="SELECT CITAS.ID_CITA,CITAS.CURP,CENTROS.NOMBRE,TO_CHAR(CITAS.FECHA_CITA,'YYYY-MM-DD') AS FECHA,TO_CHAR(CITAS.FECHA_CITA,'HH24:MI') AS HORA 
                        FROM CITAS 
                        INNER JOIN CENTROS 
                        ON CITAS.ID_CENTRO = CENTROS.ID_CENTRO
                        ORDER BY CITAS.ID_CITA DESC";
          }else{
              //$query="SELECT ID_CITA,CURP,ID_CENTRO,TO_CHAR(FECHA_CITA,'YYYY-MM-DD') AS FECHA,TO_CHAR(FECHA_CITA,'HH24:MI') AS HORA FROM CITAS WHERE CURP = '$CURP'";
              $query="SELECT CITAS.ID_CITA,CITAS.CURP,CENTROS.NOMBRE,TO_CHAR(CITAS.FECHA_CITA,'YYYY-MM-DD') AS FECHA,TO_CHAR(CITAS.FECHA_CITA,'HH24:MI') AS HORA 
                        FROM CITAS 
                        INNER JOIN CENTROS 
                        ON CITAS.ID_CENTRO = CENTROS.ID_CENTRO
                        WHERE CURP = '$CURP'
                        ORDER BY CITAS.ID_CITA DESC";
          }

          $stid = oci_parse($conn, $query);
          oci_execute($stid);
            //echo '<script type="text/javascript">alert('.$caca.');</script>';
            //para obtener un numero de filas

          while ($rows=oci_fetch_array($stid, OCI_ASSOC)) {

          ?>
              <tr>
                <td> <?php echo $rows['ID_CITA']; ?></td>
                <td> <?php echo $rows['CURP']; ?></td>
                <td> <?php echo $rows['NOMBRE']; ?></td>
                <td> <?php echo $rows['FECHA']; ?></td>
                <td> <?php echo $rows['HORA']; ?></td>
                <?php if($_SESSION['TIPO_USUARIO'] ==2 ){ ?>
                <td>
                  <a class="btn btn-info" href="probar_consultas.php?accion=editar&id_cita=<?php echo $rows['ID_CITA']; ?>">Editar</a> |
                  <a class="btn btn-danger" href="agregar.php?deleted=1&id_automovil=<?php echo $rows['ID_CITA']; ?>">Eliminar</a>
                </td>
                <?php } ?>
              </tr>
          <?php
              }
             
          ?>
            
          </tbody>

        </table>

      </div>

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="js/jquery.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="js/bootstrap.min.js"></script>
      <script src="js/jquery.dataTables.min.js"></script>
      <script src="js/dataTables.bootstrap.min.js"></script>
      <script>
      	$('#tablaCitas').dataTable();
      </script>
    </section>
  </body>
</html>