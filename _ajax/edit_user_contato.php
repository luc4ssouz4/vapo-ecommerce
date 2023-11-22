<?php
if(!LOGADO)
die();

if(empty($_POST['cep']) || empty($_POST['rua']))
error("Digite seu endereço corretamente!");

if(empty($_POST['numero']))
error("Digite o numero da sua casa!");

$stmt = $conn->prepare("UPDATE users SET end_rua = ?,  end_numero = ?,  end_estado = ?,  end_cidade = ?,  end_bairro = ?, end_cep = ?, telefone = ? WHERE id = ?");
$stmt->execute([$_POST['rua'], $_POST['numero'], $_POST['uf'], $_POST['cidade'], $_POST['bairro'], $_POST['cep'], $_POST['telefone'], $user['id']]);

$data = json_encode([
    "result" => ["error" => false, "message" => "Informações de contato editadas com sucesso"]
]);die($data);
?>