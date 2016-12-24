<?php

require_once 'src/Book.php';
require_once 'src/connect.php';

$conn = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    if (isset($_GET['id']) && trim($_GET['id']) != ""
        && is_numeric($_GET['id']) && ($_GET['id'] > 0)) {
        //
        }
}



$conn->close();
$conn = null;  
?>