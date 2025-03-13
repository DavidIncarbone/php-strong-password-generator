<?php

session_start();

require "./functions.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Strong password generator</title>
</head>

<body class="p-3">

    <h1 class="text-center">Strong password generator</h1>
    <h2>Genera una password sicura</h2>

    <form action="" method="GET">

        <label for="passwordLength">

            Lunghezza password:

        </label>
        <input type="number" id="passwordLength" name="passwordLength" min="5" max="20">
        <button class="btn btn-primary">Invia</button>
        <button class="btn btn-secondary">Annulla</button>

    </form>

    <?php echo generatePassword($passwordLength) ?>

</body>

</html>