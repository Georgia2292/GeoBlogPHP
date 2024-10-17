<?php include('includes/header.php');?>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>

                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1">¡Bievenido a GeoBLOG Post!</h1>
                             <?php

                          $porpagina = 3;//esta es la cantidad de registros que quiero que me muestre por pagina
                                if(isset($_GET['pagina'])){
                                    if($_GET['pagina']==1){
                                        header("Location:index.php");
                                    }else{
                                        $pagina=$_GET['pagina'];
                                    }
                                }else{
                                    $pagina = 1;//primera pagina(index.php)
                                }

                            $siguiente = $pagina+1;
                            $anterior = $pagina-1;

                            $desde = ($pagina-1)*$porpagina;

                          $sql = "SELECT * FROM post ORDER BY post ASC";
                          $resultado = $base->prepare($sql);
                          $resultado->execute();
                          $registros=$resultado->rowCount();                       
                          $total_paginas = ceil($registros/$porpagina);
                          if ($registros>0){
                        ?>

                        <?php 

                          $sql = "SELECT * FROM post LIMIT $desde,$porpagina";
                          $resultado = $base->prepare($sql);
                          $resultado->execute();

                        ?>

                            <?php foreach($resultado as $datos): ?>
                            <h2 class="fw-bolder mb-1 mt-5"><?php echo $datos['titulo']
                            ?></h2>    
                        </header>
                        <!-- Preview image figure--> 
                        <figure class="mb-4"><img class="img-fluid rounded" src="uploads/<?php echo $datos['imagen']
                            ?>" alt="..." /></figure>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">Posteado por <?php echo $datos['usuario']
                            ?> en <?php echo $datos['fecha']
                            ?></div>
                            <!-- Post categories-->
                            <a class="badge bg-primary text-decoration-none link-light" href="categoria.php?id=<?php echo $datos['categoria'] ?>"><?php echo $datos['categoria'] ?></a>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4"><?php echo recortarTexto($datos['post']) 
                            ?></p>
                            <a class="btn bg-primary text-decoration-none link-light" href="post.php?id=<?php echo $datos['id'] ?>"><?php echo $leer_mas;
                            ?></a>                
                        </section>
                        <?php endforeach; ?>
                    </article>
                    <!-- PAGINACIÓN -->
                    <div class="paginacion">

                    <?php 
                    if($registros>=4){
                        /*
                           $siguiente = $pagina+1;
                           $anterior = $pagina-1;//6
                       */  
                       $pasos = $siguiente+1;//3
                       if($pagina==$total_paginas){
                        $pasos = $anterior+1;//17
                       }else{
                        $pasos-=1;
                       }  
                     ?>
                    
                     <?php 
                     //flecha anterior
                          if(isset($_GET['pagina']) && $_GET['pagina']>1){
                            echo "<a href='index.php'>Primera</a>";
                            echo "<a href='?pagina=" . $anterior . "'>&laquo;</a>"; 
                          }
                          
                       ?> 

                    <?php 
                      //paginacion
                        for($i=$pagina;$i<=$pasos;$i++){
                        echo "<a href='?pagina=" . $i . "'>" . $i . "</a> ";
                       }
                     ?>
                      
                      <?php 
                      //flecha siguiente
                          if(!isset($_GET['pagina']) || $_GET['pagina']<$total_paginas){
                            echo "<a href='?pagina=" . $siguiente . "'>&raquo;</a>";
                            echo "<a href='?pagina=" . $total_paginas . "'>Ultima</a>"; 
                          }
                          
                       ?>
            <?php   }
     }else{
        echo "<h3>No hay post aún!</h3>";
     }
             ?>
             
        </div>

                    <!-- FIN PAGINACIÓN -->                
                </div>
                <!-- Side widgets-->
                <?php include('includes/aside.php'); ?>
            </div>
        </div>
        <!-- Footer-->
        <?php include('includes/footer.php'); ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>