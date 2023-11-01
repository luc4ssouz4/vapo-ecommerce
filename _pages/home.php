<main id="main">
    <div class="container">

        <section class="category__section section" id="category">
            <div class="category__container aos-init aos-animate" data-aos="fade-up" data-aos-duration="1200">
                <div class="category__center">

                    <?php
                    $stmt = $conn->prepare("SELECT * FROM produtos");
                    $stmt->execute();

                    foreach ($stmt->fetchAll() as $produto) { 
                    ?>
                    <div class="product category__products">
                        <div class="product__header">
                            <img src="<?= $produto['imagem']; ?>"
                                alt="product">
                        </div>
                        <div class="product__footer">
                            <h3><?= $produto['titulo']; ?></h3>
                            <div class="rating">
                                <svg>
                                    <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="./images/sprite.svg#icon-star-full"></use>
                                </svg>
                                <svg>
                                    <use xlink:href="./images/sprite.svg#icon-star-empty"></use>
                                </svg>
                            </div>
                            <div class="product__price">
                                <h4>$<?= $produto['preco']; ?></h4>
                            </div>
                            <a href="#"><button type="submit" class="product__btn">Comprar</button></a>
                        </div>
                    </div>
                    <?php } ?>

                    


                </div>
            </div>
        </section>


    </div>

    <section class="section newsletter" id="contact">
        <div class="container">
            <div class="newsletter__content">
                <div class="newsletter__data">
                    <h3>RECEBA PROMOÇÕES</h3>
                    <p>A short sentence describing what someone will receive by subscribing</p>
                </div>
                <form action="#">
                    <input type="email" placeholder="Enter your email address" class="newsletter__email">
                    <a class="newsletter__link" href="#">subscribe</a>
                </form>
            </div>
        </div>
    </section>

</main>

<script>

    var obj = [];
    var total = 0;


    function addCart(id, price, titulo) {
        var add = true;
        total = 0;

        for (key in obj) {

            if (obj[key]["id"] === id)
                obj[key]["quant"] += 1, add = false;

            total += (obj[key]["valor"] * obj[key]["quant"]);
            //console.log( "key is " + [ key ] + ", value is " + obj[ key ]["id"] );
        }

        if (add)
            obj.push({ id: id, valor: price, quant: 1, titulo: titulo }), total += price;


        console.log(obj);
        console.log("Total valor:" + total);




    }



    /*
    const myJSON = '[{"id": 1, "quant":1},{"id": 2, "quant":2}]';
    var json = JSON.parse(myJSON);*/

    //const myJSON = '[{"id": 1, "quant":1},{"id": 2, "age":30, "cars":["Ford", "BMW", "Fiat"]}]';

</script>



<?php
$stmt = $conn->prepare("SELECT * FROM produtos");
$stmt->execute();

foreach ($stmt->fetchAll() as $produto) {
    ?>

    <div data-id="<?= $produto['id']; ?>"
        onclick="addCart(<?= $produto['id']; ?>, <?= $produto['preco']; ?>, '<?= $produto['titulo']; ?>')">
        <?= $produto['titulo']; ?> R$
        <?= $produto['preco']; ?>
    </div>

    <br>
<?php } ?>