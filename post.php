<?php include('includes/header.php'); ?>
<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <?php
                $id_post = $_GET['id'];
                $sql = "SELECT * FROM post WHERE id = '$id_post'";
                $resultado = $base->prepare($sql);
                $resultado->execute();
                ?>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">¡Bienvenido a GeoBLOG Post!</h1>
                    <?php foreach($resultado as $datos): ?>
                    <h2 class="fw-bolder mb-1 mt-5"><?php echo $datos['titulo']; ?></h2>
                </header>
                <!-- Preview image figure--> 
                <figure class="mb-4"><img class="img-fluid rounded" src="uploads/<?php echo $datos['imagen']; ?>" alt="..." /></figure>
                <!-- Post meta content-->
                <div class="text-muted fst-italic mb-2">Posteado por <?php echo $datos['usuario']; ?> en <?php echo $datos['fecha']; ?></div>
                <!-- Post categories-->
                <a class="badge bg-primary text-decoration-none link-light" href="categoria.php?id=<?php echo $datos['categoria']; ?>"><?php echo $datos['categoria']; ?></a>
                <!-- Post content-->
                <section class="mb-5">
                    <p class="fs-5 mb-4"><?php echo $datos['post']; ?></p>
                </section>

                <!-- Botones de Editar y Eliminar -->
                <?php if(isset($_SESSION['id']) && $_SESSION['id'] == $datos['id_usuario']): ?>
                    <a href="editar_post.php?id=<?php echo $datos['id']; ?>" class="btn btn-warning">Editar</a>
                    <a href="eliminar_post.php?id=<?php echo $datos['id']; ?>" class="btn btn-danger">Eliminar</a>
                <?php endif; ?>
                <?php endforeach; ?>
            </article>
            <!-- Comments section-->
            <?php include('comentarios.php'); ?>
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
