<?php
    
    include('config/conexion.php');
    $user = htmlentities(addslashes($_POST['user']));
    $pass = htmlentities(addslashes($_POST['pass']));
    $email = $_POST['email'];
    $imagen_pre = "1.png";

    //comprobar email
    $sql = "SELECT * FROM login WHERE email = :email OR usuario = :user";
    $resultado= $base->prepare($sql);

    $resultado->execute(array(":email"=>$email,":user"=>$user));

    $existe = $resultado->rowCount();

    if($existe>0){
        echo "El usuario o email ya existe";
        exit();
    }
    
    //procesa imagen
     $nombre_imagen = $_FILES['imagen']['name'];
     $tipo_imagen = $_FILES['imagen']['type'];
     $tamano_imagen = $_FILES['imagen']['size'];

    if($tamano_imagen<1000000){
        if($tipo_imagen=='image/jpeg' || $tipo_imagen=='image/jpg' || $tipo_imagen=='image/png' || $tipo_imagen=='image/gif'){
        //esta es la ruta donde vamos a guardar la imagen
    $destino_imagen = $_SERVER['DOCUMENT_ROOT'] . '/Blog/uploads/';//htdocs
    
    move_uploaded_file($_FILES['imagen']['tmp_name'], $destino_imagen . $nombre_imagen);
    }else{
        header("Location:registro_user.php?error=" . urlencode("Solo se permiten imagnes de tipo .jpg/.jpeg/.png o gif"));
    }
}else{
        header("Location:registro_user.php?error2=" . urlencode("La imagen es demasiada grande"));
    }
    //fin procesa imagen

    $pass_encriptada = password_hash($pass, PASSWORD_DEFAULT);

        if($nombre_imagen){
            $sql= "INSERT INTO login (usuario, password, email, imagen) VALUES(:user,:pass,:email,:imagen)";

        $resultado= $base->prepare($sql);

        $resultado->execute(array(":user"=>$user,":pass"=>$pass_encriptada,":email"=>$email,":imagen"=>$nombre_imagen));
    
        

        if($resultado==false){
            echo "Error al registrarnos";
            
        }else{
            header("Location:login.php?mensaje=" . urlencode("Puedes Acceder"));
        }
    }else{
        $sql= "INSERT INTO login (usuario, password, email, imagen) VALUES(:user,:pass,:email,:imagen)";

        $resultado= $base->prepare($sql);

        $resultado->execute(array(":user"=>$user,":pass"=>$pass_encriptada,":email"=>$email,":imagen"=>$imagen_pre));
    
        

        if($resultado==false){
            echo "Error al registrarnos";
            
        }else{
            header("Location:login.php?mensaje=" . urlencode("Puedes Acceder"));
        }
        

    }

?>