<?php
if(LOGADO)
die();

$data = [
    "result" => ["error" => false]
];

echo json_encode($data);
?>