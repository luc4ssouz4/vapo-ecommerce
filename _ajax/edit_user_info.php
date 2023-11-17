<?php
if(!isset($_POST['nome']) || !isset($_POST['email']) ||  !isset($_POST['cpf']) || !LOGADO)
die();
function error($messsage){    
    $data = json_encode([
        "result" => ["error" => true, "message" => $messsage]
    ]);die($data);
}

if(empty($_POST['nome']))
error("Digite seu nome completo corretamente!");

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
error("Digite um email valido!");

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$_POST['email']]);
if($stmt->fetch() && $_POST['email'] != $user['email'])
error("Email digitado já está em uso!");

$stmt = $conn->prepare("UPDATE users SET nome = ?, email = ?, cpf = ? WHERE id = ?");
$stmt->execute([$_POST['nome'], $_POST['email'], $_POST['cpf'], $user['id']]);

$data = json_encode([
    "result" => ["error" => false, "message" => "Informações editadas com sucesso"]
]);die($data);
?>