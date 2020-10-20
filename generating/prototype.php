<?php
/**
 * Паттерн Prototype
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

class Author
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

abstract class BookPrototype
{
    protected $title;
    protected $category;
    public $author;

    abstract public function __clone();

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setAuthor(Author $author)
    {
        $this->author = $author;
        return $this;
    }
}

class StoryBookPrototype extends BookPrototype
{
    protected $category = "Повесть";
    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}

$storyBook = new StoryBookPrototype();

$book1 = clone $storyBook;
$book1
    ->setAuthor(new Author("Пушкин"))
    ->setTitle("Пиковая дама")
;

$book2 = clone $book1;

$book2
    ->setTitle('Нос')
    ->author->name = "Гоголь";
;

printArray($book1);
printArray($book2);