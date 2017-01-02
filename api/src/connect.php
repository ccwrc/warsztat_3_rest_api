<?php

function getDbConnection() {
    $DB_SERVER = "localhost"; 
    $DB_USERNAME = "books";
    $DB_PASSWORD = "tajnehaslo";
    $DB_DATABASE = "books";

    $conn = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    if ($conn->connect_error) {
       die("Brak połączenia z bazą danych, błąd: " . $conn->errno);
    }

    $setEncodingSql = "SET CHARSET utf8"; //correct returning pl characters
    $conn->query($setEncodingSql);

    return $conn; //remember to close after operation (close+null)
}

?>