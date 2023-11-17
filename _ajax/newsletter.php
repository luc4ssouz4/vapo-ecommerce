<?php
if(!isset($_POST['email']))
die();
function error($messsage){
    
    $data = json_encode([
        "result" => ["error" => true, "message" => $messsage]
    ]);die($data);

}


if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
error("Digite um email valido!");

$stmt = $conn->prepare("SELECT email FROM emails WHERE email = ?");
$stmt->execute([$_POST['email']]);
if(!empty($stmt->fetch()))
error("Email já está cadastrado nas promoções!");

$stmt = $conn->prepare("INSERT INTO emails (`email`, `data`) VALUES (?,?)");
$stmt->execute([$_POST['email'], time()]);


$data = json_encode([
    "result" => ["error" => false, "message" => "Agora você receberá avisos de promoções"]
]);die($data);
?>