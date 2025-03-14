<?php

session_start();

// Assegno la lunghezza della password

$passwordLength = $_GET["passwordLength"] ?? 0;


// assegno le query string invocando la funzione
$duplicates = assignQueryString("duplicates");
$upperCaseLetters = assignQueryString("upperCaseLetters");
$lowerCaseLetters = assignQueryString("lowerCaseLetters");
$numbers = assignQueryString("numbers");
$symbols = assignQueryString("symbols");


// Assegno la password generata e la converto in un formato pronto a ricevere l'escape dei caratteri speciali

$_SESSION["passwordGenerated"] = generatePassword(
    $passwordLength,
    $duplicates,
    $upperCaseLetters,
    $lowerCaseLetters,
    $numbers,
    $symbols
);
$password = $_SESSION["passwordGenerated"];
$password_utf8 = mb_convert_encoding($password, 'UTF-8', 'auto');

// Dichiaro una funzione per l'assegnazione delle query string

function assignQueryString(string $value)
{

    $_SESSION["$value"] = $_GET["$value"] ?? "";
    $newValue = $_SESSION["$value"];
    return $newValue;
}


// Dichiaro la funzione per generare la password


function generatePassword($passwordLength, $duplicates, $upperCaseLetters, $lowerCaseLetters, $numbers, $symbols)
{

    $lowerCase = "abcdefghijklmnopqrstuvwxyz"; // Lettere minuscole
    $upperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; // Lettere maiuscole
    $num = "0123456789"; // Numeri
    $symb = "!@#$%^&*()-_=+[]{}|;:,.<>?"; // Simboli
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
    if (empty($characters)) {
        return "";
    }

    $password = "";

    if ($duplicates == "Yes") {


        for ($i = 0; $i < $passwordLength; $i++) {

            $password .=  $characters[rand(0, strlen($characters) - 1)];
        }
    } else if ($duplicates == "No") {

        $charactersArray = str_split($characters); // Dividi la stringa in un array
        shuffle($charactersArray); // Mescola i caratteri

        for ($i = 0; $i < $passwordLength; $i++) {

            $password .= $charactersArray[$i];
        }
    }

    return $password;
}
