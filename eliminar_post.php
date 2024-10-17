<?php
include('includes/header.php');

if (!isset($_SESSION["usuario"])) {
    header("Location:index.php");
}

$id_post = $_GET['id'];
$sql_delete = "DELETE FROM post WHERE id = ?";
$resultado_delete = $base->prepare($sql_delete);
$resultado_delete->execute([$id_post]);

header("Location:perfil.php?id=" . $_SESSION['id']);
?>
