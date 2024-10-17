<?php
  
  include('conexion.php');
  $email_user = $_POST['email'];
  $sql = "SELECT * FROM login WHERE email = :email";
  $resultado = $base->prepare($sql);
  $resultado->execute(array(":email"=>$email_user));
  while ($datos = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $id = $datos['id'];
  }
// Varios destinatarios
$para  = $email_user; // atención a la coma
//$para .= 'wez@example.com';

// título
$título = 'Asunto: Restablecer Password';
$cadena = '123456789abcdfghijklmnopqrstwxyz';
$reordenar = substr(str_shuffle($cadena), 0,10) ;
// mensaje
$mensaje = '
<html>
<head>
  <title>Restablecer Password</title>
</head>
<body>
  <div style="text-align:center">
    <h1>Correo de restablecer password</h1>
    <img src="http://localhost/proyecto/assest/img/logo.png" width=150>
    <h3>'. $reordenar .'</h3>
    <p>Si no enviaste este correo puedes omitirlo</p>
  </div>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$cabeceras .= 'From: De: <damanyerweb@gmail.com>' . "\r\n";

// Cabeceras adicionales
/*$cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";*/

// Enviarlo
if($email_user==''){
  header("Location:formulario_restablecer.php?error=" . urldecode("Debe escribir un gmail"));//echo "Debe escribir un gmail";
}else{
  mail($para, $título, $mensaje, $cabeceras);
$pass_ecriptada = password_hash($reordenar, PASSWORD_DEFAULT);
$sql = "UPDATE login SET password = '$pass_ecriptada' WHERE id = '$id'";
$resultado = $base->prepare($sql);
$resultado->execute();
header("Location:login.php?exito=" . urldecode("Le enviamos un correo con su nuevo password"));//echo "Le enviamos un correo con su nuevo password";
}

?>