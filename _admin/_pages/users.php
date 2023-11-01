<?php
if(isset($_GET['del'])){
    $stmt = $conn->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->execute([$_GET['del']]);
}

?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Usuarios</h1>

        <div class="card mb-4">            
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>CPF</th>
                            <th>CEP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM users");
                        $stmt->execute();
                        foreach ($stmt->fetchAll() as $compra) {
                        ?>
                            <tr>
                                <td><?= $compra['id']; ?></td>
                                <td><?= $compra['nome']; ?></td>
                                <td><?= $compra['email']; ?></td>
                                <td><?= $compra['cpf']; ?></td>
                                <td><?= $compra['end_cep']; ?></td>
                            </tr>
                        <?php } ?>                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>