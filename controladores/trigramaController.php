<?php

if(!isset($_SESSION)){
    session_start();
}

class TrigramaController{

    public function TrigramaController(){

    }

    /* Calcular trigrmas o Bigramas */
    /******************************************************************************************************/

    public function calcular($nombre, $ruta, $tipoCalculo){

        if($nombre == ''){
            header("location:../vistas/error.php");
        }else{

            $archivo = fopen($ruta, "r" ) or die ( "Se presentó un error al abrir el archivo.");

            $contPalabra = 0; /** Contadfor de palabras **/
            $cadena = ""; /** Llena el texto de cada trigrama **/
            $puntero = 0; /** Guarda la posición de cada trigrama completo **/
            $posicion = 0; /** Posición actual del recorrido **/
            $bigrama = array();
            $trigrama = array();

            while(!feof($archivo)){ // Mientras no llegue al final del archivo
                $obtenerCaracter = fgetc($archivo); //Obtenemos cada caracter.
                $obtenerCaracter =  utf8_encode($obtenerCaracter); //Se trata acentos y ñ.

                $posicion ++;
                        
                if($obtenerCaracter == " "){ /** Si el caracter es vacío, significa que completó una palabra **/
                    $contPalabra ++;

                    if($contPalabra == 1){ /** Si es la primera palabra del trigrama guardamos la posición en el puntero **/
                        $puntero = $posicion;
                    }else if($contPalabra == 2){
                        $bigrama[] = ltrim(strtolower($cadena));
                    }else if($contPalabra == 3){ /* Se ha completado el trigrama, por tanto imprime, inicializa variables  
                                y el cursor se posiciona al inicio del siguiente trigrama */
                        $trigrama[] = ltrim(strtolower($cadena));
                        $cadena = "";
                        $contPalabra = 0;
                        $posicion = $puntero;
                        fseek($archivo, $posicion);
                    }
                }
                $cadena = $cadena.$obtenerCaracter;     
            }

            if($tipoCalculo == 'trigrama'){
                $_SESSION['trigrama'] = $trigrama;
                echo json_encode($trigrama);
            }else if($tipoCalculo == 'bigrama'){
                $unico = array_unique($bigrama);

                foreach($unico as $datos){
                    $resp[] = $datos;
                }
                echo json_encode($resp);
            }
            fclose($archivo);
        }
    }

    /* Generación del nuevo texto */
    /******************************************************************************************************/

    public function generaNuevoTexto($palabras){

        $totalEncontrados = array();
        $aciertos = array();

        foreach($_SESSION['trigrama'] as $datos){
            if (strlen(strstr($datos, $palabras, true))>0){
                $totalEncontrados[] = $datos;
            }else if (strlen(strstr($datos, $palabras, false))>0){
                $aciertos[] = $datos;
            }
        }
        $_SESSION['totalEncontrados'] = $totalEncontrados;
        $_SESSION['aciertos'] = $aciertos;
        
        echo json_encode($_SESSION['aciertos']);
    }


    /* Recalcular nuevo juego de palabras */
    /******************************************************************************************************/

    public function recalcularTexto(){
        $nuevoTexto = array();
        $cantidad_palabras = 2;           

        foreach($_SESSION['aciertos'] as $datos){
            $palabras_arreglo = explode(" ", $datos);
            $palabras = implode(" ", array_slice($palabras_arreglo, 1, $cantidad_palabras));
            $nuevoTexto[] = $palabras;
        }
        echo json_encode($nuevoTexto);   
    }
}

?>