<?php
 $stmt = $conn->prepare("SELECT * FROM compras WHERE id = ?");
 $stmt->execute([$_GET['id']]); 
 $compra = $stmt->fetch();
 
 if(!empty($compra) && $compra['user_id'] == $user['id'] && !$compra['status']){
 
 $tempo = 86400 - (time() - $compra['data']);
 $vencido = false;

 if($tempo < 1){
 header('Location: /compra?id='.$compra['id']);
 die();
 }

?>
<script>
   var mp_id = <?= $compra['mp_id']; ?>;
   var verifyPaymentTime = setInterval(verifyPayment, 2000);
   var options = {
	text: "<?= $compra['qr_code']; ?>",
    width: 256,
    height: 256,
    colorLight : "#f1f1f1",
    logo: "https://devtools.com.br/img/pix/logo-pix-png-icone-520x520.png", 
    logoWidth: 80, // fixed logo width. default is `width/3.5`
    logoHeight: 80, // fixed logo height. default is `heigth/3.5`
    logoMaxWidth: undefined, // Maximum logo width. if set will ignore `logoWidth` value
    logoMaxHeight: undefined, // Maximum logo height. if set will ignore `logoHeight` value
    logoBackgroundColor: '#f1f1f1', // Logo backgroud color, Invalid when `logBgTransparent` is true; default is '#ffffff'
    logoBackgroundTransparent: true,
	};

    $(function() {
    new QRCode(document.getElementById("qrcode"), options);
    });  

    var time = <?= $tempo; ?>;     
    setInterval(function () {    
    time--;   
    var hours = time / 60 / 60 % 24;
    var minutes = time / 60 % 60;
    var seconds = time % 60;
    
    if(hours < 10)
    $("#horas").text("0" + Math.floor(hours));
    else
    $("#horas").text(Math.floor(hours));     

    if(minutes < 10)
    $("#minutos").text("0" + Math.floor(minutes));
    else
    $("#minutos").text(Math.floor(minutes));     
    
    if(seconds < 10)
    $("#segundos").text("0" + Math.floor(seconds));
    else
    $("#segundos").text(Math.floor(seconds)); 
    }, 1000);

    function copyPix(){
        $("#input_pix").select();
        document.execCommand('copy');
        SnackBar({
                message: "Pix copiado com sucesso.",
                status: "warning",
                fixed: true,
                position: "tr",
                icon: "!"
            });
    }

    function paymentSucces(){
        clearInterval(verifyPaymentTime);
        $("#pix").hide();
        $("#payment_ok").show();
        SnackBar({
                message: "Pagamento recebido!",
                status: "success",
                fixed: true,
                position: "tr",
                icon: "!"
        });  
    }

    function verifyPayment(){
        $.getJSON({
        url: "/ajax/verify_payment",
        method: "POST",
        data: {id: mp_id},
        success: function (data) {
            $("#contato .form-submit").removeAttr("disabled").val("Editar");
            if(data.result.payment)
            paymentSucces();
        }
    });
    }
</script>
<style>
.checkout{
    background-color: var(--primaryColor);
    text-align: center;
    padding: 30px 40px;
}
.checkout .vencimento{
    font-size: 15px;
    font-weight: 600;
    color: #272727;
}
.checkout .timer{
    font-size: 35px;
    font-weight: 600;
    color: brown;
    margin-bottom: 25px;
}
.checkout .titulo{
    font-size: 18px;
    font-weight: 600;
}
.checkout .descricao{
    font-size: 14px;
    margin: 7px 0px 20px;
}
.checkout .copiar{
    margin-top: 40px;
    padding: 0px 40px;
}
.checkout .copiar input{
    width: 100%;
    font-size: 1.4rem;
    padding: 1.6rem;
    background-color: rgb(0 0 0 / 8%);
    border: none;
    text-indent: 1rem;
    margin-bottom: 7px;
}
.checkout .copiar .button, #payment_ok .button{
    width: 200px;
    float: inline-end;
    font-size: 1.4rem;
    padding: 1.6rem;
    border: none;
    text-indent: 1rem;
    margin-bottom: 7px;
    background-color: #000000d6;
    color: #fff;
}
.checkout .resumo{
    margin-top: 60px;
    padding: 0px 40px;
}
.checkout .resumo .titulo{
    text-align: left;
    font-size: 19px;
    font-weight: 600;
    margin-bottom: 16px;
}
.checkout .resumo .infos{
    display: flex;
    justify-content: space-between;
}

.checkout .resumo .infos .grid{
    text-align: justify;
    font-size: 14px;
    display: grid;
}
.checkout .resumo .infos .grid .titulo-grid{
    text-align: left;
    font-size: 17px;
    font-weight: 600;
}
</style>
<main id="main">
<section class="section">
<div class="container">

<div class="checkout">

<div id="pix">
<div class="vencimento">Vencimento em:</div>
<div class="timer"><span id="horas"></span>:<span id="minutos"></span>:<span id="segundos"></span></div>

<div class="titulo">Pagamento PIX</div>
<div class="descricao">Leia o Qr-Code abaixo para realizar o pagamento</div>

<div id="qrcode"></div>

<div class="copiar">
<input id="input_pix" readonly type="text" value="<?= $compra['qr_code']; ?>">
<div class="button" onclick="copyPix()">Copiar</div>
</div>

</div>

<div id="payment_ok" style="display:none;">
<div class="titulo">Pagamento realizado com sucesso</div>
<div class="descricao">Seu pagamento foi recebido e nossa equipe estará cuidando do seu pedido.</div>
<img src="https://www.freeiconspng.com/uploads/checkmark-png-5.png" style="width: 150px;">    
<div style="margin-top: 80px;display: flex;justify-content: center;">
<a href="<?= _CONFIG['SITE_URL']; ?>/compra?id=<?= $compra['id']; ?>"><div class="button">Continuar</div></a>
</div>
</div>

<div class="resumo">
<div class="titulo">Resumo da compra</div>
<div class="infos">
<div class="grid">
<div class="titulo-grid">Produtos</div>
<?php
foreach($cart as $k => $value){
$stmt = $conn->prepare("SELECT preco, titulo FROM produtos WHERE id = ?");
$stmt->execute([$value->id]);
$item = $stmt->fetch();   
?>
<span><?= $value->qnt; ?>x <?= $item['titulo']; ?></span>
<?php } ?>
</div>

<div class="grid">
<div class="titulo-grid">Subtotal</div>
<span>R$ <?= number_format($compra['valor'],2,".","."); ?></span>

</div>
</div>
</div>    
</div>
<div>
</div></div>
</section>
</main>
<?php } ?>