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

        <fieldset>
            <legend>Ausleihe erfassen</legend>
            <form action="createborrow.view.php" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" required><br>
                    <div class="form-group">
                        <label for="name">E-mail Adresse:</label>
                        <input type="email" name="email" required><br>
                    </div>
                    <div class="form-group">
                        <label for="name">Telefon:</label>
                        <input type="tel" name="tel" required><br>
                    </div>
                    <div class="form-group">
                        <label for="name">Mitglied-Status:</label>
                        <input type="text" name="status" required><br>
                    </div>
                    <div class="form-group">
                        <label for="name">Ausgeleihtes Video:</label>
                        <input type="text" name="video" required><br>
                    </div>
                    <input type="submit">
            </form>
        </fieldset>
    </div>
</body>

</html>