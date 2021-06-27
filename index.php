<?php

include('conexionOracle.php');

    session_start();
    /*

    if (isset($_SESSION["id_usuario"]))
    {
        header("location: index.php");
    }
     */
include('validad_login.php');

?>

<html>
	<head>
		<title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<style type="text/css">
			*{
				margin: 0px;
				padding: 0px;
			}
			body{
				background: url(images/fondo_tringular.jpg);
				background-size: 100vw 100vh;
				background-attachment: fixed;
			}
			form{
				background: #ccffef;
				width: 400px;
				border: 5px solid #23527c;
				margin:130px auto;
                padding: 10px;
			}
			form h1{
				text-align: center;
				color: #23527c;
				font-weight: normal;
				font-size: 40pt;
				margin: 30px 0px;
			}
			form input{
				width: 250px;
				height: 35px;
				margin: 10px 30px;
				padding: 0px 10px;
				text-align: center;
			}
            .form-control{
                width: 80%;
            }
            form input{
                width: 300px;
            }
			
		</style>

	</head>

  	<body>

     	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "POST">
     	<h1>Inicia Sesion</h1>
            <div class="form-group">
                <label for="CURP">CURP:</label>
                <input class="form-control" type = "text" id="CURP" name = "CURP" placeholder="Ingresa tu CURP" required pattern="[A-Za-z0-9]{10,20}">
            </div>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input class="form-control" type = "password" id="password" name = "password" placeholder="Password" pattern="[A-Za-z0-9]{1,30}"></div>
            </div>
			<div><input  class="btn btn-primary" type = "submit" name="login" value="Entrar"></div>
	  		<br/>
	  		<div style="font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>
            <a  class="btn btn-dark" href="PrincipalAgregar.php">Regístrate Aqui</a>
    	</form>
  	</body>
</html>