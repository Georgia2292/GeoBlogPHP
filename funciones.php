<?php 

	function recortarTexto($post, $chart = 410){
		$post = $post . " ";
		$post = substr($post, 0, $chart);
		$post = substr($post, 0, strrpos($post, " "));
		$post = $post . "...";
		return $post;
	}
?>