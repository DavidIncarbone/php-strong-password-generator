<?php

// Assegno la lunghezza della password

$passwordLength = $_GET["passwordLength"] ?? 0;

// Assegno il valore di duplicates

$_SESSION["duplicates"] = $_GET["duplicates"] ?? "";
$duplicates = $_SESSION["duplicates"];


// Dichiaro la funzione per generare la password


function generatePassword($passwordLength, $duplicates)
{

    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}|;:,.<>?";
    // var_dump($characters);
    $password = "";
    if ($duplicates == "Yes") {
        for ($i = 0; $i < $passwordLength; $i++) {

            $password .=  $characters[rand(0, strlen($characters) - 1)];
        }
    } else {

        $charactersArray = str_split($characters); // Dividi la stringa in un array
        shuffle($charactersArray); // Mescola i caratteri

        for ($i = 0; $i < $passwordLength; $i++) {

            $password .= $charactersArray[$i];
        }
    }

    return $password;
}

// Assegno la password generata e la converto in un formato pronto a ricevere l'escape dei caratteri speciali

$_SESSION["passwordGenerated"] = generatePassword($passwordLength, $duplicates);
$password = $_SESSION["passwordGenerated"];
$password_utf8 = mb_convert_encoding($password, 'UTF-8', 'auto');
