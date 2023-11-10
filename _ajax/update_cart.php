<?php
$cartCount = 0;
$subTotal = 0;   
foreach($cart as $k => $value){
    
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->execute([$cart[$k]->id]);
    $item = $stmt->fetch();
    
    if($cart[$k]->id == $_POST['id']){       
        $cart[$k]->qnt = $_POST['qnt'];
        // MAX ITEM CART
        if($cart[$k]->qnt > 10)
        $cart[$k]->qnt = 10;
   }

   $subTotal += $item['preco'] * $cart[$k]->qnt;
   $cartCount += $cart[$k]->qnt;   

}

//echo $subTotal;
setcookie('cart', json_encode($cart), time()+999*999, "/");

$data = json_encode([
    "result" => ["countCart" => $cartCount, "subTotal" => $subTotal]
]);die($data);
?>