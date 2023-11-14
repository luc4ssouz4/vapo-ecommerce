<?php
$cartCount = 0;
$subTotal = 0;   
foreach($cart as $k => $value){
    
    $item['preco'] = 0;
    $stmt = $conn->prepare("SELECT preco FROM produtos WHERE id = ?");
    $stmt->execute([$value->id]);
    $item = $stmt->fetch();    

    if($value->id == $_POST['id']){
    if($k == 0)
    array_shift($cart); else array_splice($cart, $k, $k);
    }else{
    $subTotal += $item['preco'] * $value->qnt;
    $cartCount += $value->qnt;    
    }   

}

//echo $subTotal;
setcookie('cart', json_encode($cart), time()+999*999, "/");
$data = json_encode([
    "result" => ["countCart" => $cartCount, "subTotal" => $subTotal]
]);die($data);
?>