<?php

function getDbConnection() {
    $dbServer = "localhost";
    $dbUsername = "books";
    $dbPassword = "tajnehaslo";
    $dbName = "books";

    $conn = new mysqli($dbServer, $dbUsername, $dbPassword, $dbName);
    $conn->query("SET CHARSET UTF8");

    if ($conn->connect_error) {
        die("Brak połączenia z bazą danych, błąd: " . $conn->errno);
    }

    return $conn;
}
