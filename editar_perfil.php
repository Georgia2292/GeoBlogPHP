<?php 

include('includes/header.php')?>

<?php

if(!isset($_SESSION["usuario"])){
   	header("Location:index.php");
   }
      $id_url = $_GET['id'];
      $id_usuario = $_SESSION['id'];

      $sql ="SELECT * FROM login WHERE id = '$id_url'";
      $resultado = $base->prepare($sql);
      $resultado->execute();
      

      $sql_post = "SELECT distinct categoria FROM post WHERE id_usuario = '$id_url'";   
      $resultado_post = $base->prepare($sql_post);
      $resultado_post->execute();
?>

<div class="container mt-5 mb-5">
<div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
<div class="card h-100">
	<div class="card-body">
		 
		<div class="account-settings">
			<div class="user-profile">
				<div class="user-avatar">
					<?php foreach($resultado as $datos):?>
					<img src="uploads/<?php echo $datos['imagen'];?>" alt="Imagen Perfil">
                     
				</div>
				
				<h5 class="user-name"><?php echo $datos['usuario']?></h5>
				<h6 class="user-email"><?php echo $datos["email"]?></h6>
				<?php endforeach; ?>
			</div>
			<div class="about">
				<h5>Post</h5>
				<?php foreach ($resultado_post as $datos):?>
				<!-- Post categories-->
                            <a class="badge bg-primary text-decoration-none link-light" href="categoria.php?id=<?php echo $datos['categoria']?>"><?php echo $datos['categoria']?></a>
			<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
</div>

<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
	
	<?php 
     
      $resultado = $base->prepare($sql);
      $resultado->execute();
      foreach($resultado as $datos){
     	$user = $datos['usuario'];
     	$email = $datos['email'];
     	$pass = $datos['password'];
     }
 
	 ?>
	<form action="" method="post" enctype="multipart/form-data">
<div class="card h-100">
	<div class="card-body">
		<div class="row gutters">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<h6 class="mb-2 text-primary">Detalles Personales</h6>
			</div>
			
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				
				<div class="form-group">
					<label for="fullName">Usuario</label>   
                            	 
					<input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $user ?>">
					 
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="eMail">Email</label>
					<input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>">
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="phone">Password</label>
					<input type="text" class="form-control" id="pass" name="pass" >
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
				<div class="form-group">
					<label for="imagen">Imagen</label>
					<input type="file" class="form-control" id="imagen" name="imagen">
				</div>
			</div>
		
		</div>
		<div class="row gutters mt-5">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="text-right">
					<button type="submit" id="submit" name="enviar" class="btn btn-primary">Guardar</button>
					
<button class="btn btn-success"><a class="text-decoration-none" href="perfil.php?id=<?php echo $_SESSION['id']?>" style="color:white">Volver a Mi Perfil</a>
</button>
				</div>
			</div>
		</div>
		
	</div>

</div>
   </form>

</div>
</div>
</div>
<?php 
         
    
            
      


     if(isset($_POST['enviar'])){

     	    $user = $_POST['usuario'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            

     	    // se condiciona el tipo de imagen. 
            $nombre_imagen = $_FILES['imagen']['name'];
	        $tipo_imagen = $_FILES['imagen']['type'];
	        $tamano_imagen = $_FILES['imagen']['size'];
            
           if($tamano_imagen>1000000){
           	   echo "La imagen es demasiada grande";
           	   if($tipo_imagen!='image/jpeg' || $tipo_imagen!='image/jpg' || $tipo_imagen!='image/png' || $tipo_imagen!='image/gif'){
           	   	echo "Solo se permiten imagnes de tipo .jpg/.jpeg/.png o gif";
           	   }
           }else{
           	   //esta es la ruta donde vamos a guardar la imagen
    $destino_imagen = $_SERVER['DOCUMENT_ROOT'] . '/blog/uploads/';//htdocs
    
    move_uploaded_file($_FILES['imagen']['tmp_name'], $destino_imagen . $nombre_imagen);
				         
	                              if($nombre_imagen){     
                              	$sql = "UPDATE login SET imagen = '$nombre_imagen' WHERE id = '$id_url'";
				           	  	$resultado = $base->prepare($sql);
				              	$resultado->execute();
				            		if($resultado== false){
                						echo "Error al actualizar";
				    					}else{ ?>
									<meta http-equiv="refresh" content="1" /> // refresca la página en 1 segundo. 
									<?php }
			}
				         if($nombre_imagen==''){
                           $sql="SELECT imagen FROM login WHERE id= '$id_url'";
                           $resultado = $base->prepare($sql);
				            $resultado->execute();

				        } 
           }

				           
                
						         
       				 	
            	  if($pass){
            	  	$sql_post= "UPDATE post SET usuario='$user' WHERE id_usuario='$id_url'";
            	  	$resultado_post= $base->prepare($sql_post);

		            $resultado_post->execute();
		            $sql_com= "UPDATE comentarios SET usuario='$user' WHERE id_usuario='$id_url'";
            	  	$resultado_com= $base->prepare($sql_com);

		            $resultado_com->execute();
            	  	$pass_encriptada = password_hash($pass, PASSWORD_DEFAULT);
            	  	  $sql = "UPDATE login SET usuario='$user',email='$email',password='$pass_encriptada' WHERE id = '$id_url'";
            	  

		        $resultado= $base->prepare($sql);

		        $resultado->execute(); 
                if($resultado== false){
                echo "Error al actualizar";
				    }else{
					?>
				<meta http-equiv="refresh" content="1" />
				<script>alert("Contraseña Actualizada");</script>
				
				<?php }	
            	  }else{
            	  	$sql_post= "UPDATE post SET usuario='$user' WHERE id_usuario='$id_url'";
            	  	$resultado_post= $base->prepare($sql_post);

		            $resultado_post->execute();
		            $sql_com= "UPDATE comentarios SET usuario='$user' WHERE id_usuario='$id_url'";
            	  	$resultado_com= $base->prepare($sql_com);

		            $resultado_com->execute();
            	  	$sql = "UPDATE login SET usuario='$user',email='$email' WHERE id = '$id_url'";
            	  	

		        $resultado= $base->prepare($sql);

		        $resultado->execute(); 
                if($resultado== false){
                echo "Error al actualizar";
				    }else{
					?>
				<meta http-equiv="refresh" content="1" />
				<?php }	
            	  }
            		
			
              
              



 }
           
            
    
?>
