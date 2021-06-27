<?php

    include('../conexionOracle.php');

    if (!isset($_SESSION["CURP"]))
    {
        header("location: ../index.php");
    }

    $error="";

    $id_centro = " ";
    $nombre = " ";
    $direccion = " ";

    //Guardar
    if(isset($_POST['btn_guardar_centro']) ){

        $nombre = htmlspecialchars($_POST['nombre']);
        $direccion = htmlspecialchars($_POST['direccion']);

        //tipo de accion insert
        if($_POST['hidden'] == 1 ){
            //echo 'crear';
            //die();
            $query = "SELECT NOMBRE FROM CENTROS WHERE NOMBRE = '$nombre'";
            $stid = oci_parse($conn, $query);//prepara
            oci_execute($stid); //ejecuta
            $rows = oci_fetch_array($stid, OCI_ASSOC);

            if ($rows){
                $error = "El nombre del centro ya existe";
            }else{
                $sql = "INSERT INTO CENTROS (NOMBRE, DIRECCION) VALUES ('$nombre', '$direccion')";
                $stid = oci_parse($conn, $sql);
                $result = oci_execute($stid);

                if ($result) {
                    $bandera_centro = true;
                }else{
                    $error = "Error al Registrar el Centro";
                }
            }
        }

        //tipo de accion update
        if ($_POST['hidden'] == 2){
            $id_centro = $_GET['id_centro'];

            $sql = "UPDATE CENTROS SET NOMBRE='$nombre', DIRECCION='$direccion' WHERE ID_CENTRO = '$id_centro'";
            $stid = oci_parse($conn, $sql);
            $result = oci_execute($stid);

            if ($result) {
                $bandera_editar_centro = true;
            }else{
                $error = "Error al Actualizar";
            }
        }
    }

    //accion de Editar y mostrar datos en campos
    if (isset($_GET['accion']) && $_GET['accion'] == 'editar' && isset($_GET['id_centro'])){
        $sql="SELECT * FROM CENTROS WHERE ID_CENTRO = '{$_GET['id_centro']}'";
        $stid = oci_parse($conn, $sql);
        oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC);

        $id_centro = $row['ID_CENTRO'];
        $nombre = $row['NOMBRE'];
        $direccion = $row['DIRECCION'];

    }

    //accion de Eliminar
    if(isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id_centro'])){
        $sql="DELETE FROM CENTROS WHERE ID_CENTRO ='{$_GET['id_centro']}' ";
        $stid = oci_parse($conn, $sql);
        $result = oci_execute($stid);

        if($result){
            $_SESSION['eliminado']= '';
            header("Location: index_centros.php");
        }else{
            $error = "Error al Eliminar";
        }
    }