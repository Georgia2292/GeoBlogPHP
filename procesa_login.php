<?php
    
    $user = htmlentities(addslashes($_POST['user']));
    $pass = htmlentities(addslashes($_POST['pass']));


    $user_existe=0;

        include('config/conexion.php');

    	$sql= "SELECT * FROM login WHERE usuario = :user";

    	$resultado= $base->prepare($sql);

    	$resultado->execute(array(":user"=>$user));
    
        while($datos = $resultado->fetch(PDO::FETCH_ASSOC)){
             $id = $datos['id'];
        	if(password_verify($pass, $datos['password'])){
        		$user_existe++;
        	}
        }

        if($user_existe>0){
            session_start();

            $_SESSION["usuario"] = strtolower($_POST["user"]);
        	$_SESSION["id"] = $id;
            header("Location:index.php");

            
        }else{
        	header("Location:login.php?smserror=" . urlencode("Datos Incorrectos"));
        }
        
?>