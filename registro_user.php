<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
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
    <h1>Registrarte</h1>

    <div class="contenido">
    	<form action="procesa_registro_user.php" method="post" enctype="multipart/form-data">
    		Usuario:<input type="text" name="user"><br>
    		Email:<input type="email" name="email"><br>
    		Password:<input type="password" name="pass"><br>
    		Imagen:<input type="file" name="imagen"><br>
    		<button type="submit" name="enviar">Registrarte</button>
    	</form>
    </div>
</body>
</html>