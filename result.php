<?php

session_start();


if (!isset($_SESSION["passwordGenerated"])) {

    header("Location: ./index.php");
}

$passwordLength = $_GET["passwordLength"] ?? 0;

require_once "./functions.php";

$_SESSION["passwordGenerated"] = generatePassword($passwordLength);

var_dump($_SESSION);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Document</title>
</head>

<body class="p-3">

    <h1 class="text-center">La password generata è: <span class="text-primary"><?php echo $_SESSION["passwordGenerated"] ?></span></h1>
    <div class="d-flex justify-content-center">

        <button class="btn btn-primary"><a href="index.php" class="text-decoration-none text-white">Indietro</a></button>
    </div>
</body>

</html>