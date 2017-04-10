<?php

require_once 'src/Book.php';
require_once 'src/connect.php';

$conn = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id']) && trim($_GET['id']) != "" && is_numeric($_GET['id']) 
            && ($_GET['id'] > 0)) {
        $book = Book::loadFromDbById($conn, $_GET['id']);
        $serializedData = json_encode($book);
        echo $serializedData;
    } else {
        $books = Book::loadAllFromDb($conn);
        $serializedData = json_encode($books);
        echo $serializedData;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['author']) && (trim($_POST['author']) != "") && isset($_POST['title']) 
            && (trim($_POST['title']) != "") && isset($_POST['description']) 
            && (trim($_POST['description']) != "")) {

        $author = $_POST['author'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        $book = new Book();
        $book->createBook($conn, $author, $title, $description);
        echo json_encode($book);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $del_vars);
    $book = Book::deleteFromDb($conn, $del_vars['id']);
    echo json_encode($book);
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $put_vars);
    $id = $put_vars['id'];
    $author = $put_vars['author'];
    $title = $put_vars['title'];
    $description = $put_vars['description'];

    $book = new Book();
    $book->updateBook($conn, $author, $title, $description, $id);
    echo json_encode($book);
}

$conn->close();
$conn = null;
?>