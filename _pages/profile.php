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

<main id="main">
<section class="section">
<div class="container">

<div class="profile">
<div class="boxzinha">

<div class="logout" onclick="logOut()">
    <i class="fa-solid fa-arrow-right-from-bracket"></i>
</div>

<div class="user-info">
<img src="https://midias.correiobraziliense.com.br/_midias/jpg/2021/07/20/ronaldinho-6767211.jpg">
<div class="nome"><?= explode(" ", $user['nome'])[0]; ?></div>
</div>


<form class="form" id="pessoal">

<div class="title">Informações Pessoais</div>

<span class="label">Nome</span>
<input name="nome" class="form-input" type="text" value="<?= $user['nome']; ?>">

<span class="label">Email</span>
<input name="email" class="form-input" type="text" value="<?= $user['email']; ?>">

<span class="label">CPF</span>
<input name="cpf" class="form-input" type="text" value="<?= $user['cpf']; ?>">


<input class="form-submit" type="submit" value="Editar">
</form>
    
</div>

<div class="boxzinha">


<form class="form right" id="contato">
<div class="title">Informações de contato</div>


<div class="form-group">
    
<div style="width: 85%;margin-right: 5px;">    
<span class="label">Rua</span>
<input class="form-input" name="rua" type="text" value="<?= $user['end_rua']; ?>">
</div>
    
<div style="width: 15%;margin-right: 5px;">    
<span class="label">Nº</span>
<input class="form-input" name="numero" type="text" value="<?= $user['end_numero']; ?>">
</div></div>
    

<div class="form-group">
    
<div style="width: 30%;margin-right: 5px;">    
<span class="label">Estado</span>
<input class="form-input" name="uf" type="text" value="<?= $user['end_estado']; ?>">
</div>

<div style="width: 70%;margin-right: 5px;">    
<span class="label">Cidade</span>
<input class="form-input" name="cidade" type="text" value="<?= $user['end_cidade']; ?>">
</div>
    
</div>

<div class="form-group">
    
<div style="width: 70%;margin-right: 5px;">    
<span class="label">Bairro</span>
<input class="form-input" name="bairro" type="text" value="<?= $user['end_bairro']; ?>">
</div>

<div style="width: 30%;margin-right: 5px;">    
<span class="label">CEP</span>
<input class="form-input" name="cep" type="text" value="<?= $user['end_cep']; ?>">
</div>
    
</div>

<span class="label">Telefone</span>
<input class="form-input" name="telefone" type="text" value="<?= $user['telefone']; ?>">
    

<input class="form-submit" type="submit" value="Editar">


</form><div>


</div>
</div>
    
</div>

<div style="margin-top: 14px;">
<div style="background-color: #f1f1f1;padding: 40px;">
<div style="font-size: 18px;">Compras Realizadas</div>

<?php 
$stmt = $conn->prepare("SELECT * FROM compras WHERE user_id = ?");
$stmt->execute([$user['id']]);
foreach ($stmt->fetchAll() as $compra) {
?>
<div style="display: flex;margin-top: 11px;">
<a href="<?= _CONFIG['SITE_URL']; ?>/compra?id=<?= $compra['id']; ?>">
<div style="margin-right: 10px;"><?= date('d/m/Y - H:i:s', $compra['data']);  ?> // R$<?= number_format($compra['valor'],2,".","."); ?></div>
</a>
</div>
<?php } ?>


</div>   
</div>
    
</div>


</div>



    
</div>
</section>
</main>

<?php } ?>