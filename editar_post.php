<?php
include('includes/header.php');

if (!isset($_SESSION["usuario"])) {
    header("Location:index.php");
}

$id_post = $_GET['id'];
$sql = "SELECT * FROM post WHERE id = '$id_post'";
$resultado = $base->prepare($sql);
$resultado->execute();
$datos = $resultado->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $post = $_POST['post'];
    $categoria = $_POST['categoria'];
    $sql_update = "UPDATE post SET titulo = ?, post = ?, categoria = ? WHERE id = ?";
    $resultado_update = $base->prepare($sql_update);
    $resultado_update->execute([$titulo, $post, $categoria, $id_post]);
    header("Location:perfil.php?id=" . $_SESSION['id']);
}
?>



<form method="post">
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" value="<?php echo $datos['titulo']; ?>">
    <br>
    <br>
    <label for="post">Contenido:</label>
    <textarea class="form-control h-25" rows="15" name="post"><?php echo $datos['post']; ?></textarea>
    <br>
    <br>
    <label for="categoria">Categoría:</label>
    <input type="text" name="categoria" value="<?php echo $datos['categoria']; ?>">
    <br>
    <br>
    <button type="submit" class="btn btn-primary" style="margin-bottom: 40px;">Actualizar</button>
</form>

<?php include('includes/footer.php'); ?>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
