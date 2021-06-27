<?php

include('conexionOracle.php');

    $error="";

    $CURP = " ";
    $nombre = " ";
    $apellidos = " ";
    $fecha_nacimiento = " ";
    $codigo_postal = " ";
    $estado = " ";
    $localidad = " ";
    $domicilio = " ";
    $password = " ";
    $email = " ";

    if(isset($_POST['btn_guardar']) ){


        $CURP = htmlspecialchars($_POST['CURP']);
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellidos = htmlspecialchars($_POST['apellidos']);
        $date = htmlspecialchars($_POST['fecha_nacimiento']);
        $fecha = date_create($date);
        $fecha_nacimiento= date_format($fecha, 'd-M-Y');

        $codigo_postal = htmlspecialchars($_POST['codigo_postal']);
        $estado = htmlspecialchars($_POST['estado']);
        $localidad = htmlspecialchars($_POST['localidad']);
        $domicilio = htmlspecialchars($_POST['domicilio']);
        $password = htmlspecialchars($_POST['password']);
        $sha1_pass = sha1($password);
        $email = htmlspecialchars($_POST['email']);

        if($_POST['hidden'] == 1 ){
            //echo 'crear';
            //die();

            $query = "SELECT CURP FROM PACIENTES WHERE CURP = '$CURP'";
            $stid = oci_parse($conn, $query);//prepara
            oci_execute($stid); //ejecuta
            $rows = oci_fetch_array($stid, OCI_ASSOC);

            if ($rows){
                $error = "El usuario ya existe";
            }else{
                $sqlUsuario = "insert into PACIENTES (CURP, NOMBRE, APELLIDOS, FECHA_NACIMIENTO, CODIGO_POSTAL,ESTADO,LOCALIDAD,DOMICILIO,password,email,TIPO_USUARIO) values ('$CURP', '$nombre', '$apellidos', '$fecha_nacimiento', '$codigo_postal', '$estado', '$localidad', '$domicilio', '$sha1_pass', '$email',1)";
                $stid = oci_parse($conn, $sqlUsuario);
                $resultUsuario = oci_execute($stid);

                if ($resultUsuario)
                {
                    $bandera = true;

                }else{
                    $error = "Error al Registrar";
                }
            }
        }

        if ($_POST['hidden'] == 2){
            //echo 'editar';
            //die();

                $sql = "UPDATE PACIENTES SET NOMBRE='$nombre', APELLIDOS='$apellidos', FECHA_NACIMIENTO='$fecha_nacimiento', CODIGO_POSTAl=$codigo_postal,ESTADO='$estado',LOCALIDAD='$localidad',DOMICILIO='$domicilio' WHERE CURP = '$CURP'";
                $stid = oci_parse($conn, $sql);
                $resultUsuario = oci_execute($stid);

                if ($resultUsuario) {
                    $bandera_editar = true;

                }else{
                    $error = "Error al Actualizar";
                }

        }



       /* while ($filas = oci_fetch_array($stid, OCI_ASSOC)) { //convertir en array
            foreach ($filas as $elemento) {
                echo  $elemento . " ";
            }
            echo "<br>";
        }*/

       // $num_rows = oci_num_rows($stid);
       // echo 'cantidad es  '.$num_rows;


    }


    if (isset($_GET['accion']) && $_GET['accion'] == 'editar')
    {
        $sql="SELECT * FROM PACIENTES WHERE CURP = '{$_GET['id_usuario']}'";
        $stid = oci_parse($conn, $sql);
        oci_execute($stid);
        $rows=oci_fetch_array($stid, OCI_ASSOC);

        //echo ' la curp es '. $rows['CURP'];
        //die();

        $CURP = $rows['CURP'];
        $nombre = $rows['NOMBRE'];
        $apellidos = $rows['APELLIDOS'];
        $date = $rows['FECHA_NACIMIENTO'];
        $fecha = date_create($date);
        $fecha_nacimiento= date_format($fecha, 'Y-m-d'); //Y-M-d == 2017-Jun-12  | Y-m-d == 2017-06-12
        $codigo_postal = $rows['CODIGO_POSTAL'];
        $estado = $rows['ESTADO'];
        $localidad = $rows['LOCALIDAD'];
        $domicilio = $rows['DOMICILIO'];
        $password = $rows['PASSWORD'];
        $email = $rows['EMAIL'];

    }
?>

