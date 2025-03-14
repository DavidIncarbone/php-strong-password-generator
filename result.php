<?php

require_once "./functions.php";

if (!isset($_SESSION["passwordGenerated"])) {

    header("Location: ./index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css">

    <title>Document</title>
</head>

<body class="p-3">

    <h1 class="text-center">La password generata contiene <span class="text-white"><?php echo $passwordLength ?></span> caratteri (<span class="text-white"><?php echo $lettersInfo ?></span>) ed è: <span class="text-primary "><?php echo htmlentities($password_utf8, ENT_QUOTES, 'UTF-8') ?></span></h1>

    <div class="d-flex justify-content-center">

        <button class="btn btn-primary"><a href="index.php" class="text-decoration-none text-white">Indietro</a></button>
    </div>
</body>

</html>