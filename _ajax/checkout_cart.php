<?php
if(!LOGADO)
die();

$idMP = 0;

$stmt = $conn->prepare("INSERT INTO compras (`user_id`, `mp_id`, `items_id`, `valor`, `data`) VALUES (?,?,?,?,?)");
$stmt->execute([$user['id'], $idMP, json_encode($cart), 10, time()]);
echo $id = $conn->lastInsertId();

$cart = [];
setcookie('cart', json_encode($cart), time()-999*999, "/");
?>