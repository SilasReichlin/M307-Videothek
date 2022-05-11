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
    <div class="form-style-2">
        <div class="form-style-2-heading">Neue Ausleihe erfassen</div>
        <form action="upsert?id=<?php echo $borrow->id ?? ''; ?>" method="POST">
            <label for="name"><span>Name <span class="required">*</span></span><input type="text" class="input-field" name="name" value="<?php echo $borrow->name ?? ''; ?>" required /></label>
            <label for="email"><span>Email <span class="required">*</span></span><input type="text" class="input-field" name="email" value="<?php echo $borrow->email ?? ''; ?>" required /></label>
            <label for="date"><span>Datum <span class="required">*</span></span><input type="date" class="input-field" name="date" value="<?php echo $borrow->borrowdate ?? '';?>" required /></label>
            <label><span>Telephone</span><input type="text" class="input-field" name="telefon" value="<?php echo $borrow->phone ?? ''; ?>" /></label>
            <label for="status"><span>Status<span class="required">*</span></span><select name="status" class="select-field" required>
                    <option value="Keiner" <?php echo $borrow->membership == "Keiner" ? 'selected' : ''; ?>>Keiner</option>
                    <option value="Bronze" <?php echo $borrow->membership == "Bronze" ? 'selected' : ''; ?>>Bronze</option>
                    <option value="Silber" <?php echo $borrow->membership == "Silber" ? 'selected' : ''; ?>>Silber</option>
                    <option value="Gold" <?php echo $borrow->membership == "Gold" ? 'selected' : ''; ?>>Gold</option>
                </select></label>
            <label for="video"><span>Ausgeleihtes Video <span class="required">*</span></span><input type="text" class="input-field" name="video" value="<?php echo $borrow->video ?? ''; ?>" required /></label>
            <div class="form-group"> <input type="submit" value="Submit" /></div>

        </form>
</body>
<?php if (!empty($errors)) { ?>
    <ul>
        <?php foreach ($errors as $e) { ?>
            <li><?php echo $e ?></li>
        <?php  } ?>
    </ul>
<?php } ?>
</div>
</body>

</html>