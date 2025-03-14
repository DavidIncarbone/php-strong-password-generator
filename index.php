<?php
session_start();
$passwordLength = $_GET["passwordLength"] ?? 0;

require_once "./functions.php";

$_SESSION["passwordGenerated"] = generatePassword($passwordLength);

// var_dump($_SESSION);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css">

    <title>Strong password generator</title>
</head>

<body class="p-3">

    <h1 class="text-center">Strong password generator</h1>
    <h2 class="text-center text-white">Genera una password sicura</h2>
    <div id="alert-info" class="p-3 my-4 d-none">Nessun parametro valido inserito</div>

    <form action="result.php" method="GET" class="p-3">

        <div class="d-flex justify-content-between mb-3">
            <label for="passwordLength"> Lunghezza password:</label>
            <input type="number" id="passwordLength" name="passwordLength" min="5" max="20" required>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <label for="duplicates"> Consenti ripetizioni di uno o più caratteri:</label>
            <div class="d-flex flex-column me-5">
                <div><input type="radio" id="duplicates" name="duplicates" checked> <label for="duplicates">Sì</label></div>
                <div><input type="radio" id="duplicates" name="duplicates"> <label for="duplicates">No</label></div>

            </div>
        </div>
        <div class="d-flex flex-column align-items-end mb-3">
            <div><input type="checkbox" id="letters" name="letters">
                <label for="letters">Lettere</label>
            </div>
            <div><input type="checkbox" id="numbers" name="numbers">
                <label for="numbers">Numeri</label>
            </div>
            <div><input type="checkbox" id="symbols" name="symbols">
                <label for="symbols">Simboli</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Invia</button>
        <button type="reset" class="btn btn-secondary">Annulla</button>

    </form>

    <?php echo $_SESSION["passwordGenerated"] ?>

</body>

</html>