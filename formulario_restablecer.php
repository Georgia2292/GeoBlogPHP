<!DOCTYPE html>
<html>
<head>
	<title>Restablecer Password</title>
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
    <h1>Restablecer Password</h1>

    <div class="contenido">
    	<form action="mail_restablecer.php" method="post">
    		Email:<input type="email" name="email"><br>
    		<button type="submit" name="enviar">Enviar</button>
    	</form>
    	
    </div>
    <div style="display: flex;justify-content: center;">
<?php if(isset($_GET['error'])):?>
    		<p><?php echo htmlentities($_GET['error']) ;?></p>
    	<?php endif;?>
    	</div>
    	
</body>
</html>