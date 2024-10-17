<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Crear Post - Blog</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Crear Post</h3></div>
                                    <div class="card-body">
            <?php
              include('config/conexion.php');
              $id_user = $_GET['id'];
              $sql = "SELECT usuario FROM login WHERE id = '$id_user'";
              $resultado = $base->prepare($sql);
              $resultado->execute();
            ?>
                                        <form action="procesa_crear_post.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id_usuario" value="<?php echo $id_user ?>">
                                            <?php foreach ($resultado as $datos): ?>
                                            <input type="hidden" name="usuario" value="<?php echo $datos['usuario'] ?>">
                                            <?php endforeach; ?>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" type="text" placeholder="Título" name="titulo" />
                                                        <label for="inputFirstName">Título</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" type="text" placeholder="Categoría" name="categoria" />
                                                        <label for="inputLastName">Categoría</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-control mb-3">
                                                <label for="inputLastName">Imagen</label>
                                                <input class="form-control" type="file" name="imagen" />
                                                
                                            </div>
                                            
                                                
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control h-25" rows="5" placeholder="Post" name="post" /></textarea>
                                                        <label for="inputPassword">Post</label>
                                                    </div>
                                                
                                                
                                            
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button class="btn btn-primary" type="submit" name="enviar">Crear Post</button></div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; GeoBlog 2024</div>
                            <div>
                                <a href="#">Políticas de privacidad</a>
                                &middot;
                                <a href="#">Términos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
