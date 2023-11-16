<?php
$MESSAGE = "";

if(isset($_POST['add'])){
$PROMO = 0;

if(isset($_POST['check']))
$PROMO = 1;

$stmt = $conn->prepare("INSERT INTO `produtos` (`titulo`, `imagem`, `descricao`, `preco`, `promocao`) VALUES (?,?,?,?,?)");
$stmt->execute([$_POST['titulo'], $_POST['imagem'], $_POST['desc'], $_POST['valor'], $PROMO]);

$MESSAGE = '<div class="alert alert-success" role="alert">Produto adicionado com sucesso!</div>';

}

?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Produtos</h1>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Cadastrar produto
            </div>
            <div class="card-body">
                <?= $MESSAGE; ?>
                
                <form class="row g-3 needs-validation" method="POST">
                    <div class="col-md-3">
                        <label for="validationCustom01" class="form-label">Titulo</label>
                        <input type="text" name="titulo" class="form-control">
                       
                    </div>
                    <div class="col-md-2">
                        <label for="validationCustom03" class="form-label">Valor</label>
                        <input type="text" name="valor" class="form-control">
                    </div>
                    
                    <div class="col-md-7">
                        <label for="validationCustom01" class="form-label">Imagem (URL)</label>
                        <input type="text" name="imagem" class="form-control">                       
                    </div>     
                    <div class="col-md-12 mb-4">
                        <label for="validationCustom01" class="form-label">Descrição</label>
                        <textarea name="desc" class="form-control" rows="3"></textarea>             
                    </div> 
                    
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="check">
                            <label class="form-check-label" for="invalidCheck">
                                Promoção
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" name="add" type="submit">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>