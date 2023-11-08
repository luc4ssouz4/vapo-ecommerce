<?php
if(!LOGADO){
?>
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
<?php }else{ ?>

Logado em: <?= $user['nome']; ?>

<?php } ?>