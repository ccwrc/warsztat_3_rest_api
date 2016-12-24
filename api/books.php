<?php

require_once 'src/Book.php';
require_once 'src/connect.php';

$conn = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    if (isset($_GET['id']) && trim($_GET['id']) != ""
        && is_numeric($_GET['id']) && ($_GET['id'] > 0)) {
        $book = Book::loadFromDbById($conn, $_GET['id']);
        $serializedData = json_encode($book);
        echo $serializedData;
    } else {
        $books = Book::loadAllFromDb($conn);
        $serializedData = json_encode($books);
        echo $serializedData; 
    }
}



$conn->close();
$conn = null;  
?>