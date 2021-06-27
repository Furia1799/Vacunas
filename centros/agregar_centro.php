<?php

    session_start();

    include('../conexionOracle.php');

    $bandera_centro = false;

    include('funciones_centro.php');

    ?>
    <html>
    <head>
        <title>Registro De Centro</title>
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
                background: url(../fondo3.jpg);
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
            #direccion{
                width: 250px;
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
                <li><a href="../index1.php">Inicio</a><br /><br /></li>
                <li><a href="../vacunas/index_vacunas.php">Mostrar Vacunas</a><br /><br /></li>
                <li><a href="index_centros.php">Mostrar Centros</a><br /><br /></li>
                <li><a href="../editar_usuario.php?accion=editar&id_usuario=<?php echo $_SESSION['CURP']; ?>">Mis Datos</a><br /><br /></li>
                <li><a href="../salir.php">Cerrar Sesi&oacute;n</a><br /><br /></li>
            </menu>
        </nav>

        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
            <input type="hidden" name="hidden" value="1"/>
            <div>
                <?php if ($bandera_centro){ ?>
                    <div class="alert alert-success">
                        <strong>Registrado!</strong> El Centro se a registrado Correctamente
                    </div>
                <?php } ?>
                <div style="font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>
                <h1>Registrar Centro</h1>
                <br /><br/>
                <label>Nombre:</label>
                <input id="nombre" type="text" name="nombre" required pattern="[A-Za-z0-9 ]{5,20}">
                <br>
                <div>
                    <label>Direccion:</label>
                    <input id="direccion" type="text" name="direccion" required pattern="[A-Za-z0-9# ]{5,20}">
                </div>
                <br>
            </div>
            <div>
                <input  type="submit" value="Registrar" name="btn_guardar_centro" ><!--onclick="validar();-->
            </div>
        </form>
        <div style="font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>
    </section>
    </body>
    </html>
