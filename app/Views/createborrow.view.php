<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <title>Ausleihe Verwaltung</title>
    <base href="<?= ROOT_URL ?>/">
    <link rel="stylesheet" href="public/css/app.css">
</head>
    <div class="form-style-2">
        <div class="form-style-2-heading">Neue Ausleihe erfassen</div>
        <form action="upsert" method="post">
            <label for="name"><span>Name <span class="required">*</span></span><input type="text" class="input-field" name="name" value="<?php echo $borrow->name ?? ''; ?>" required /></label>
            <label for="email"><span>Email <span class="required">*</span></span><input type="text" class="input-field" name="email" value="<?php echo $borrow->email ?? ''; ?>" required /></label>
            <label for="date"><span>Datum <span class="required">*</span></span><input type="date" class="input-field" name="date" value="<?php echo $borrow->date ?? ''; ?>" required /></label>
            <label><span>Telephone</span><input type="text" class="input-field" name="telefon" value="<?php echo $borrow->telefon ?? ''; ?>" /></label>
            <label for="status"><span>Status<span class="required">*</span></span><select name="status" class="select-field" required>
                    <option value="<?php echo $borrow->Keiner ?? ''; ?>">Keiner</option>
                    <option value="<?php echo $borrow->Bronze ?? ''; ?>">Bronze</option>
                    <option value="<?php echo $borrow->Silber ?? ''; ?>">Silber</option>
                    <option value="<?php echo $borrow->Gold ?? ''; ?>">Gold</option>
                </select></label>
            <label for="video"><span>Ausgeleihtes Video <span class="required">*</span></span><input type="text" class="input-field" name="video" value="<?php echo $borrow->video ?? ''; ?>" required /></label>
            <div class="form-group"> <input type="submit" value="Submit" /></div>

        </form>
    </div>
</body>

</html>