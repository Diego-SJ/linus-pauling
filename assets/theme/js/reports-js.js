$(function () {

    $('#aNombre').on('click', function(){
      if($(this).prop('checked')){
        $('#opt1').removeAttr('hidden');
        $(this).attr('value','true'); 
      } else {
        $('#opt1').attr('hidden','hidden');
        $(this).removeAttr('value'); 
      }
    });
    $('#aApellP').on('click', function(){
      if($(this).prop('checked')){
        $('#opt2').removeAttr('hidden');
        $(this).attr('value','true');
      } else {
        $('#opt2').attr('hidden','hidden');
        $(this).removeAttr('value'); 
      }
    });
    $('#aApellM').on('click', function(){
      if($(this).prop('checked')){
        $('#opt3').removeAttr('hidden');
        $(this).attr('value','true');
      } else {
        $('#opt3').attr('hidden','hidden');
        $(this).removeAttr('value'); 
      }
    });
    $('#aUsuario').on('click', function(){
      if($(this).prop('checked')){
        $('#opt4').removeAttr('hidden');
        $(this).attr('value','true');
      } else {
        $('#opt4').attr('hidden','hidden');
        $(this).removeAttr('value'); 
      }
    });
    $('#aPassword').on('click', function(){
      if($(this).prop('checked')){
        $('#opt5').removeAttr('hidden');
        $(this).attr('value','true');
      } else {
        $('#opt5').attr('hidden','hidden');
        $(this).removeAttr('value'); 
      }
    });
    $('#aGrado').on('click', function(){
      if($(this).prop('checked')){
        $('#opt6').removeAttr('hidden');
        $(this).attr('value','true');
      } else {
        $('#opt6').attr('hidden','hidden');
        $(this).removeAttr('value'); 
      }
    });
    $('#aGrupo').on('click', function(){
      if($(this).prop('checked')){
        $('#opt7').removeAttr('hidden');
        $(this).attr('value','true');
      } else {
        $('#opt7').attr('hidden','hidden');
        $(this).removeAttr('value'); 
      }
    });
    $('#aLecturas').on('click', function(){
      if($(this).prop('checked')){
        $('#opt8').removeAttr('hidden');
        $(this).attr('value','true');
      } else {
        $('#opt8').attr('hidden','hidden');
        $(this).removeAttr('value'); 
      }
    });
    $('#aAciertos').on('click', function(){
      if($(this).prop('checked')){
        $('#opt9').removeAttr('hidden');
        $(this).attr('value','true');
      } else {
        $('#opt9').attr('hidden','hidden');
        $(this).removeAttr('value'); 
      }
    });
    $('#aIncorrectos').on('click', function(){
      if($(this).prop('checked')){
        $('#opt10').removeAttr('hidden');
        $(this).attr('value','true');
      } else {
        $('#opt10').attr('hidden','hidden');
        $(this).removeAttr('value'); 
      }
    });
    $('#aPromedio').on('click', function(){
      if($(this).prop('checked')){
        $('#opt11').removeAttr('hidden');
        $(this).attr('value','true');
      } else {
        $('#opt11').attr('hidden','hidden');
        $(this).removeAttr('value'); 
      }
    });

    $('#pdfAlumnoForm').submit(function(e) {
        if($('#alumnoFiltro option:selected').val() == 0){
          alert("Selecciona un filtro.");
          e.preventDefault();
        }
    });

    //REPORT LECTURAS
    $('#lTtitulo').on('click', function(){
        if($(this).prop('checked')){
            $('#opt1l').removeAttr('hidden');
            $(this).attr('value','true'); 
        } else {
            $('#opt1l').attr('hidden','hidden');
            $(this).removeAttr('value'); 
        }
    });
    $('#lAutor').on('click', function(){
        if($(this).prop('checked')){
            $('#opt2l').removeAttr('hidden');
            $(this).attr('value','true'); 
        } else {
            $('#opt2l').attr('hidden','hidden');
            $(this).removeAttr('value'); 
        }
    });

    $('#lDescripcion').on('click', function(){
        if($(this).prop('checked')){
            $('#opt3l').removeAttr('hidden');
            $(this).attr('value','true'); 
        } else {
            $('#opt3l').attr('hidden','hidden');
            $(this).removeAttr('value'); 
        }
    });

    $('#lFecha').on('click', function(){
        if($(this).prop('checked')){
            $('#opt4l').removeAttr('hidden');
            $(this).attr('value','true'); 
        } else {
            $('#opt4l').attr('hidden','hidden');
            $(this).removeAttr('value'); 
        }
    });

    $('#lTipo').on('click', function(){
        if($(this).prop('checked')){
            $('#opt5l').removeAttr('hidden');
            $(this).attr('value','true'); 
        } else {
            $('#opt5l').attr('hidden','hidden');
            $(this).removeAttr('value'); 
        }
    });
    
    $('#lReactivos').on('click', function(){
        if($(this).prop('checked')){
            $('#opt6l').removeAttr('hidden');
            $(this).attr('value','true'); 
        } else {
            $('#opt6l').attr('hidden','hidden');
            $(this).removeAttr('value'); 
        }
    });
  })
