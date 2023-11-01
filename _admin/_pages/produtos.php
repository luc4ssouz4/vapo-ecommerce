<?php
if(isset($_GET['del'])){
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->execute([$_GET['del']]);
}

if(!isset($_GET['edit'])){
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Produtos</h1>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Todos os produtos
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titulo</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $stmt = $conn->prepare("SELECT * FROM produtos");
                        $stmt->execute();
                        foreach ($stmt->fetchAll() as $compra) {
                        ?>
                            <tr>
                                <td><?= $compra['id']; ?></td>
                                <td><?= $compra['titulo']; ?></td>
                                <td><?= $compra['descricao']; ?></td>
                                <td><?= $compra['preco']; ?></td>
                                <td><div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                      <a href="?edit=<?= $compra['id']; ?>"><button type="button" class="btn btn-primary">Editar</button></a>
                                      <a href="?del=<?= $compra['id']; ?>"><button type="button" class="btn btn-danger">Deletar</button></a>
                                      
</div></td>
                            </tr>
                        <?php } ?>                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php }else{ ?>

<?php
$MESSAGE = "";

if(isset($_POST['edit'])){

    $PROMO = 0;
    if(isset($_POST['check']))
    $PROMO = 1;
    
    $stmt = $conn->prepare("UPDATE produtos SET titulo = ?, imagem = ?, descricao = ?, preco = ?, promocao= ? WHERE id = ?");
    $stmt->execute([$_POST['titulo'], $_POST['imagem'], $_POST['desc'], $_POST['valor'], $PROMO, $_POST['edit']]);
    
    $MESSAGE = '<div class="alert alert-success" role="alert">Produto editado com sucesso!</div>';
    
}


$stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$_GET['edit']]);
$produto = $stmt->fetch();
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Produtos</h1>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Todos os produtos
            </div>
            <div class="card-body">
                <?= $MESSAGE; ?>
                
                <form class="row g-3 needs-validation" method="POST">
                    <div class="col-md-3">
                        <label for="validationCustom01" class="form-label">Titulo</label>
                        <input type="text" name="titulo" class="form-control" value="<?= $produto['titulo']; ?>">
                       
                    </div>
                    <div class="col-md-2">
                        <label for="validationCustom03" class="form-label">Valor</label>
                        <input type="number" name="valor" class="form-control" value="<?= $produto['preco']; ?>">
                    </div>
                    
                    <div class="col-md-7">
                        <label for="validationCustom01" class="form-label">Imagem (URL)</label>
                        <input type="text" name="imagem" class="form-control" value="<?= $produto['imagem']; ?>">                       
                    </div>     
                    <div class="col-md-12 mb-4">
                        <label for="validationCustom01" class="form-label">Descrição</label>
                        <textarea name="desc" class="form-control" rows="3" ><?= $produto['descricao']; ?></textarea>             
                    </div>     
                    


                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="check" <?= ($produto['promocao']) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="invalidCheck">
                                Promoção
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" name="edit" value="<?= $produto['id']; ?>" type="submit">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php } ?>