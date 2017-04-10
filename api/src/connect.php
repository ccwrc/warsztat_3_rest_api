<?php

function getDbConnection() {
    $DB_SERVER = "localhost";
    $DB_USERNAME = "books";
    $DB_PASSWORD = "tajnehaslo";
    $DB_DATABASE = "books";

    $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $conn->query("SET CHARSET UTF8");

    if ($conn->connect_error) {
        die("Brak połączenia z bazą danych, błąd: " . $conn->errno);
    }

    return $conn;
}
