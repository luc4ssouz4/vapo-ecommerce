<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Ultimas vendas
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data</th>
                            <th>Update</th>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM compras");
                        $stmt->execute();
                        foreach ($stmt->fetchAll() as $compra) {

                        $stmt = $conn->prepare("SELECT nome FROM users WHERE id = ?");
                        $stmt->execute([$compra['user_id']]);
                        $user = $stmt->fetch();
                        ?>

                            <tr>
                                <td><?= $compra['id']; ?></td>
                                <td><?= $today = date('d/m/Y - H:i:s', $compra['data']);  ?></td>
                                <td><?= $compra['data_update']; ?></td>
                                <td><?= $user['nome']; ?></td>
                                <td>R$<?= number_format($compra['valor'],2,".","."); ?></td>
                                <?php 
                                if($compra['status']){
                                ?>
                                <td><button type="button" class="btn btn-success">Pago</button></td>
                                <?php }else{ ?>
                                <td><button type="button" class="btn btn-warning">Pendente</button></td> 
                                <?php } ?>

                                
                            </tr>

                        <?php } ?>                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>