<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="publica/js/jquery-3.6.0.js"></script>
    <script src="publica/js/funcionesBitri.js"></script>
    <link rel="stylesheet" href="publica/css//estilos.css">
    
    <title>Bitri</title>
</head>
<body>
    <div class="container principal">
        <h1>Bitri - El juego de trigramas</h1>
        <hr>
        <div class="container contieneForm" id="contienePrincipal" style="width: 60%;">
            <div id="subirArchivo">
                <form id="formSubir">
                    <input type="file" name="archivo" id="archivo" accept=".txt">
                </form>

                <div class="contieneBotones">
                    <button type="button" id="calcularTrigrama">Calcular Trigrama</button>
                </div>
            </div>

            <div id="contieneTrigrama">
                <p class="titulo">Resultado del Trigrama</p>

                <div id="resultadoTrigrama">

                </div>

                <div class="contieneBotones">
                    <button type="button" id="calcularBigrama">Calcular Bigrama</button>
                </div>
            </div>

            <div id="contieneBigrama">
                <p class="titulo">Resultado del Bigrama</p>

                <div id="resultadoBigrama">

                </div>

                <div>
                    <p>Seleccione un juego de palabras para generar el nuevo texto</p>
                    <select name="" id="palabras">
                        <option value="">Seleccione...</option>
                    </select>
                </div>

                <div class="contieneBotones">
                    
                    <button type="button" id="btnBigrama" class="nuevoTexto">Generar nuevo texto</button>
                    <button type="button" class="anterior">Regresar</button>
                </div>
            </div>

            <div id="contieneAnalisis">
                <p class="titulo">Análisis de las palabras seleccionadas</p>

                <div id="resultadoAnalisis">

                </div>

                <div id="contieneNuevasPalabras">
                    <p>Seleccione un juego de palabras para generar el nuevo texto</p>
                    <select name="" id="nuevasPalabras">
                        <option value="">Seleccione...</option>
                    </select>
                </div>

                <div class="contieneBotones">
                    <button type="button" id="btnPalabras" class="nuevoTexto">Generar nuevo texto</button>
                    <button type="button" id="recalcular">Obtener juego de palabras</button>
                    <button type="button" class="regresar">Regresar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="contienePie">
        <p>Ing: Nelsonn Fernando Silva Saavedra</p>
        <p>sinfhos@gmail.com</p>
        <p>Cellulr: 3174418097</p>
    </div>
</body>
</html>