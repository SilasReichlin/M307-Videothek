<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Ausleihe Verwaltung</title>
    <base href="<?= ROOT_URL ?>/">
    <link rel="stylesheet" href="public/css/app.css">
</head>

<body>
<?php
        include 'app/Views/nav.view.php';
        ?>
    <div class="container_contend">
        <table>
            <thead>
                <tr>
                    <th>Film</th>
                    <th>Gesamtausleihelänge</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>Status</th>
                    <th>Bearbeiten</th>
            </thead>
            <tbody>
                <div>
                    <?php foreach ($borrows as $data) { ?>
                        <?php
                        $status = ($data['returnDate'] >= date("Y-m-d") ? '😁' : '😠');
                        ?>
                        <tr>
                            <td><?php echo $data['title'] ?? ''; ?></td>
                            <td><?php echo $data['gesamtausleihtage'] ?? ''; ?></td>
                            <td><?php echo $data['name'] ?? ''; ?></td>
                            <td><?php echo $data['email'] ?? ''; ?></td>
                            <td><?php echo $status ?></td>
                            <td>
                                <a href="./edit?id=<?= $data['ausleihid'] ?? ''; ?>">
                                    <button type="button" class="b-button">Bearbeiten</button>
                            </td>
                        </tr>
                    <?php } ?>
                </div>
            </tbody>
        </table>
    </div>
</body>

</html>