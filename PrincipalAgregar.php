<?php
session_start();

include('conexionOracle.php');

$bandera = false;

include('probar_consultas.php');

?>

<html>
<head>
    <title>Registro Nuevo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

        function validarCURP()
        {
            valor = document.getElementById("usuario").value;
            if(valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
                alert('Falta Llenar Usuario');
                return false;
            }else{ return true;}
        }

        function validarPassword()
        {
            valor = document.getElementById("password").value;
            if(valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
                alert('Falta Llenar Password');
                return false;
            }else{
                valor2 = document.getElementById("con_password").value;
                if (valor == valor2)
                {
                    return true;
                }else{ alert('Las contraselas no coinciden'); return false;}

            }
        }
        /*
        function validarTipoUsuario()
        {
            indice = document.getElementById("tipo_usuario").value;

            if(indice == null || indice==0) {
                alert('Seleccione tipo de usuario');
                alert(indice);
                return false;
            }else{ return true;}

            && validarTipoUsuario()
        }*/

        function validar()
        {
            if (validarCURP() && validarPassword() )
            {
                document.registro.submit();
            }
        }

    </script>

    <style>

        *{
          /*  margin: 0px;
            padding: 0px;*/
        }

        body{
            /*background: url(images/fondo_tringular.jpg);
            background-size: 100vw 100vh;
            background-attachment: fixed;*/
            background:  #b3d1ff;
        }

        form{
          /*  background: #E3F6CE;*/
            /*width: 380px;
            border: 3px solid #31B404;
            margin: 30px auto;
            padding: 40px 30px;
            box-sizing: border-box;*/
        }
        form h1{
            text-align: center;
            font-weight: normal;
            color: #31B404;
            font-size: 30pt;
            margin: 0;
        }
        form input{
           /* width: 200px;
            height: 25px;
            margin: 10px 30px;*/
        }

        a{
         /*   color: #000;
            padding: 5px 5px;
            font-size: 18px;*/
        }
        a:active{
        /*    background: #2EFE64;*/
        }

        nav.menu1{
            /*width: 890px;
            height: 50px;
            margin: 0;
            padding: 0;*/
        }
        nav.menu1 li{
         /*   display: block;
            float: left;
            padding: 0 10px;*/
        }
    </style>

</head>
<body>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron">
                    <h1 class="text-center">Registrar Paciente</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
                <input type="hidden" name="hidden" value="1"/>
                <div>
                    <div class="form-group col-lg-5">
                        <label for="">CURP:</label>
                        <input class="form-control" id="CURP" type="text" name="CURP" required pattern="[A-Za-z0-9]{10,20}">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="">Nombre:</label>
                        <input class="form-control" id="nombre" type="text" name="nombre" required pattern="[A-Za-z]{1,40}">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="">Apellidos:</label>
                        <input class="form-control" id="apellidos" type="text" name="apellidos" required pattern="[A-Za-z]{1,50}">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="">Fecha de Nacimiento:</label>
                        <input class="form-control" id="fecha_nacimiento" type="date" name="fecha_nacimiento" required pattern="[A-Za-z0-9]{1,15}">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="">Codigo Postal:</label>
                        <input class="form-control" id="codigo_postal" type="number" name="codigo_postal" required pattern="[0-9]{1,10}">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="">Estado:</label>
                        <input class="form-control" id="estado" type="text" name="estado" required pattern="[A-Za-z]{1,40}">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="">Localidad:</label>
                        <input class="form-control" id="localidad" type="text" name="localidad" required pattern="[A-Za-z ]{1,40}">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="">Domicilio:</label>
                        <input class="form-control" id="domicilio" type="text" name="domicilio" required pattern="[A-Za-z0-9# ]{1,40}">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="">Email:</label>
                        <input class="form-control" id="email" type="email" name="email" required pattern="[A-Za-z0-9@.]{1,30}">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="">Password:</label>
                        <input class="form-control" id="password" type="text" name="password" required pattern="[A-Za-z0-9]{1,30}">
                    </div>
                    <div class="form-group col-lg-5">
                        <label for="">Confirmar Password:</label>
                        <input class="form-control" id="con_password" type="password" name="con_password" required pattern="[A-Za-z0-9]{1,15}">
                    </div>

                </div>
                <br>
                <div class="form-group col-lg-5">
                    <input class="form-control btn btn-success"type="submit" value="Registrar" name="btn_guardar" onclick="validar();">
                </div>
                </form>

                <?php if($bandera){ ?>
                    <?php echo '<script type="text/javascript">alert("Agregado correctamente");</script>';
                    header("location: index.php");
                    ?>
                <?php   } else{ ?>
                    <br />
                    <div style="font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
</body>
</html>
<?php

?>