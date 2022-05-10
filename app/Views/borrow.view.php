<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Ausleihe Verwaltung</title>
    <!-- Set base for relative urls to the directory of index.php: -->
    <base href="<?= ROOT_URL ?>/">
    <link rel="stylesheet" href="public/css/app.css">
</head>

<body>
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
        <?php foreach ($borrows as $data) { ?>
            <tr>
                <td><?php echo $data['fk_video'] ?? ''; ?></td>
                <td><?php echo $data['gesamtausleihetage'] ?? ''; ?></td>
                <td><?php echo $data['name'] ?? ''; ?></td>
                <td><?php echo $data['email'] ?? ''; ?></td>
                <td><?php echo $data['ausleihstatus'] ?? ''; ?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>