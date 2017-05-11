<?php

require_once "src/Book.php";
require_once "src/connect.php";

$conn = getDbConnection();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["id"]) && trim($_GET["id"]) != "" && is_numeric($_GET["id"]) 
            && ($_GET["id"] > 0)) {

        $book = Book::loadFromDbById($conn, $_GET["id"]);
        echo json_encode($book);
    } else {
        $books = Book::loadAllFromDb($conn);
        echo json_encode($books);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["author"]) && (trim($_POST["author"]) != "") && isset($_POST["title"]) 
            && (trim($_POST["title"]) != "") && isset($_POST["description"]) 
            && (trim($_POST["description"]) != "")) {

        $book = Book::createBook($_POST["author"], $_POST["title"], $_POST["description"]);
        if ($book->saveToDb($conn)) {
            echo json_encode($book);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "PUT") {
    parse_str(file_get_contents("php://input"), $putVars);

    $book = Book::loadFromDbById($conn, $putVars["id"]);
    $book->updateBook($putVars["author"], $putVars["title"], $putVars["description"]);
    if ($book->saveToDb($conn)) {
        echo json_encode($book);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
    parse_str(file_get_contents("php://input"), $delVars);

    $bookToDelete = Book::deleteFromDbById($conn, $delVars["id"]);
    if ($bookToDelete) {
        echo json_encode($bookToDelete);
    }
}

$conn->close();
$conn = null;
