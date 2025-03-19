<?php

// assegno la lunghezza della password ad una variabile
$passwordLength = $_GET["passwordLength"] ?? 0;

// assegno le query string alle variabili
$duplicates = $_GET["duplicates"] ?? "";
$upperCaseLetters = $_GET["upperCaseLetters"] ?? "";
$lowerCaseLetters = $_GET["lowerCaseLetters"] ?? "";
$numbers = $_GET["numbers"] ?? "";
$symbols = $_GET["symbols"] ?? "";


// dichiaro la funzione per generare la password
function generatePassword($passwordLength, $duplicates, $upperCaseLetters, $lowerCaseLetters, $numbers, $symbols)
{
    // caratteri disponibili
    $lowerCase = "abcdefghijklmnopqrstuvwxyz"; // lettere minuscole
    $upperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; // lettere maiuscole
    $num = "0123456789"; // numeri
    $symb = "!@#$%^&*()-_=+[]{}|;:,.<>?"; // simboli

    // dichiaro e popolo la variabile characters in base alle scelte dell'utente

    $characters = "";

    if ($upperCaseLetters == "on") {
        $characters .= $upperCase;
    }
    if ($lowerCaseLetters == "on") {
        $characters .= $lowerCase;
    }
    if ($numbers == "on") {
        $characters .= $num;
    }
    if ($symbols == "on") {
        $characters .= $symb;
    }

    //dichiaro e popolo la variabile password assicurandomi che sia presente almeno un tipo di carattere scelto dall'utente

    $password = "";


    if ($upperCaseLetters == "on") {
        $password .= $upperCase[rand(0, strlen($upperCase) - 1)];
    }
    if ($lowerCaseLetters == "on") {
        $password .= $lowerCase[rand(0, strlen($lowerCase) - 1)];
    }
    if ($numbers == "on") {
        $password .= $num[rand(0, strlen($num) - 1)];
    }
    if ($symbols == "on") {
        $password .= $symb[rand(0, strlen($symbols) - 1)];
    }


    // calcolo la length rimanente della mia password 
    $remainingLength = $passwordLength - strlen($password);

    // se sono permessi duplicati, aggiungo caratteri a caso presi dalla variabile characters
    if ($duplicates === "Yes") {
        for ($i = 0; $i < $remainingLength; $i++) {

            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
    }
    // Se non sono permessi duplicati:

    else if ($duplicates == "No") {

        // Se la length scelta dall'utente è uguale al numero di caratteri disponibili, mi assicuro di non entrare in un ciclo infinito

        if ($passwordLength == strlen($characters)) {

            // aggiungo caratteri in modo ordinato, ciclando su characters

            for ($i = 0; $i < strlen($characters); $i++) {

                // evito i duplicati

                if (strpos($password, $characters[$i]) === false) {
                    $password .= $characters[$i];
                }
            }
            // successivamente, li mescolo con str_shuffle

            $password = str_shuffle($password);
        } else {

            // altrimenti aggiungo caratteri casuali alla mia password, sempre assicurandomi di evitare duplicati

            $char_count = 0;

            while ($char_count < $remainingLength) {

                $randomChar = $characters[rand(0, strlen($characters) - 1)];

                if (strpos($password, $randomChar) === false) {

                    $password .= $randomChar;
                    $char_count++;
                }
            }
        }
    }


    return $password;
}

// Genero la password invocando la funzione e assegnandola alla variabile di sessione

$_SESSION["passwordGenerated"] = generatePassword(
    $passwordLength,
    $duplicates,
    $upperCaseLetters,
    $lowerCaseLetters,
    $numbers,
    $symbols
);





// genero e assegno alla variabile di sessione, una variabile contenente le informazioni sui caratteri selezionati e la mostro in return.php


$lettersInfo = "";

if ($upperCaseLetters) {
    $lettersInfo .= "Lettere maiuscole ";
}
if ($lowerCaseLetters) {
    $lettersInfo .= "Lettere minuscole ";
}
if ($numbers) {
    $lettersInfo .= "Numeri ";
}
if ($symbols) {
    $lettersInfo .= "Simboli ";
}
if ($duplicates == "No") {
    $lettersInfo .= "Senza duplicati";
}



$_SESSION["lettersInfo"] = $lettersInfo;
