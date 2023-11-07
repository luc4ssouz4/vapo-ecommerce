<?php
if(!isset($_POST['email']) || !isset($_POST['pass']))
die();
function error($messsage){
    
    $data = json_encode([
        "result" => ["error" => true, "message" => $messsage]
    ]);die($data);

}

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$_POST['email']]);
$user = $stmt->fetch();

if(empty($user))
error("Email digitado não foi encontrado!");

if (!password_verify($_POST['pass'], $user['senha']))
error("Senha digitada está incorreta!");

setcookie("hash", $user['hash'], time()+30*24*60*60, "/");

$data = json_encode([
    "result" => ["error" => false]
]);die($data);
?>