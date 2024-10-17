<?php
   
   
   include('includes/header.php');
   
   // Por si el usuario no está logueado, redirigir al usuario a index. 
   if(!isset($_SESSION["usuario"])){
   	header("Location:index.php");
   }
      $id_url = $_GET['id'];
            
      $sql ="SELECT * FROM login WHERE id = '$id_url'";
      $resultado = $base->prepare($sql);
      $resultado->execute();
      
      

      /*$sql_post = "SELECT distinct categoria FROM post WHERE id_usuario = '$id_url'";   
      $resultado_post = $base->prepare($sql_post);
      $resultado_post->execute();
      $registro = $resultado_post->rowCount();*/
      
   
?>
    <div class="container mt-5 mb-5">
    <div class="main-body">
   
          <!-- Breadcrumb -->
          <!--<nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>-->
          <!-- /Breadcrumb -->
    <br>
          <div class="row gutters-sm">
            <div class="col-md-12 mb-4">
              <div class="card" >
                <div class="card-body">
                  <?php foreach($resultado as $datos):?>

                  <div class="d-flex flex-column align-items-center text-center" >
                      
                    <img src="uploads/<?php echo $datos['imagen'];?>" alt="Admin" class="rounded-circle" width="150" height="150">
                    <div class="mt-3">
                      <h4><?php echo $datos['usuario']?></h4>
                      <p class="text-muted font-size-sm">Correo: <?php echo $datos["email"]?><br>
                        <span class="mt-3 mb-2">Post:
                          <?php 
                      $sql_post = "SELECT distinct categoria FROM post WHERE id_usuario = '$id_url'";
                      $resultado_post = $base->prepare($sql_post);
                      $resultado_post->execute();
                      foreach ($resultado_post as $datos):

                      ?>
                      <a class="badge bg-primary text-decoration-none link-light" href="categoria.php?id=<?php echo $datos['categoria'] ?>"><?php echo $datos['categoria'] ?></a>
                    <?php endforeach; ?> 
                        </span>
                      </p>

                      <?php endforeach; ?>
                      
                                          
                      <form action="procesa_seguir.php" method="post">
                        <input type="hidden" name="id_url" value="<?php echo $id_url ?>"><br>
                        <input type="hidden" name="id_seguir" value="<?php echo $_SESSION["id"] ?>"><br>
                        <input type="hidden" name="usuario_seguir" value="<?php echo $_SESSION["usuario"] ?>"><br>
                    
                      <?php if($_SESSION['id']== $id_url): ?>
                      <button class="btn btn-primary"><a class="text-decoration-none link-light" href="editar_perfil.php?id=<?php echo $_SESSION['id']?>">Editar Perfil</a></button>
                        <a class="text-decoration-none btn btn-outline-primary" href="cerrar_sesion.php">Cerrar Sesion</a>

                       <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
                  
                  /*$contador=0;
                  if(isset($_POST['seguir'])){
                    $contador++;
                    $id_usuario_s = $_POST['id_seguir'];
                    $usuario_s = $_POST['usuario_seguir'];
                    
                    $sql = "INSERT INTO seguir (id_usuario_s,usuario_s,usuario,contador) VALUES ('$id_usuario_s','$usuario_s','$id_url',$contador)";
                    $resultado = $base->prepare($sql);
                    $resultado->execute();
                  }*/

               ?>
               
                                      
                             
            </div>
           
          </div>
           
        </div>
    </div>

     