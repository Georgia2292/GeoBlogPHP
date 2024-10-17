<?php 
	 include('config/conexion.php');
	 $id_post = $_POST['id_post'];
	 $id_user = $_POST['id_usuario'];
	 $id_usuario = $_POST['usuario'];
	 $comentario = $_POST['comentario'];

	 if($comentario== ''){
	 	echo "Debe escribir comentario";
	 }else{
	 	$sql = "INSERT INTO comentarios (id_post,id_usuario,usuario,comentario,fecha) VALUES ('$id_post','$id_user','$id_usuario', '$comentario',NOW())";
	 	$resultado = $base->prepare($sql);
     	$resultado->execute();
     	if($resultado== false){
     		echo "Error al comentar";
     	}else{
     		header("Location:post.php?id=" . $id_post);
     	}
	 }

	 



?>