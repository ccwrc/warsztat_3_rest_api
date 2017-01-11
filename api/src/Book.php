<?php

class Book implements JsonSerializable {
    private $bookId;
    private $bookTitle;
    private $bookAuthor;
    private $bookDescription;
    
    public function __construct() {
        $this->bookId = -1;
        $this->bookTitle = "";
        $this->bookAuthor = "";
        $this->bookDescription = "";
    }
    
    public function getBookId() {
        return $this->bookId;
    }
    
    public function getBookTitle() {
        return $this->bookTitle;
    }
    
    public function getBookAuthor() {
        return $this->bookAuthor;
    }
    
    public function getBookDescription() {
        return $this->bookDescription;
    }
    
    public function setBookTitle($bookTitle) {
        if (is_string($bookTitle) && (strlen($bookTitle) <= 255)) {
            $this->bookTitle = $bookTitle;
            return $this;
        } else {
            return false;
        }
    }
    
    public function setBookAuthor($bookAuthor) {
        if (is_string($bookAuthor) && (strlen($bookAuthor) <= 255)) {
            $this->bookAuthor = $bookAuthor;
            return $this;
        } else {
            return false;
        }
    }
    
    public function setBookDescription($bookDescription) {
        if (is_string($bookDescription) && (strlen($bookDescription) <= 25000)) {
            $this->bookDescription = $bookDescription;
            return $this;
        } else {
            return false;
        }
    }
    
    static public function loadFromDbById(mysqli $conn, $id) {
        $id = htmlentities($id, ENT_QUOTES, "UTF-8");
        $id = $conn->real_escape_string($id);
        
        $sql = "SELECT book_author, book_title, book_description "
                . "FROM book WHERE book_id = $id";
        if ($res = $conn->query($sql)) {
            $row = $res->fetch_assoc();
            $book = new Book();
            $book->bookAuthor = $row['book_author'];
            $book->bookTitle = $row['book_title'];
            $book->bookDescription = $row['book_description'];
            $book->bookId = $id;
            return $book;
        } else {
            return false;
        } 
    }
    
    static public function loadAllFromDb(mysqli $conn) {
        $books = [];
        
        $sql = "SELECT * FROM book";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            foreach ($result as $row) {
                $book = new Book;
                $book->bookAuthor = $row['book_author'];
                $book->bookDescription = $row['book_description'];
                $book->bookTitle = $row['book_title'];
                $book->bookId = $row['book_id'];
                $books[$book->bookId] = $book;
            }
            return $books;
        } else {
            return false;
        }
    }
    
    public function createBook(mysqli $conn, $author, $title, $description) {
        $author = htmlentities($author, ENT_QUOTES, "UTF-8");
        $title = htmlentities($title, ENT_QUOTES, "UTF-8");
        $description = htmlentities($description, ENT_QUOTES, "UTF-8");
        
        $author = $conn->real_escape_string($author);
        $title = $conn->real_escape_string($title);
        $description = $conn->real_escape_string($description);
        
        $sql = "INSERT INTO book (book_author, book_title, book_description)"
                . " VALUES ('$author', '$title', '$description')";
        if ($conn->query($sql)) {
            $this->bookAuthor = $author;
            $this->bookTitle = $title;
            $this->bookDescription = $description;
            $this->bookId = $conn->insert_id; 
            return true;
        } else {
            return false;
        }
    }
    
    public function updateBook(mysqli $conn, $author, $title, $description, $id) {
        $author = htmlentities($author, ENT_QUOTES, "UTF-8");
        $title = htmlentities($title, ENT_QUOTES, "UTF-8");
        $description = htmlentities($description, ENT_QUOTES, "UTF-8");
        $id = htmlentities($id, ENT_QUOTES, "UTF-8");
        
        $author = $conn->real_escape_string($author);
        $title = $conn->real_escape_string($title);
        $description = $conn->real_escape_string($description);
        $id = $conn->real_escape_string($id);
        
        $sql = "UPDATE book SET book_author = '$author', book_title = '$title', "
                . "book_description = '$description' WHERE book_id = $id";
        if ($conn->query($sql)) {
            $this->bookAuthor = $author;
            $this->bookTitle = $title;
            $this->bookDescription = $description;
            return true;
        } else {
            return false;
        }
    }
    
    static public function deleteFromDb(mysqli $conn, $id) {
        $id = htmlentities($id, ENT_QUOTES, "UTF-8");
        $id = $conn->real_escape_string($id);
        
        $sql = "DELETE FROM book WHERE book_id = $id";
        if ($res = $conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function jsonSerialize() {
       return [
          'booktitle' => $this->bookTitle,
          'bookauthor' => $this->bookAuthor,
          'bookdescription' => $this->bookDescription,
          'bookid' => $this->bookId 
       ];
    } 
      
}

?>