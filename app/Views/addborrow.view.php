<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Ausleihe Verwaltung</title>
    <base href="<?= ROOT_URL ?>/">
    <link rel="stylesheet" href="public/css/app.css">
</head>

<body>
    <form action="addborrow.view.php" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" required><br>
        <label for="name">E-mail Adresse</label>
        <input type="email" name="email" required><br>
        <label for="name">Telefon</label>
        <input type="tel" name="tel" required><br>
        <label for="name">Mitglied-Status</label>
        <input type="text" name="status" required><br>
        <label for="name">Ausgeleihtes Video</label>
        <input type="text" name="video" required><br>
        <input type="submit">
    </form>
</body>

</html>