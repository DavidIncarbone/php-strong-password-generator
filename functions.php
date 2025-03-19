<?php

// Assegno la lunghezza della password
$passwordLength = $_GET["passwordLength"] ?? 0;

// assegno le query string alle variabili di sessione invocando la funzione
$duplicates = assignQueryString("duplicates");
$upperCaseLetters = assignQueryString("upperCaseLetters");
$lowerCaseLetters = assignQueryString("lowerCaseLetters");
$numbers = assignQueryString("numbers");
$symbols = assignQueryString("symbols");

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

    // Aggiungi i caratteri obbligatori alla password
    $password .= implode("", $requiredCharacters);

    // Calcola la lunghezza rimanente
    $remainingLength = $passwordLength - count($requiredCharacters);

    // Se sono permessi i duplicati, aggiungi caratteri a caso
    if ($duplicates == "Yes") {
        for ($i = 0; $i < $remainingLength; $i++) {
            // Aggiungi un carattere casuale dalla lista dei caratteri
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
    }
    // Se non sono permessi duplicati
    else if ($duplicates == "No") {
        $newCharacters = 0;
        $usedCharacters = [];

        // Aggiungi solo caratteri unici fino a riempire la lunghezza rimanente
        while ($newCharacters < $remainingLength && strlen($characters) > 0) {
            $randomChar = $characters[rand(0, strlen($characters) - 1)];

            // Se il carattere non è già stato usato, aggiungilo alla password
            if (!in_array($randomChar, $usedCharacters)) {
                $password .= $randomChar;
                $usedCharacters[] = $randomChar;
                $newCharacters++;
            }
        }

        // Se non ci sono abbastanza caratteri unici, permetti i duplicati
        if ($newCharacters < $remainingLength) {
            while ($newCharacters < $remainingLength) {
                $password .= $characters[rand(0, strlen($characters) - 1)];
                $newCharacters++;
            }
        }
    }

    // Mescolare l'intera password per garantirne la casualità
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
