$(document).ready(function() {
    $("#navbar-auto-hidden").autoHidingNavbar();
    $(".button-mobile-menu").click(function(){
        $("#mobile-menu-list").animate({width: 'toggle'},200);
    });	
    $('.all-elements-tooltip').tooltip('hide');
    $('.userConBtn').on('click', function(e){
        e.preventDefault();
        var code=$(this).attr('data-code');
        $.ajax({
            url: './process/selectDataUser.php',
            type: 'POST',
            data: 'code='+code,
            success:function(data){
                $('#UserConData').html(data);
                $('#ModalUpUser').modal({
                    show: true,
                    backdrop: "static"
                });
            }
        });
        return false;
    });
    $('.exit-system').on('click', function(e){
        e.preventDefault();
        swal({
            title: "¿Quieres salir del sistema?",   
            text: "Estas seguro que quieres cerrar la sesión actual y salir del sistema",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#16a085",   
            confirmButtonText: "Si, salir",
            cancelButtonText: "No, cancelar",
            closeOnConfirm: false,
            animation: "slide-from-top"
        }, function(){
            window.location='process/logout.php';
        });
    });
    /*Funcion para enviar datos de formularios con ajax*/
    $('.FormCatElec').submit(function(e){
        e.preventDefault();
        var StatusInfo='<div class="content-send-form"></div>';
        var formType=$(this).attr('data-form');
        var form=$(this);
        var formdata=false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
        var formAction = form.attr('action');
        var metodo=form.attr('method');

        if(formType=="login"){
            $.ajax({
                type: metodo,
                url: formAction,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $(".ResFormL").html('Iniciando sesión...');
                },
                error: function() {
                    $(".ResFormL").html("Ha ocurrido un error en el sistema");
                },
                success: function (data) {
                    $(".ResFormL").html(data);
                }
            });
            return false;
        }else{
            swal({
                title: "¿Estás seguro?",   
                text: "Quieres realizar la operación solicitada, una vez realizada la operación no se podrá revertir",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#16a085",   
                confirmButtonText: "Si, realizar",
                cancelButtonText: "No, cancelar",
                closeOnConfirm: false,
                animation: "slide-from-top"
            }, function(){
                $.ajax({
                    xhr: function(){
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                          if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('.content-send-form').html('<p class="text-center" style="padding-top: 10px;">Procesando... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar" style="width: '+percentComplete+'%"></div></div>');
                          }
                        }, false);
                        return xhr;
                    },
                    type: metodo,
                    url: formAction,
                    data: formdata ? formdata : form.serialize(),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $(".ResbeforeSend").html(StatusInfo);
                    },
                    error: function() {
                        $(".ResbeforeSend").html("Ha ocurrido un error en el sistema");
                    },
                    success: function (data) {
                        $(".ResbeforeSend").html(data);
                    }
                });
                return false;
            });
        }
    });
});
