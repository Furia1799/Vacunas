<?php



if (!empty($_POST))
{
    $CURP = htmlspecialchars($_POST['CURP']);
    $password = htmlspecialchars($_POST['password']);
    $error='';
    $sha1_pass = sha1($password);

    $query = "SELECT * FROM PACIENTES WHERE CURP = '$CURP' AND password = '$sha1_pass' ";

    $stid = oci_parse($conn, $query);
    oci_execute($stid);
    $rows = oci_fetch_array($stid, OCI_ASSOC);

    /*while(oci_fetch_array($stid)){
        //echo $message = oci_result($stid,"ID_USUARIO");
    }*/

    if ($rows)
    {
        $_SESSION['CURP'] = $rows['CURP'];
        $_SESSION['NOMBRE'] = $rows['NOMBRE'];
        $_SESSION['APELLIDOS'] = $rows['APELLIDOS'];
        $_SESSION['TIPO_USUARIO'] = $rows['TIPO_USUARIO'];

        echo $_SESSION['CURP'];
        echo $_SESSION['TIPO_USUARIO'];


        header("location: index1.php");

    }else{
        $error="Usuario o password son incorrectos";
    }
}