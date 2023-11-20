<?php
if(!isset($_POST["id"]) || !LOGADO)
die();
$payment = false;

$id = $_POST['id'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.mercadopago.com/v1/payments/{$id}");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer APP_USR-5356116581896095-101913-c11b4a6bcd3374674975a2015d3f4836-165560986'
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close($ch);

$json = json_decode($server_output, true);

if($json['status'] == "approved"){
$payment = true;

$stmt = $conn->prepare("UPDATE compras SET status = 1 WHERE mp_id = ?");
$stmt->execute([$id]);
}

$data = json_encode([
    "result" => ["payment" => $payment]
]);die($data);
?>