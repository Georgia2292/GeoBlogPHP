<?php
	include('config/conexion.php');
	$id_user = $_POST['id_usuario'];
	$usuario = $_POST['usuario'];
	$titulo = $_POST['titulo'];
	$cat = $_POST['categoria'];
	$post = $_POST['post'];

	$nombre_imagen = $_FILES['imagen']['name'];
	$tipo_imagen = $_FILES['imagen']['type'];
	$tamano_imagen = $_FILES['imagen']['size'];

    if($tamano_imagen<1000000){
        if($tipo_imagen=='image/jpeg' || $tipo_imagen=='image/jpg' || $tipo_imagen=='image/png' || $tipo_imagen=='image/gif'){
        //esta es la ruta donde vamos a guardar la imagen
    $destino_imagen = $_SERVER['DOCUMENT_ROOT'] . '/Blog/uploads/';//htdocs
    
    move_uploaded_file($_FILES['imagen']['tmp_name'], $destino_imagen . $nombre_imagen);	       
		    
    }else{
        echo "Solo se permiten imágenes de tipo .jpg/.jpeg/.png o gif";
    }
}else{
        echo "La imagen es demasiada grande";
    }

    $sql = "INSERT INTO post (id_usuario,usuario,titulo,imagen,categoria,post,fecha) VALUES ('$id_user','$usuario','$titulo','$nombre_imagen','$cat','$post',NOW())";

    $resultado = $base->prepare($sql);
    $resultado->execute();

    if ($resultado==false) {
    	echo "Error al crear el post";
    }else{
    	header("Location:index.php");
    }



?>