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
    
    public function loadFromDbById(mysqli $conn, $bookId) {
        $bookId = $conn->real_escape_string($bookId);
        
        $sql = "SELECT book_author, book_title, book_description "
                . "FROM book WHERE book_id = $bookId";
        if ($res = $conn->query($sql)) {
            $row = $res->fetch_assoc();
            $this->bookAuthor = $row['book_author'];
            $this->bookTitle = $row['book_title'];
            $this->bookDescription = $row['book_description'];
            $this->bookId = $bookId;
            return true;
        } else {
            return false;
        } 
    }
    
    public function createBook(mysqli $conn, $author, $title, $description) {
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
    
    public function updateBook(mysqli $conn, $author, $title, $description) {
        $author = $conn->real_escape_string($author);
        $title = $conn->real_escape_string($title);
        $description = $conn->real_escape_string($description);
        $id = $conn->real_escape_string($this->bookId);
        
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
    
    public function deleteFromDb(mysqli $conn) {
        $id = $conn->real_escape_string($this->bookId);
        
        $sql = "DELETE FROM book WHERE book_id = $id";
        if ($res = $conn->query($sql)) {
            $this->bookAuthor = "";
            $this->bookDescription = "";
            $this->bookId = -1;
            $this->bookTitle = "";
            return true;
        } else {
            return false;
        }
    }
    
    /* old test version:
    public function saveToDb(mysqli $conn) {
        $safeId = $conn->real_escape_string($this->bookId);
        $safeBookAuthor = $conn->real_escape_string($this->bookAuthor);
        $safeBookTitle = $conn->real_escape_string($this->bookTitle);
        $safeBookDescription = $conn->real_escape_string($this->bookDescription);
        
        if ($safeId == -1) {
            $sql = "INSERT INTO book (book_author, book_description, book_title) VALUES "
                    . "('$safeBookAuthor', '$safeBookDescription', '$safeBookTitle')";
            $result = $conn->query($sql);
            if ($result == true) {
                $safeId = $conn->insert_id;
                return true;
            } else {
                $sql = "UPDATE book SET book_author = $safeBookAuthor, "
                        . "book_title = '$safeBookTitle', book_description = '$safeBookDescription'"
                        . "WHERE book_id = $safeId";
                $result = $conn->query($sql);
                if ($result) {
                    return true;
                }
            }
            return false;
        }
    }
    */
    
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