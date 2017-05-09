<?php

class BookTest extends PHPUnit_Extensions_Database_TestCase {
    protected static $myConn;
    protected static $emptyBook;

    public function getConnection() {
        $conn = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
        $conn->query("SET CHARSET UTF8");
        return new PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection($conn, $GLOBALS['DB_NAME']);
    }

    public function getDataSet() {
        return $this->createFlatXmlDataSet(__DIR__ . '/../datasets/book.xml');
    }

    public static function setUpBeforeClass() {
        self::$myConn = new mysqli(
                $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'], $GLOBALS['DB_NAME']
        );
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

}
