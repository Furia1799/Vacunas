<?php
    session_start();
    include('conexionOracle.php');

    if (!isset($_SESSION["CURP"])) {
        header("location: index1.php");
    }

    $bandera_editar = false;

    include('probar_consultas.php');
?>
<html>
<head>
    <title>Editar Datos</title>

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
            margin: 0px;
            padding: 0px;
        }

        body{
            background: url(fondo3.jpg);
            background-size: 100vw 100vh;
            background-attachment: fixed;
        }

        form{
            background: #E3F6CE;
            width: 380px;
            border: 3px solid #31B404;
            margin: 30px auto;
            padding: 40px 30px;
            box-sizing: border-box;
        }
        form h1{
            text-align: center;
            font-weight: normal;
            color: #31B404;
            font-size: 30pt;
            margin: 0;
        }
        form input{
            width: 200px;
            height: 25px;
            margin: 10px 30px;
        }

        a{
            color: #000;
            padding: 5px 5px;
            font-size: 18px;
        }
        a:active{
            background: #2EFE64;
        }

        nav.menu1{
            width: 890px;
            height: 50px;
            margin: 0;
            padding: 0;
        }
        nav.menu1 li{
            display: block;
            float: left;
            padding: 0 10px;
        }
    </style>

</head>
<body>

<section>
    <nav class="menu1">
        <menu>
            <li><a href="index1.php">Inicio</a><br /><br /></li>
            <?php if($_SESSION['TIPO_USUARIO'] == 2) { ?>
                <li><a href="vacunas/index_vacunas.php">Mostrar Vacunas</a><br /><br /></li>
                <li><a href="agregarusuarios.php">Mostrar Empleado</a><br /><br /></li>
            <?php } ?>
            <li><a href="centros/index_centros.php">Monstrar Centros</a><br /><br /></li>
            <li><a href="#">Mis Datos</a><br /><br /></li>
            <li><a href="salir.php">Cerrar Sesi&oacute;n</a><br /><br /></li>
        </menu>
    </nav>

    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
        <input type="hidden" name="hidden" value="2" /> </td>
        <div>
            <?php if($bandera_editar){ ?>
                <h4 class="text-center">Registro Actualizado</h4>
            <?php } ?>
            <h1>Editar Mis datos</h1>
            <!-- solo que acepte caracteres que le indique con el pattern -->
            <br /><br />
            <p colspan="2"><span style="color:red;"> <?php echo $error; ?> </span> </p>

            <br>
            <label>CURP:</label>
            <input id="CURP" type="text" name="CURP" required pattern="[A-Za-z0-9]{10,20}" readonly
                   value="<?php echo $CURP; ?>" readonly>
            <br>
            <div>
                <label>Nombre:</label>
                <input id="nombre" type="text" name="nombre"  required pattern="[A-Za-z ]{1,40}"
                       value="<?php echo $nombre; ?>">
            </div>
            <br>
            <div>
                <label>Apellidos:</label>
                <input id="apellidos" type="text" name="apellidos" required pattern="[A-Za-z ]{1,50}"
                       value="<?php echo $apellidos; ?>">
            </div>
            <br>
            <div>
                <label>Fecha de Nacimiento:</label>
                <input id="fecha_nacimiento" type="date" name="fecha_nacimiento" required pattern="[A-Za-z0-9]{1,15}"
                       value="<?php echo $fecha_nacimiento; ?>">
            </div>
            <br>
            <div>
                <label>Codigo Postal:</label>
                <input id="codigo_postal" type="number" name="codigo_postal" required pattern="[0-9]{1,10}"
                       value="<?php echo $codigo_postal; ?>">
            </div>
            <br>
            <div>
                <label>Estado:</label>
                <input id="estado" type="text" name="estado" required pattern="[A-Za-z]{1,40}"
                       value="<?php echo $estado; ?>">
            </div>
            <br>
            <div>
                <label>Localidad:</label>
                <input id="localidad" type="text" name="localidad" required pattern="[A-Za-z ]{1,40}"
                       value="<?php echo $localidad; ?>">
            </div>
            <div>
                <label>Domicilio:</label>
                <input id="domicilio" type="text" name="domicilio" required pattern="[A-Za-z0-9# ]{1,40}"
                       value="<?php echo $domicilio; ?>">
            </div>
            <div>
                <label>Email:</label>
                <input id="email" type="email" name="email" required pattern="[A-Za-z0-9@.]{1,30}"
                       value="<?php echo $email; ?>" readonly>
            </div>
            <div>
                <label>Password:</label>
                <input id="password" type="password" name="password" required pattern="[A-Za-z0-9]{1,30}"
                       value="<?php echo $password; ?>" readonly>
            </div>
            <div>
                <label>Confirmar Password:</label>
                <input id="con_password" type="password" name="con_password" required pattern="[A-Za-z0-9]{1,15}"
                       value="<?php echo $password; ?>" readonly>
            </div>

        </div>
        <br>
        <div>
            <input type="submit" value="Actualizar" name="btn_guardar" >
        </div>
    </form>
</section>
</body>
</html>