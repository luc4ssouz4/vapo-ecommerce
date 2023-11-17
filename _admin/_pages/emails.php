<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Emails promoções</h1>

        <div class="card mb-4">            
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM emails");
                        $stmt->execute();
                        foreach ($stmt->fetchAll() as $email) {
                        ?>
                            <tr>
                                <td><?= $email['id']; ?></td>
                                <td><?= $email['email']; ?></td>
                                <td><?= $email['data']; ?></td>
                            </tr>
                        <?php } ?>                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>