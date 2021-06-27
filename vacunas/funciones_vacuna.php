<?php

    include('../conexionOracle.php');

    if (!isset($_SESSION["CURP"]))
    {
        header("location: ../index.php");
    }

    $error="";

    $id_vacuna = " ";
    $nombre = " ";
    $edad_minima = " ";
    $numero_dosis = " ";
    $intervalo = " ";

    //Guardar
    if(isset($_POST['btn_guardar_vacuna']) ){

        $nombre = htmlspecialchars($_POST['nombre']);
        $edad_minima = htmlspecialchars($_POST['edad_minima']);
        $numero_dosis = htmlspecialchars($_POST['numero_dosis']);
        $intervalo = htmlspecialchars($_POST['intervalo']);

        //tipo de accion insert
        if($_POST['hidden'] == 1 ){
            //echo 'crear';
            //die();
            $query = "SELECT NOMBRE FROM VACUNAS WHERE NOMBRE = '$nombre'";
            $stid = oci_parse($conn, $query);//prepara
            oci_execute($stid); //ejecuta
            $rows = oci_fetch_array($stid, OCI_ASSOC);

            if ($rows){
                $error = "La Vacuna ya existe";
            }else{
                $sql = "INSERT INTO VACUNAS (NOMBRE, EDAD_MINIMA, NUMERO_DOSIS, INTERVALO) VALUES ('$nombre', '$edad_minima', '$numero_dosis', '$intervalo')";
                $stid = oci_parse($conn, $sql);
                $result = oci_execute($stid);
                if ($result)
                {
                    $bandera_vacuna = true;
                }else{
                    $error = "Error al Registrar Vacuna";
                }
            }
        }

        //tipo de accion update
        if ($_POST['hidden'] == 2){
            $id_vacuna = $_GET['id_vacuna'];

            $sql = "UPDATE VACUNAS SET NOMBRE='$nombre', EDAD_MINIMA='$edad_minima', NUMERO_DOSIS='$numero_dosis', INTERVALO='$intervalo' WHERE ID_VACUNA = '$id_vacuna'";
            $stid = oci_parse($conn, $sql);
            $result = oci_execute($stid);

            if ($result) {
                $bandera_editar_vacuna = true;
            }else{
                $error = "Error al Actualizar";
            }
        }
    }

    //accion de Editar y mostrar datos en campos
    if (isset($_GET['accion']) && $_GET['accion'] == 'editar' && isset($_GET['id_vacuna'])){
        $sql="SELECT * FROM VACUNAS WHERE ID_VACUNA = '{$_GET['id_vacuna']}'";
        $stid = oci_parse($conn, $sql);
        oci_execute($stid);
        $row = oci_fetch_array($stid, OCI_ASSOC);

        $id_vacuna = $row['ID_VACUNA'];
        $nombre = $row['NOMBRE'];
        $edad_minima = $row['EDAD_MINIMA'];
        $numero_dosis = $row['NUMERO_DOSIS'];
        $intervalo = $row['INTERVALO'];
    }

    //accion de Eliminar
    if(isset($_GET['accion']) && $_GET['accion'] == 'eliminar' && isset($_GET['id_vacuna'])){
        $sql="DELETE FROM VACUNAS WHERE ID_VACUNA ='{$_GET['id_vacuna']}' ";
        $stid = oci_parse($conn, $sql);
        $result = oci_execute($stid);

        if($result){
            $_SESSION['eliminado']= '';
            header("Location: index_vacunas.php");
        }else{
            $error = "Error al Eliminar";
        }
    }