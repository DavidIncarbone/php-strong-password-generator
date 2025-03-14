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
    return $_SESSION["$value"];
}

// Dichiaro la funzione per generare la password
function generatePassword($passwordLength, $duplicates, $upperCaseLetters, $lowerCaseLetters, $numbers, $symbols)
{
    // Caratteri disponibili
    $lowerCase = "abcdefghijklmnopqrstuvwxyz"; // Lettere minuscole
    $upperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; // Lettere maiuscole
    $num = "0123456789"; // Numeri
    $symb = "!@#$%^&*()-_=+[]{}|;:,.<>?"; // Simboli
    $characters = "";

    // Aggiungi caratteri selezionati
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
        return "Errore: nessun tipo di carattere selezionato!";
    }

    $password = "";
    $requiredCharacters = [];

    // Aggiungi almeno un carattere di ogni tipo selezionato
    if ($upperCaseLetters == "on") {
        $requiredCharacters[] = $upperCase[rand(0, strlen($upperCase) - 1)];
    }
    if ($lowerCaseLetters == "on") {
        $requiredCharacters[] = $lowerCase[rand(0, strlen($lowerCase) - 1)];
    }
    if ($numbers == "on") {
        $requiredCharacters[] = $num[rand(0, strlen($num) - 1)];
    }
    if ($symbols == "on") {
        $requiredCharacters[] = $symb[rand(0, strlen($symb) - 1)];
    }

    // Miscelare i caratteri obbligatori
    shuffle($requiredCharacters);

    // Aggiungi i caratteri obbligatori alla password
    $password .= implode("", $requiredCharacters);

    // Calcola la lunghezza rimanente
    $remainingLength = $passwordLength - count($requiredCharacters);

    if ($duplicates == "Yes") {
        // Aggiungi i caratteri rimanenti con duplicati
        for ($i = 0; $i < $remainingLength; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
    } else if ($duplicates == "No") {
        // Dividi la stringa in un array di caratteri unici
        $charactersArray = str_split($characters);

        // Se la lunghezza della password è maggiore del numero di caratteri unici, non possiamo continuare senza duplicati.
        if (count($charactersArray) < $remainingLength) {
            return "Errore: non ci sono abbastanza caratteri unici per generare la password senza duplicazioni.";
        }

        // Mescolare i caratteri unici
        shuffle($charactersArray);

        // Aggiungi solo i primi $remainingLength caratteri senza duplicazioni
        $uniqueCharacters = array_slice($charactersArray, 0, $remainingLength);
        $password .= implode("", $uniqueCharacters);
    }

    // Mescolare l'intera password per garantire casualità
    $password = str_shuffle($password);

    return $password;
}

// Mostra le informazioni sui caratteri selezionati
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
