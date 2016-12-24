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
        $this->bookTitle = $bookTitle;
    }
    
    public function setBookAuthor($bookAuthor) {
        $this->bookAuthor = $bookAuthor;
    }
    
    public function setBookDescription($bookDescription) {
        $this->bookDescription = $bookDescription;
    }
    
    public function saveToDb(mysqli $conn) {
        if ($this->bookId == -1) {
            $sql = "INSERT INTO book (book_author, book_description, book_title) VALUES "
                    . "('$this->bookAuthor', '$this->bookDescription', '$this->bookTitle')";
            $result = $conn->query($sql);
            if ($result == true) {
                $this->bookId = $conn->insert_id;
                return true;
            } else {
                $sql = "UPDATE book SET book_author = $this->bookAuthor, "
                        . "book_title = '$this->bookTitle', book_description = '$this->bookDescription'"
                        . "WHERE book_id = $this->bookId";
                $result = $conn->query($sql);
                if ($result) {
                    return true;
                }
            }
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
