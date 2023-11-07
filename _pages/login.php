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
    $("#login .submit").attr("disabled", "disabled");
    $("#login .submit").val("Carregando...");
    
    $.ajax({
        url: "/ajax/login",
        method: "POST",
        data: $(this).serialize(),
        success: function (data) {
            //resultado              
        }
    });
    SnackBar({
                message: "Snackbar created successfully!",
                status: "error"
    });
});

// REGISTRO
$(document).on("submit", '#register form', function (e) {
    e.preventDefault();
    $("#register .submit").attr("disabled", "disabled");
    $("#register .submit").val("Carregando...");

    $.ajax({
        url: "/ajax/register",
        method: "POST",
        data: $(this).serialize(),
        success: function (data) {
            //resultado              
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
    $("[name='bairro']").val(data.bairro);
    
    }).fail(function() {
    $("#cepzin").addClass("error");
    });
}
</script>

<main id="main">
<section class="section newsletter" id="contact">
<div class="container">
<div class="user" id="login">
<div class="box">
<span class="title">Entre com sua conta</span>
<form>
<input placeholder="Digite seu email" type="text" name="username">
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
<input placeholder="Nome completo" name="username">
<input placeholder="Email">
<div style="display: inline-flex;">
<input placeholder="Senha" style="margin-right: 5px;" name="pass">
<input placeholder="Repita a senha" name="pass2">
</div>
<input placeholder="CEP (Apenas numeros)" maxlength="8" name="cepzin" id="cepzin">

<div class="endereco">
<input placeholder="Rua" name="rua" readonly />
<div style="display: inline-flex;">
<input placeholder="Nº" name="numero" style="margin-right: 5px;" readonly />
<input placeholder="Estado" name="uf" readonly />
</div>
<div style="display: inline-flex;">
<input placeholder="Cidade" name="cidade" style="margin-right: 5px;" readonly />
<input placeholder="Bairro" name="bairro" readonly />
</div>
</div>

<input class="submit" type="submit" value="Registrar">
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