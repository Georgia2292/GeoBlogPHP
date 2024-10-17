<!DOCTYPE html>
<html>
<head>
	<title>Cambiar Imagen</title>
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
    <h1>Cambiar Imagen</h1>

    <div class="contenido">
    	<form action="" method="post" enctype="multipart/form-data">
    		Imagen:<input type="file" name="imagen"><br>
    		<button type="submit" name="enviar">Guardar</button>
    		
    	</form>
    	
    </div>
    
		<?php
		if(isset($_POST['enviar'])){
			include('conexion.php');
		   $pagina = $_GET['pag'];	
           $id = $_GET['id']; 
           $nombre_imagen = $_FILES['imagen']['name'];
	       $tipo_imagen = $_FILES['imagen']['type'];
	       $tamano_imagen = $_FILES['imagen']['size'];

    if($tamano_imagen<1000000){
        if($tipo_imagen=='image/jpeg' || $tipo_imagen=='image/jpg' || $tipo_imagen=='image/png' || $tipo_imagen=='image/gif'){
        //esta es la ruta donde vamos a guardar la imagen
    $destino_imagen = $_SERVER['DOCUMENT_ROOT'] . '/proyecto/uploads/';//htdocs
    
    move_uploaded_file($_FILES['imagen']['tmp_name'], $destino_imagen . $nombre_imagen);
		        $sql = "UPDATE login SET imagen = '$nombre_imagen' WHERE id = '$id'";
                
                $resultado = $base->prepare($sql);
			    $resultado->execute();

				if($resultado== false){
					echo "Error al actualizar la imagen";
			    }else{
					header("Location:$pagina" . "?id=" . $id);//echo "Imagen actualizada";
					    	///proyecto/perfil1.php?id=9
				}	
					       
		    
    }else{
        echo "Solo se permiten imagnes de tipo .jpg/.jpeg/.png o gif";
    }
}else{
        echo "La imagen es demasiada grande";
    }

    if($nombre_imagen==''){
    	$sql = "SELECT imagen FROM login WHERE id = '$id'";
    	$resultado = $base->prepare($sql);
			    $resultado->execute();

				if($resultado== false){
					echo "Error al actualizar la imagen";
			    }else{
					header("Location:$pagina" . "?id=" . $id);//echo "Imagen actualizada";
					    	///proyecto/perfil1.php?id=9
				}	
    }
    }
        

		   
?>
		
</body>
</html>