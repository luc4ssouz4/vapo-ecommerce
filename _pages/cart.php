<?php
if(isset($_POST['id'])):
//echo($cart[0]->id);
$add = true;
foreach($cart as $k => $value){
        
    if($value->id == $_POST['id']){
       
        $value->qnt+= $_POST['quant'];
        // MAX ITEM CART
        if($value->qnt > 10)
        $value->qnt = 10;

        $add = false;
   }
}

if($add)
array_push($cart, ["id"=> $_POST['id'], "qnt"=> $_POST['quant']]);

setcookie('cart', json_encode($cart), time()+999*999, "/");
var_dump($cart);

die("<script>window.location.href = '"._CONFIG['SITE_URL']."/cart';</script>");
endif;
?>
<script>
function updateCart(id, type, price){
$(".cart__totals").css("opacity", "0.3");

var qnt = $("#itemQnt_"+id).val();

if(type == "+")
if(qnt < 10)
qnt = parseInt(qnt) + 1;

if(type == "-")
if(qnt > 1)
qnt = parseInt(qnt) - 1;

$("#itemQnt_"+id).val(qnt);

var subTotal = (qnt * price);
$("#itemPrice_"+id).html(`R$${subTotal.toFixed(2)}`);


$.getJSON({
        url: "/ajax/update_cart",
        method: "POST",
        data: { id:id, type:type, qnt:qnt},
        success: function (data) {
            $("#cart__total").html(`${data.result.countCart}`);
            $(".new__price.update_total").html(`R$${data.result.subTotal.toFixed(2)}`);
            $(".cart__totals").css("opacity", "1");
        }
});    

}

function delItemCart(id){
    $(".cart__totals").css("opacity", "0.3");
    $("#itemCart_"+id).css("opacity", "0.3");

    $.getJSON({
        url: "/ajax/update_cart_remove",
        method: "POST",
        data: { id:id},
        success: function (data) {
            $("#itemCart_"+id).remove();
            $("#cart__total").html(`${data.result.countCart}`);
            $(".new__price.update_total").html(`R$${data.result.subTotal.toFixed(2)}`);
            $(".cart__totals").css("opacity", "1");
        }
});    
    
}

function checkout(){
    $.getJSON({
        url: "/ajax/checkout_cart",
        success: function (data) {
            console.log(data);
        }
});   
}
</script>
<main id="main">
        <section class="section cart__area">
            <div class="container">
                <div class="responsive__cart-area">
                    <form class="cart__form">
                        <div class="cart__table table-responsive">
                            <table width="100%" class="table">
                                <thead>
                                    <tr>
                                        <th>PRODUTO</th>
                                        <th>NOME</th>
                                        <th>PREÇO</th>
                                        <th>QUANTIDADE</th>
                                        <th>SUBTOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $subTotal = 0;                                
                                foreach($cart as $cart){
                                    
                                    $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
                                    $stmt->execute([$cart->id]);
                                    $item = $stmt->fetch();

                                    $subTotal += $item['preco'] * $cart->qnt;
                                    ?>
                                    <tr id="itemCart_<?= $item['id']; ?>">
                                        <td class="product__thumbnail">
                                            <a href="#">
                                                <img src="<?= $item['imagem']; ?>" alt="">
                                            </a>
                                        </td>
                                        <td class="product__name">
                                            <a href="#"><?= $item['titulo']; ?></a>                                            
                                        </td>
                                        <td class="product__price">
                                            <div class="price">
                                                <span class="new__price">R$<?= number_format($item['preco'],2,".","."); ?></span>
                                            </div>
                                        </td>
                                        <td class="product__quantity">
                                            <div class="input-counter">
                                                <div>
                                                    <span class="minus-btn" onclick="updateCart(<?= $item['id']; ?>, '-', <?= $item['preco']; ?>)">
                                                    <i class="fa-solid fa-minus"></i>
                                                    </span>
                                                    <input id="itemQnt_<?= $item['id']; ?>" type="text" value="<?= $cart->qnt ?>" class="counter-btn" readonly>
                                                    <span class="plus-btn" onclick="updateCart(<?= $item['id']; ?>, '+', <?= $item['preco']; ?>)">
                                                    <i class="fa-solid fa-plus"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product__subtotal">
                                            <div class="price">
                                                <span class="new__price" id="itemPrice_<?= $item['id']; ?>">R$<?= number_format($item['preco'] * $cart->qnt,2,".","."); ?></span>
                                            </div>
                                            <a href="#" class="remove__cart-item" onclick="delItemCart(<?= $item['id']; ?>)">
                                            <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="cart__totals">
                            <h3>Cart Totals</h3>
                            <ul>
                                <li>
                                    Subtotal
                                    <span class="new__price update_total">R$<?= number_format($subTotal,2,",","."); ?></span>
                                </li>
                                <li>
                                    Desconto
                                    <span>$0</span>
                                </li>
                                <li>
                                    Total
                                    <span class="new__price update_total">R$<?= number_format($subTotal,2,",","."); ?></span>
                                </li>
                            </ul>
                            <a href="#" onclick="checkout();">FINALIZAR COMPRA</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>