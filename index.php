<?php
require_once "./functions.php";
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['passwordLength'])) {
    // Controllo se uno dei campi obbligatori è vuoto
    if (empty($_GET['passwordLength']) || (empty($_GET['upperCaseLetters']) &&
        empty($_GET['lowerCaseLetters']) &&
        empty($_GET['numbers']) &&
        empty($_GET['symbols'])
    )) {
        $error = "Uno o più campi risultano vuoti";
    } else {

        // Aggiungi i parametri alla query string durante il redirect
        header("Location: ./result.php?" . http_build_query($_GET));
        exit(); // Assicurati di interrompere l'esecuzione del codice dopo il redirect
    }
}
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

    <?php require_once "./form.php" ?>

</body>

</html>