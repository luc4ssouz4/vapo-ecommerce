<?php
$stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$_GET['id']]);

if($item = $stmt->fetch()){
?>
<script>
var price = "<?= $item['preco']; ?>";

function addQnt(){
  var qnt = parseInt($(".counter-btn").val()) + parseInt(1);
  if(qnt != 11)
  $(".counter-btn").val(qnt),
  attVal();

}
function rmQnt(){
  var qnt = parseInt($(".counter-btn").val()) - parseInt(1);
  if(qnt != 0)
  $(".counter-btn").val(qnt),
  attVal();
  
}

function attVal(){
  var subTotal = parseInt($(".counter-btn").val()) * price;
  $(".new__price.subTotal").text(`R$${subTotal.toFixed(2)}`);
}


</script>


<main id="main">
    <div class="container">
      <section class="section product-details__section">
        <div class="product-detail__container">
          <div class="product-detail__left">
            <div class="details__container--left">
              <div class="product__picture" id="product__picture">
                <div class="picture__container">
                  <img src="<?= $item['imagem']; ?>" id="pic" style="height: 300px;" />
                </div>
              </div>
            </div>
          </div>

          <div class="product-detail__right">
            <div class="product-detail__content">
              <h3><?= $item['titulo']; ?></h3>
              <div class="price">
                <span class="new__price">R$<?= number_format($item['preco'],2,",","."); ?></span>
              </div>
              <p>
              <?= $item['descricao']; ?>
              </p>
              <div class="product__info-container">
                <ul class="product__info">
                  
                  <li>
                    <div class="input-counter">
                      <span>Quantidade:</span>
                      <div style="margin-left: 10px;">
                        <span class="minus-btn" onclick="rmQnt()">
                        <i class="fa-solid fa-minus"></i>
                        </span>
                        <form method="POST" action="<?= _CONFIG['SITE_URL']?>/cart">
                        <input type="text" name="quant" min="1" value="1" max="10" class="counter-btn" readonly>
                        <input type="hidden" name="id" value="<?= $item['id']; ?>">
                        <span class="plus-btn" onclick="addQnt()">
                        <i class="fa-solid fa-plus"></i>
                        </span>
                      </div>
                    </div>
                  </li>

                  <li>
                    <span>Subtotal:</span>
                    <a href="#" class="new__price subTotal">R$<?= number_format($item['preco'],2,",","."); ?></a>
                  </li>                    

            <div class="product-details__btn">
              <a class="add" href="#" onclick='$("form").submit();'>
                <span><i class="fa-solid fa-cart-plus"></i></span>
                ADD AO CARRINHO
              </a></form>
              </div>                
                </ul>
              </div>
            </div>
          </div>
        </div>

      </section>

      <section class="section related__products">
        <div class="title__container">
          <div class="section__title filter-btn active">
            <span class="dot"></span>
            <h1 class="primary__title">Produtos Similares</h1>
          </div>
        </div>
        <div class="container">
        <section class="category__section section" id="category">
            <div class="category__container aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200">
                <div class="category__center">
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM produtos");
                    $stmt->execute();
                    foreach ($stmt->fetchAll() as $produto) { 
                    ?>
                   <a href="<?= _CONFIG['SITE_URL']; ?>/product?id=<?= $produto['id']; ?>"> <div class="product category__products">
                        <div class="product__header">
                            <img src="<?= $produto['imagem']; ?>">
                        </div>
                        <div class="product__footer">
                            <h3><?= $produto['titulo']; ?></h3>
                            <div class="product__price"><h4>R$<?= number_format($item['preco'],2,",","."); ?></h4></div>
                        </div>
                    </div></a>
                    <?php } ?>
                </div>
            </div>
        </section>


    </div>
    </section>     
    </div>

    <section class="facility__section section" id="facility">
      <div class="container">
        <div class="facility__contianer">
          <div class="facility__box">
            <div class="facility-img__container">
            <i class="fa-solid fa-truck-fast"></i>
            </div>
            <p>FRETE GRATIS</p>
          </div>

          <div class="facility__box">
            <div class="facility-img__container">
            <i class="fa-solid fa-sack-dollar"></i>
            </div>
            <p>REEMBOLSO GARANTIDO</p>
          </div>

          <div class="facility__box">
            <div class="facility-img__container">
            <i class="fa-brands fa-pix"></i>
            </div>
            <p>PAGAMENTO COM PIX</p>
          </div>

          <div class="facility__box">
            <div class="facility-img__container">
            <i class="fa-solid fa-phone-volume"></i>
            </div>
            <p>24/7 SUPORTE ONLINE</p>
          </div>
        </div>
      </div>
    </section>
  </main>
<?php } ?>