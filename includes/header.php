<?php include('config/conexion.php');
	  include('funciones.php');
	  session_start();
	  $leer_mas = LEER_MAS;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>GeoBLOG</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="index.php">GeoBLOG</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    	<!--<li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>-->
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Blog</a></li>
                        <?php if(!isset($_SESSION['id'])): ?>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="login.php">Acceder</a></li>
                        <?php else: ?>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="perfil.php?id=<?php echo $_SESSION['id'] ?>">Mi Perfil</a></li>
                        <?php
                          $id_user = $_SESSION['id'];
                          $sql = "SELECT imagen FROM login WHERE id = '$id_user'";
                          $resultado = $base->prepare($sql);
                          $resultado->execute();
                           foreach ($resultado as $datos):
                        ?>
            <img width="40px" height="40px" class="rounded-circle" src="uploads/<?php echo $datos['imagen'] ?>" alt="..." />
                    <?php endforeach; ?>
                <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>