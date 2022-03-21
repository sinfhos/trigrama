$(function(){
    $("#calcularTrigrama").click(function(){
        CalcularTrigrama();
    })

    $("#calcularBigrama").click(function(){
        CalcularBigrama();
    })

    $(".nuevoTexto").click(function(){
        var id = $(this).attr('id');
        var recalcular = false;

        if(id != 'btnBigrama'){
            recalcular = true
            $("#btnPalabras").css("display", "none");
        }

        CalcularNuevoTexto(recalcular);
    })

    $("#recalcular").click(function(){
        recalcularTexto();
    })

    $(".anterior").click(function(){
        $("#palabras").html('');     
        $("#contieneBigrama").css('display', 'none');
        $("#contieneTrigrama").css('display', 'none');
        $("#recalcular").css("display", "none");   
        $("#subirArchivo").css("display", "block");
        $("#resultadoTrigrama").html('');
        $("#resultadoBigrama").html('');
        
    })

    $(".regresar").click(function(){
        $("#recalcular").css("display", "block");
        $("#contieneBigrama").css('display', 'block');
        $("#contieneTrigrama").css('display', 'block');
    })

    $(".anterior, .regresar").click(function(){
        $("#resultadoAnalisis").html('');
        $("#nuevasPalabras").html('');       
        $("#contieneAnalisis").css('display', 'none');
        $("#contieneNuevasPalabras").css("display", "none");  
        $("#btnPalabras").css("display", "none");
    })

})


/************************************************************************************************************/

function CalcularTrigrama(){
    if ($('#archivo').val()) { 
        const inputFile = document.querySelector("#archivo");    
        var formData = new FormData();
        formData.append('archivo', inputFile.files[0]);
        formData.append('controlador', 'TrigramaController');
        formData.append('metodo', 'calcular');
        formData.append('tipoCalculo', 'trigrama');
            
        $.ajax({
            url:'controladores/controlador.php',
            type: 'POST',
            cache: false,
            contentType : false,
            processData : false,
            data: formData
        })
        .done(function(res){
            $("#subirArchivo").css("display", "none");
            $("#contieneTrigrama").css('display', 'block');
            var respuesta = JSON.parse(res);
            var longitud = respuesta[0].length;
            console.log(respuesta);
            for(var i = 0; i <= longitud; i++){
                $("#resultadoTrigrama").append('<p>'+ respuesta[i] + '</p>');
                $("#anterior").css("display", "block");
            }
        })
    }else{
        window.location.href = "vistas/error.php";
    }
}

/************************************************************************************************************/

function CalcularBigrama(){
    const inputFile = document.querySelector("#archivo");   
    var formData = new FormData();
    formData.append('archivo', inputFile.files[0]);
    formData.append('controlador', 'TrigramaController');
    formData.append('metodo', 'calcular');
    formData.append('tipoCalculo', 'bigrama');
        
    $.ajax({
        url:'controladores/controlador.php',
        type: 'POST',
        cache: false,
        contentType : false,
        processData : false,
        data: formData
    })
    .done(function(res){
        $("#subirArchivo").css("display", "none");
        $("#contieneBigrama").css('display', 'block');
        var respuesta = JSON.parse(res);
        var longitud = respuesta.length;
   
        console.log(respuesta);
        for(var i = 0; i < longitud; i++){
            $("#resultadoBigrama").append('<p>'+ respuesta[i] + '</p>');
            $("#palabras").append("<option value='" + respuesta[i] + "'>" + respuesta[i] + "</option>");
        }
    })
}


/************************************************************************************************************/

function CalcularNuevoTexto(recalcular){
    $("#resultadoAnalisis").html('');
    
    if(recalcular == false){
        var palabras = document.getElementById('palabras').value;
    }else{
        var palabras = $.trim(document.getElementById('nuevasPalabras').value);
    }

    if(palabras == ''){
        alert('Falta seleccionar un juego de palabras para generar el nuevo texto.')
        $("#palabras").focus();
    }else{
        const inputFile = document.querySelector("#archivo");
    
        var formData = new FormData();
        formData.append('archivo', inputFile.files[0]);
        formData.append('controlador', 'TrigramaController');
        formData.append('metodo', 'generarNuevoTexto');
        formData.append('tipoCalculo', 'nuevoTexto');
        formData.append('palabras', palabras);
        
        $.ajax({
            url:'controladores/controlador.php',
            type: 'POST',
            cache: false,
            contentType : false,
            processData : false,
            data: formData
        })
        .done(function(res){
            var respuesta = JSON.parse(res);   
            var longitud = respuesta.length;
            console.log(respuesta);
            $("#contieneBigrama").css('display', 'none');
            $("#contieneTrigrama").css('display', 'none');
            $("#contieneAnalisis").css('display', 'block');

            for(var i = 0; i < longitud; i++){
                $("#resultadoAnalisis").append('<p>'+ respuesta[i] + '</p>');
            }
        })
    }
}


/************************************************************************************************************/

function recalcularTexto(){
    $.ajax({
        url:'controladores/controlador.php',
        type: 'POST',
        cache: false,
        data: {
            controlador : 'controlador', 
            metodo      : 'recalcular',
            tipoCalculo : 'recalcular'
        }
    })
    .done(function(res){
        var respuesta = JSON.parse(res); 
        var longitud = respuesta.length;

        for(var i = 0; i < longitud; i++){
            $("#contieneNuevasPalabras").css("display", "block");
            $("#recalcular").css("display", "none");
            $("#btnPalabras").css("display", "block");

            $("#nuevasPalabras").append("<option value='" + respuesta[i] + "'>" + respuesta[i] + "</option>");
        }
    
    })
}