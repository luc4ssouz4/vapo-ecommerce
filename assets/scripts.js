// LOGIN
$(document).on("submit", '#login form', function (e) {
    e.preventDefault();
    $("#login .submit").attr("disabled", "disabled").val("Carregando...");
    
    $.getJSON({
        url: "/ajax/login",
        method: "POST",
        data: $(this).serialize(),
        success: function (data) {

            $("#login .submit").removeAttr("disabled").val("Entrar");            
            if(data.result.error)
            SnackBar({
                message: data.result.message,
                status: "error",
                position: "tr",
                icon: "!"
            });
            else window.location.href = data.result.urlRedirect;
        }
    });
    
});

// REGISTRO
$(document).on("submit", '#register form', function (e) {
    e.preventDefault();
    $("#register .submit").attr("disabled", "disabled").val("Carregando...");

    $.getJSON({
        url: "/ajax/register",
        method: "POST",
        data: $(this).serialize(),
        success: function (data) {

            $("#register .submit").removeAttr("disabled").val("Registrar");
            if(data.result.error)
            SnackBar({
                message: data.result.message,
                status: "error",
                position: "tr",
                icon: "!"
            });
            else window.location.href = data.result.urlRedirect;          
        }
});
});


function showLogin() {
    $("#register").css("display", "none");
    $("#login").css("display", "flex");
}

function showRegister() {
    $("#login").css("display", "none");
    $("#register").css("display", "flex");
}

var timerCep;
$(document).on("keydown", "#cepzin", function(e) {
        $("#cepzin").removeClass("error");
        clearTimeout(timerCep);
        timerCep = setTimeout(function () { validaCep(); }, 850);
});

function validaCep(){
    $.getJSON( "https://viacep.com.br/ws/"+$("#cepzin").val()+"/json/", function( data ) {

    if(data.erro)
    $("#cepzin").addClass("error");
    else    
    $("[name='numero']").removeAttr("readonly").focus(),    
    $("[name='rua']").val(data.logradouro),
    $("[name='uf']").val(data.uf),
    $("[name='cidade']").val(data.localidade),
    $("[name='bairro']").val(data.bairro),
    $("#register .submit").removeAttr("disabled");

    
    }).fail(function() {
    $("#cepzin").addClass("error");
    });
}