<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style type="text/css">
		h1{
			text-align: center;
			color: gray;
		}
		.contenido{
			display: flex;
			justify-content: center;
		}
		input{
			width: 100%;
			padding: 10px;
			border: none;
			background-color: #f1f1f1;
		}
		button{
			padding: 10px 10px;
			border: none;
			background-color: blueviolet;
			color: white;
			margin-left: 40%;
			margin-top: 5px;
		}
	</style>
</head>
<body>
    <h1>Bienvenido</h1>

    <div class="contenido">
    	<form action="procesa_login.php" method="post">
    		Usuario:<input type="text" name="user"><br>
    		Password:<input type="password" name="pass"><br>
    		<button type="submit" name="enviar">Acceder</button>
    		<p style="text-align: center;">No tienes cuenta aun? <a href="registro_user.php">Registrarte</a></p>
    		<p style="text-align: center;"><a href="formulario_restablecer.php">Olvidaste tu Password?</a></p>
    	</form>
    	
    </div>
    <div style="display: flex;justify-content: center;">
<?php if(isset($_GET['mensaje'])):?>
    		<p><?php echo htmlentities($_GET['mensaje']) ;?></p>
    	<?php endif;?>
    	</div>
    	<div style="display: flex;justify-content: center;">
<?php if(isset($_GET['smserror'])):?>
    		<p><?php echo htmlentities($_GET['smserror']) ;?></p>
    	<?php endif;?>
    	</div>
    	<div style="display: flex;justify-content: center;">
<?php if(isset($_GET['exito'])):?>
    		<p><?php echo htmlentities($_GET['exito']) ;?></p>
    	<?php endif;?>
    	</div>
		
</body>
</html>