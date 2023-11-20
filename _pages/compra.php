<?php
 $stmt = $conn->prepare("SELECT * FROM compras WHERE id = ?");
 $stmt->execute([$_GET['id']]); 
 if(!empty($compra = $stmt->fetch()) &&  $compra['user_id'] == $user['id']){
?>
<main id="main">
        <section class="section cart__area">
            <div class="container">
                <div class="responsive__cart-area">
                <div class="cart__totals" style="width: 100%;">
                <div style="display: flex;justify-content: space-between;align-items: baseline;margin-bottom: 10px;"><h3>Detalhes da compra</h3>
                <?php 
                if($compra['status']){
                ?>
                <div style="padding: 10px;background-color: #198754;border-radius: 5px;color:#fff">Pagamento Recebido</div></div>
                <?php }else{ ?>
                <div style="padding: 10px;background-color: #ffe225;border-radius: 5px;">Pagamento Pendente</div></div>
                <?php } ?>

                            <ul>     
                            <li>Status   
                            <span><?= ($compra['status']) ? "Aguardando Envio" : "Aguardando Pagamento" ?></span>                            
                            </li>                           
                            <li>Total <span>R$ <?= number_format($compra['valor'],2,".","."); ?></span></li>
                            </ul>
                            <?= (!$compra['status']) ? "<a href='/checkout?id={$compra['id']}'>REALIZAR PAGAMENTO</a>" : '' ?>

                            <form class="cart__form" style="margin-top: 50px;">
                        <div class="cart__table table-responsive">
                            <table width="100%" class="table">
                                <thead>
                                    <tr>
                                        <th>PRODUTO</th>
                                        <th>NOME</th>
                                        <th>QUANTIDADE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $cart = json_decode($compra['items_id']);
                                $subTotal = 0;                                
                                foreach($cart as $cart){
                                    
                                    $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
                                    $stmt->execute([$cart->id]);
                                    $item = $stmt->fetch();

                                    $subTotal += $item['preco'] * $cart->qnt;
                                    ?>
                                    <tr id="itemCart_<?= $item['id']; ?>">
                                        <td class="product__thumbnail">
                                            <img src="<?= $item['imagem']; ?>" alt="">
                                            
                                        </td>
                                        <td class="product__name">
                                            <?= $item['titulo']; ?>                                           
                                        </td>
                                        <td class="product__quantity">
                                            <div class="input-counter">
                                                <div>
                                                   <?= $cart->qnt ?>                                              
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                    
                                </tbody>
                            </table>
                        </div>

                        
                    </form>

                        </div>
                   
                </div>
            </div>
        </section>
    </main>
    <?php } ?>