<?php

$passwordLength = $_GET["passwordLength"];

function generatePassword($passwordLength)
{

    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}|;:,.<>?";
    $password = "";

    for ($i = 0; $i < $passwordLength; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $password;
}
