<?php 

session_start();
include('conexionOracle.php');

if (!isset($_SESSION["ID_USUARIO"])) {
		header("location: index1.php");
	}

$error="";

$id_producto="0";
$marca="";
$nombre="";
$año="";
$n_puertas="";
$color="";


if (isset($_POST['btnguardar'])) 
{
	$marca=htmlspecialchars($_POST['txtmarca']);
	$nombre=htmlspecialchars($_POST['txtnombre']);
	$año=htmlspecialchars($_POST['txtaño']);
	$n_puertas=htmlspecialchars($_POST['txtn_puertas']);
	$color=htmlspecialchars($_POST['txtcolor']);
	
	if ($_POST['txtid']=="0") 
	{
		$sql = "insert into Automoviles values (Automoviles_SEQ.nextval, '$nombre', $año, $n_puertas, '$color', '$marca')";
		$stid = oci_parse($conn, $sql);
		$resultUsuario = oci_execute($stid);
		if ($resultUsuario) 
		{
			header('Refresh:0; index1.php');
		}
	}else{
		$sql="UPDATE automoviles SET nombre='$nombre', fecha=$año, n_puertas=$n_puertas, color='$color', marca='$marca' WHERE id_automovil='{$_POST['txtid']}'";
		$stid = oci_parse($conn, $sql);
		$resultUsuario = oci_execute($stid);
		if ($resultUsuario) 
		{
			header('Refresh:0; index1.php');
		}
	}
}

//verificación de id para editar
if (isset($_GET['edited'])) 
{
	$query="SELECT * FROM automoviles WHERE id_automovil='{$_GET['id_automovil']}'";
	$stid = oci_parse($conn, $query);
	oci_execute($stid);
	$rows=oci_fetch_array($stid, OCI_ASSOC);

	$id_producto= $rows['ID_AUTOMOVIL']; 
	$marca= $rows['MARCA']; 
	$nombre=  $rows['NOMBRE']; 
	$año= $rows['FECHA']; 
	$n_puertas= $rows['N_PUERTAS'];
	$color= $rows['COLOR']; 
}

//verificación de id para eliminar
if (isset($_GET['deleted'])) 
{

	$query="DELETE FROM automoviles WHERE id_automovil='{$_GET['id_automovil']}' ";
	$stid = oci_parse($conn, $query);
	$result = oci_execute($stid);
	
	
	if ($result) 
	{
		header('Refresh:0; index1.php');
	}
}

?>

<html>
<head>

	<style type="text/css">

			*{
				margin: 0px;
				padding: 0px;
			}
		
			form{
				background: #E3F6CE;
				width: 380px;
				border: 3px solid #31B404;
				margin: 100px auto;
				padding: 40px 20px; 
				box-sizing: border-box;
			}
			body{
				background: url(fondo3.jpg);
				
				background-size: 100vw 100vh;
				background-attachment: fixed;
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
	        	font-size: 18;
	     	}
	     	a:active{
	       		background: #2EFE64;
	     	}

			nav.menu2{
				width: 890px;
				height: 50px;
		        margin: 0;
		        padding: 0;

		    }
		     nav.menu2 li{
		        display: block;
		        float: left;
		        padding: 0 10px;

		    }
			
	</style>

</head>

<body>

<section>

	<nav class="menu2">
	<menu>
		<li><a href="index1.php">Inicio</a><br /><br /></li>

			<?php if($_SESSION['TIPOU']==2) { ?>
				<li><a href="agregarusuarios.php">Agregar usuarios</a><br /><br /></li>
          <?php } ?>

          <li><a href="agregar.php">Agregar automovil</a><br /><br/></li>
          <li><a href="salir.php">Cerrar Sesi&oacute;n</a><br /><br /></li>
		</menu>
		
	</nav>


	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

	<h1>Nuevo Automovil</h1>
		<table>
		<tr>
			<td colspan="2"><span style="color:red;"> <?php echo $error; ?> </span> </td>
		</tr>

			<tr>
				<br /><td>Marca</td>
				<td> <input type="text" name="txtmarca" value="<?php echo $marca; ?>" required pattern="[A-Za-z0-9]{1,15}"> 
				<input type="hidden" name="txtid" value="<?php echo $id_producto; ?>" /> </td>
			</tr>
			<tr>
				<td>Nombre</td>
				<td> <input type="text" name="txtnombre" value="<?php echo $nombre; ?>" required pattern="[A-Za-z0-9]{1,15}"> </td>
			</tr>
			<tr>
				<td>Año</td>
				<td> <input type="text" name="txtaño" value="<?php echo $año; ?>" required pattern="[0-9]+"> </td>
			</tr>
			<tr>
				<td>Número de puertas</td>
				<td> <input type="text" name="txtn_puertas" value="<?php echo $n_puertas; ?>" required pattern="[0-9]+"> </td>
			</tr>
			<tr>
				<td>Color</td>
				<td> <input type="text" name="txtcolor" value="<?php echo $color; ?>" required pattern="[A-Za-z0-9]{1,15}"> </td>
			</tr>
			<tr>
				<td></td>
				<td> <input type="submit" value="Guardar" name="btnguardar"></td>
			</tr>
		</table>
	</form>
</section>
</body>
</html>




