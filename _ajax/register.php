<?php
if(
!isset($_POST['username'])||
!isset($_POST['email'])||
!isset($_POST['pass'])||
!isset($_POST['pass2'])||
!isset($_POST['cepzin'])||
!isset($_POST['rua'])||
!isset($_POST['numero'])||
!isset($_POST['uf'])||
!isset($_POST['cidade'])||
!isset($_POST['bairro']) || LOGADO
)die();

if(empty($_POST['username']))
error("Digite seu nome completo corretamente!");

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
error("Digite um email valido!");

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$_POST['email']]);
if($stmt->fetch())
error("Email digitado já está em uso!");

if(strlen($_POST['pass']) < 6)
error("Sua senha deve ter pelomenos 6 caracteres!");

if($_POST['pass'] != $_POST['pass2'])
error("Repita a senha corretamente!");

if(empty($_POST['cepzin']))
error("Digite seu cep corretamente!");

if(empty($_POST['numero']))
error("Digite o numero da sua casa!");

// CRIANDO HASH UNICA PRA AUTENTICAÇÃO
$hash = md5($_POST['email'] . (time() * 2 + rand(0,90)) . $_POST['cepzin']);
// ENCRIPTANDO SENHA
$senha = password_hash($_POST['pass'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (`nome`, `email`, `senha`, `end_rua`, `end_numero`, `end_estado`, `end_cidade`, `end_bairro`, `end_cep`, `hash`) VALUES (?,?,?,?,?,?,?,?,?,?)");
$stmt->execute([$_POST['username'], $_POST['email'], $senha, $_POST['rua'], $_POST['numero'], $_POST['uf'], $_POST['cidade'], $_POST['bairro'], $_POST['cepzin'], $hash]);


setcookie("hash", $hash, time()+30*24*60*60, "/");

$data = json_encode([
    "result" => ["error" => false, "urlRedirect" => _CONFIG['SITE_URL']."/profile"]
]);die($data);
?>