<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Ausleihe Verwaltung</title>
    <base href="<?= ROOT_URL ?>/">
    <link rel="stylesheet" href="public/css/app.css">
</head>

<body>
    <div class="container_contend">
        <table>
            <thead>
                <tr>
                    <th>Film</th>
                    <th>Gesamtausleihelänge</th>
                    <th>Name</th>
                    <th>email</th>
                    <th>Status</th>
            </thead>
            <tbody>
            <div>
                <?php foreach ($borrows as $data) { ?>
                   

                        <tr>
                            <td><?php echo $data['title'] ?? ''; ?></td>
                            <td><?php echo $data['gesamtausleihetage'] ?? ''; ?></td>
                            <td><?php echo $data['name'] ?? ''; ?></td>
                            <td><?php echo $data['email'] ?? ''; ?></td>
                            <td><?php echo $data['ausleihstatus'] ?? ''; ?></td>

                        </tr>
                <?php } ?>
                </div>
            </tbody>
        </table>
    </div>
</body>

</html>