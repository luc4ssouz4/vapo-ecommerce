<script>

var obj = [];
var total = 0;


function addCart(id, price, titulo){
    var add = true;
    total = 0;

    for( key in obj ) {
        
    if(obj[key]["id"] === id)
    obj[key]["quant"] += 1,add=false;

    total += (obj[key]["valor"] * obj[key]["quant"]);
    //console.log( "key is " + [ key ] + ", value is " + obj[ key ]["id"] );
    }

    if(add)
    obj.push({ id: id, valor: price, quant:1, titulo: titulo }),total+=price;


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

foreach($stmt->fetchAll() as $produto){
?>

<div data-id="<?= $produto['id']; ?>" onclick="addCart(<?= $produto['id']; ?>, <?= $produto['preco']; ?>, '<?= $produto['titulo']; ?>')">
<?= $produto['titulo']; ?> R$<?= $produto['preco']; ?>
</div>

<br>
<?php } ?>
