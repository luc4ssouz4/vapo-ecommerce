<?php
if(!LOGADO)
die();

if($cartCount == 0)
die();

$idMP = 0;
$subTotal = 0;

foreach($cart as $k => $value){
    
    $item['preco'] = 0;
    $stmt = $conn->prepare("SELECT preco FROM produtos WHERE id = ?");
    $stmt->execute([$value->id]);
    $item = $stmt->fetch();    

    $subTotal += $item['preco'] * $value->qnt;

}


$data = [
    "additional_info" => [
      "payer"=> [
        "first_name"=> explode(" ", $user["nome"])[0],
        "last_name"=> "",
        "phone"=> [
          "area_code"=> 11,
          "number"=> "987654321"
        ],
        "address"=> []
    ],
      "shipments"=> [
        "receiver_address"=> [
          "zip_code"=> $user["end_cep"],
          "state_name"=> $user["end_estado"],
          "city_name"=> $user["end_cidade"],
          "street_name"=> $user["end_rua"],
          "street_number"=> 3003
        ]
      ]
    ],
    "description"=> "Payment for product",
    "external_reference"=> "MP0001",
    "installments"=> 1,
    "metadata"=> [],
    "payer"=> [
      "entity_type"=> "individual",
      "type"=> "customer",
      "email"=> $user["email"],
      "identification"=> [
        "type"=> "CPF",
        "number"=> "95749019047"
      ]
    ],
    "payment_method_id" => "pix",
    "token"=> "ff8080814c11e237014c1ff593b57b4d",
    "transaction_amount"=> number_format($subTotal, 2, '.', '') - 0 // FORMAT FLOAT
];

var_dump($data);

/*
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.mercadopago.com/v1/payments");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
//curl_setopt($ch, CURLOPT_POSTFIELDS, "postvar1=value1&postvar2=value2&postvar3=value3");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer APP_USR-5356116581896095-101913-c11b4a6bcd3374674975a2015d3f4836-165560986'
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

echo $server_output = curl_exec($ch);
curl_close($ch);


//GET ID MP
$server_output = json_decode($server_output);
$idMP = $server_output->id;
*/


$stmt = $conn->prepare("INSERT INTO compras (`user_id`, `mp_id`, `items_id`, `valor`, `data`) VALUES (?,?,?,?,?)");
$stmt->execute([$user['id'], $idMP, json_encode($cart), $subTotal, time()]);
$id = $conn->lastInsertId();

$cart = [];
//setcookie('cart', json_encode($cart), time()-999*999, "/");
?>