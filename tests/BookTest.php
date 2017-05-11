<?php

class BookTest extends PHPUnit_Extensions_Database_TestCase {
    protected static $myConn;
    protected static $emptyBook;

    public function getConnection() {
        $conn = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
       // $conn->query("SET CHARSET UTF8");
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);
    }

    public function getDataSet() {
        return $this->createFlatXmlDataSet(__DIR__ . '/../datasets/book.xml');
    }

    public static function setUpBeforeClass() {
        self::$myConn = new mysqli(
                $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'], $GLOBALS['DB_NAME']
        );
      //  self::$myConn->query("SET CHARSET UTF8");
        self::$emptyBook = new Book();
    }

    public function testConstruct() {
        $this->assertInstanceOf("Book", self::$emptyBook);
    }
    
    public function testGetBookId() {
        $this->assertEquals(-1, self::$emptyBook->getBookId());
    }
    
    public function testGetBookTitle() {
        $this->assertEquals("", self::$emptyBook->getBookTitle());
    }
    
    public function testGetBookAuthor() {
        $this->assertEquals("", self::$emptyBook->getBookAuthor());
    }

    public function testGetBookDescription() {
        $this->assertEquals("", self::$emptyBook->getBookDescription());
    }    
    
    public function testSetBookTitle() {
        self::$emptyBook->setBookTitle("title");
        $this->assertEquals("title", self::$emptyBook->getBookTitle());
        $this->assertFalse(self::$emptyBook->setBookTitle("    "));
    }
    
    public function testSetBookAuthor() {
        self::$emptyBook->setBookAuthor("author");
        $this->assertEquals("author", self::$emptyBook->getBookAuthor());
        $this->assertFalse(self::$emptyBook->setBookAuthor("    "));
    }
    
    public function testSetBookDescription() {
        self::$emptyBook->setBookDescription("desc");
        $this->assertEquals("desc", self::$emptyBook->getBookDescription());
        $this->assertFalse(self::$emptyBook->setBookDescription("    "));
    }
    
    public function testLoadFromDbById() {
        $book = Book::loadFromDbById(self::$myConn, 3);
        $this->assertEquals("autor 3 książki", $book->getBookAuthor());
        $this->assertFalse(Book::loadFromDbById(self::$myConn, 33));
        $this->assertFalse(Book::loadFromDbById(self::$myConn, "abc"));
    }
    
    public function testLoadAllFromDb() {
        $books = Book::loadAllFromDb(self::$myConn);
        $this->assertInstanceOf("Book", $books[1]);
        $this->assertEquals("tytł 2", $books[1]->getBookTitle());
    }
    
    public function testCreateBook() {
        $this->assertInstanceOf("Book", Book::createBook("a", "b", "c"));
        $this->assertFalse(Book::createBook("a", "b", "  "));
        $this->assertFalse(Book::createBook("  ", "b", "c"));
        $this->assertInstanceOf("Book", Book::createBook("0", "0", "0"));
    }
    
    

}
