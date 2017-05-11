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
        if ((strlen(trim($bookTitle)) >= 1) && (strlen(trim($bookTitle)) <= 255)) {
            $bookTitle = htmlentities(trim($bookTitle), ENT_QUOTES, "UTF-8");
            $this->bookTitle = $bookTitle;
            return $this;
        } 
        return false;
    }

    public function setBookAuthor($bookAuthor) {
        if ((strlen(trim($bookAuthor)) >= 1) && (strlen(trim($bookAuthor)) <= 255)) {
            $bookAuthor = htmlentities(trim($bookAuthor), ENT_QUOTES, "UTF-8");
            $this->bookAuthor = $bookAuthor;
            return $this;
        }
        return false;
    }

    public function setBookDescription($bookDescription) {
        if ((strlen(trim($bookDescription)) >= 1) && (strlen(trim($bookDescription)) <= 25000)) {
            $bookDescription = htmlentities(trim($bookDescription), ENT_QUOTES, "UTF-8");
            $this->bookDescription = $bookDescription;
            return $this;
        }
        return false;
    }
    
    public static function loadFromDbById(mysqli $conn, $bookId) {
        $statement = $conn->prepare("SELECT * FROM book WHERE book_id = ?");
        $statement->bind_param('i', $bookId);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $book = new Book();
            $book->bookAuthor = $row['book_author'];
            $book->bookTitle = $row['book_title'];
            $book->bookDescription = $row['book_description'];
            $book->bookId = $row['book_id'];
            $statement->close();
            return $book;
        }
        $statement->close();
        return false;
    }

    public static function loadAllFromDb(mysqli $conn) {
        $books = [];
        $sql = "SELECT * FROM book";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            foreach ($result as $row) {
                $book = new Book;
                $book->bookAuthor = $row['book_author'];
                $book->bookDescription = $row['book_description'];
                $book->bookTitle = $row['book_title'];
                $book->bookId = $row['book_id'];
                $books[] = $book;
            }
        }
        return $books;
    }
    
    public static function createBook($author, $title, $description) {
        $book = new Book();
        if ($book->setBookAuthor($author) && $book->setBookTitle($title) 
                && $book->setBookDescription($description)) {
            return $book;
        }
        return false;
    }
    
    public function updateBook($author, $title, $description) {
        if ($this->setBookAuthor($author) && $this->setBookTitle($title) 
                && $this->setBookDescription($description)) {
            return $this;
        }
        return false;
    }

    public static function deleteFromDbById(mysqli $conn, $id) {
        if (!is_numeric($id) || $id < 0) {
            return false;
        }    
        $statement = $conn->prepare("DELETE FROM book WHERE book_id = ?");
        $statement->bind_param('i', $id);

        if ($statement->execute()) {
            $statement->close();
            return true;
        }
        $statement->close();
        return false;
    }
    
    public function saveToDb(mysqli $conn) {
        if ($this->bookId == -1) {
            $statement = $conn->prepare("INSERT INTO book (book_author, book_title, "
                    . "book_description) VALUES (?, ?, ?)");
            $statement->bind_param('sss', $this->bookAuthor, $this->bookTitle, 
                    $this->bookDescription);
            if ($statement->execute()) {
                $this->bookId = $statement->insert_id;
                $statement->close();
                return true;
            } else {
                $statement->close();
                return false;
            }
        } else {
            $statement = $conn->prepare("UPDATE book SET book_author = ?, "
                    . "book_title = ?, book_description = ? WHERE book_id = ?");
            $statement->bind_param('sssi', $this->bookAuthor, $this->bookTitle, 
                    $this->bookDescription, $this->bookId);
            if ($statement->execute()) {
                $statement->close();
                return true;
            }
            $statement->close();
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
