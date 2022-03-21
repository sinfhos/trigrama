<?php
    require_once 'trigramaController.php';

    $controlador = $_POST['controlador'];
    $metodo = $_POST['metodo'];
    $tipoCalculo = $_POST['tipoCalculo'];
    $nombre = '';
    $ruta = '';

    if(isset($_FILES['archivo'])){
        $nombre = $_FILES['archivo']['name'];
        $ruta = $_FILES['archivo']['tmp_name'];    
    }

    if($tipoCalculo == 'trigrama' || $tipoCalculo == 'bigrama'){
        $respuesta = new TrigramaController();
        $respuesta->calcular($nombre, $ruta, $tipoCalculo);
    }else if($tipoCalculo == 'nuevoTexto'){
        $palabras = $_POST['palabras'];
        $respuesta = new TrigramaController();
        $respuesta->generaNuevoTexto($palabras);
    }else{
        $respuesta = new TrigramaController();
        $respuesta->recalcularTexto();
    }

?>