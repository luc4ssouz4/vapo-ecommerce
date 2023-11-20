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
            else location.reload(true);
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
            else location.reload(true);       
        }
});
});

// PROMOCOES
$(document).on("submit", '#newsletter', function (e) {
    e.preventDefault();
    $("#newsletter .newsletter__link").attr("disabled", "disabled").val("Carregando...");
    
    $.getJSON({
        url: "/ajax/newsletter",
        method: "POST",
        data: $(this).serialize(),
        success: function (data) {

            $("#newsletter .newsletter__link").removeAttr("disabled").val("Receber");      
            if(data.result.error)
            SnackBar({
                message: data.result.message,
                status: "error",
                fixed: true,
                position: "tr",
                icon: "!"
            });
            else
            $("#newsletter .newsletter__email").val(""),
            SnackBar({
                message: data.result.message,
                fixed: true,
                status: "success",
                position: "tr",
                icon: "!"
            });
        }
    });
    
});


// profile


$(document).on("submit", 'form#pessoal', function (e) {
    e.preventDefault();
    $("#pessoal .form-submit").attr("disabled", "disabled").val("Carregando...");

    $.getJSON({
        url: "/ajax/edit_user_info",
        method: "POST",
        data: $(this).serialize(),
        success: function (data) {

            $("#pessoal .form-submit").removeAttr("disabled").val("Editar");
            if(data.result.error)
            SnackBar({
                message: data.result.message,
                status: "error",
                fixed: true,
                position: "tr",
                icon: "!"
            });
            else
            SnackBar({
                message: data.result.message,
                status: "success",
                fixed: true,
                position: "tr",
                icon: "!"
            });    
        }
});
});


$(document).on("submit", 'form#contato', function (e) {
    e.preventDefault();
    $("#contato .form-submit").attr("disabled", "disabled").val("Carregando...");

    $.getJSON({
        url: "/ajax/edit_user_contato",
        method: "POST",
        data: $(this).serialize(),
        success: function (data) {

            $("#contato .form-submit").removeAttr("disabled").val("Editar");
            if(data.result.error)
            SnackBar({
                message: data.result.message,
                status: "error",
                fixed: true,
                position: "tr",
                icon: "!"
            });
            else
            SnackBar({
                message: data.result.message,
                status: "success",
                fixed: true,
                position: "tr",
                icon: "!"
            });    
        }
});
});


function logOut(){
    document.cookie = "hash=; expires=Thu, 18 Dec 2013 12:00:00 UTC";
    location.reload(true);
}

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




function updateCart(id, type, price){
    $(".cart__totals").css("opacity", "0.3");
    
    var qnt = $("#itemQnt_"+id).val();
    
    if(type == "+")
    if(qnt < 10)
    qnt = parseInt(qnt) + 1;
    
    if(type == "-")
    if(qnt > 1)
    qnt = parseInt(qnt) - 1;
    
    $("#itemQnt_"+id).val(qnt);
    
    var subTotal = (qnt * price);
    $("#itemPrice_"+id).html(`R$${subTotal.toFixed(2)}`);
    
    
    $.getJSON({
            url: "/ajax/update_cart",
            method: "POST",
            data: { id:id, type:type, qnt:qnt},
            success: function (data) {
                $("#cart__total").html(`${data.result.countCart}`);
                $(".new__price.update_total").html(`R$${data.result.subTotal.toFixed(2)}`);
                $(".cart__totals").css("opacity", "1");
            }
    });    
    
    }
    
    function delItemCart(id){
        $(".cart__totals").css("opacity", "0.3");
        $("#itemCart_"+id).css("opacity", "0.3");
    
        $.getJSON({
            url: "/ajax/update_cart_remove",
            method: "POST",
            data: { id:id},
            success: function (data) {
                $("#itemCart_"+id).remove();
                $("#cart__total").html(`${data.result.countCart}`);
                $(".new__price.update_total").html(`R$${data.result.subTotal.toFixed(2)}`);
                $(".cart__totals").css("opacity", "1");
            }
    });    
        
    }