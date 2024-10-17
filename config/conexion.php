<?php
			
		try{

		$base = new PDO('mysql:host=localhost; dbname=blog', 'cursophp', 'cursophp123');
		$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	}catch(Exception $e){
		die('Error al conectar con la base de datos' . $e->getMessage());
	}
	// El valor que se asigne a esa constante que es LEER_MAS, nunca va a cambiar
	define("LEER_MAS", "Leer mas");

?>