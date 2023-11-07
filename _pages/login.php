<script>
function showLogin(){
$("#register").css("display", "none");
$("#login").css("display", "flex");
}

function showRegister(){
$("#login").css("display", "none");
$("#register").css("display", "flex");
}

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
            else window.location.href = urlSite;
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
            else window.location.href = urlSite;          
        }
});
});

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

//setTimeout(function () { showRegister(); }, 10);
</script>

<main id="main">
<section class="section newsletter" id="contact">
<div class="container">

<div class="user" id="login">
<div class="box">
<span class="title">Entre com sua conta</span>
<form>
<input placeholder="Digite seu email" type="text" name="email">
<input placeholder="Digite sua senha" type="password" name="pass">
<input class="submit" type="submit" value="Entrar">
</form>
<div class="footer">
    <span>Ainda não tem uma conta?</span>
    <a href="#" onclick="showRegister()">Registre-se</span></a>
</div>
</div>
</div>

<div class="user" id="register">
<div class="box">
<span class="title">Crie sua conta</span>
<form>
<input placeholder="Nome completo" type="text" name="username">
<input placeholder="Email" type="text" name="email">
<div style="display: inline-flex;">
<input placeholder="Senha" type="password" style="margin-right: 5px;" name="pass">
<input placeholder="Repita a senha" type="password" name="pass2">
</div>
<input placeholder="CEP (Apenas numeros)" maxlength="8" name="cepzin" id="cepzin">

<div class="endereco">
<input placeholder="Rua" type="text" name="rua" readonly />
<div style="display: inline-flex;">
<input placeholder="Nº" type="number" name="numero" style="margin-right: 5px;" readonly />
<input placeholder="Estado" type="text" name="uf" readonly />
</div>
<div style="display: inline-flex;">
<input placeholder="Cidade" type="text" name="cidade" style="margin-right: 5px;" readonly />
<input placeholder="Bairro" type="text" name="bairro" readonly />
</div>
</div>

<input class="submit" type="submit" value="Registrar" disabled>
</form>
<div class="footer">
    <span>Já tem uma conta?</span>
    <a href="#" onclick="showLogin()">Logar</span></a>
</div>
</div>
</div>


</div>
</section>
</main>