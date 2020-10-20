<?php
/**
 *  Паттерн - Итератор / Iterator
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

class Product
{
    private $name;
    private $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function describe()
    {
        return $this->name . ': ' . number_format($this->price, 2, '.', '') . ' руб.';
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }
}

class Basket implements Iterator
{
    private $products = [];
    private $currentIndex = 0;

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function getPrice()
    {
        $this->rewind();
        $price = 0.0;

        foreach ($this as $product) {
            $price += $product->getPrice();
        }
        return $price;
    }

    public function current()
    {
        return $this->products[$this->key()];
    }

    public function key(): int
    {
        return $this->currentIndex;
    }

    public function next()
    {
        return $this->currentIndex++;
    }

    public function rewind()
    {
        $this->currentIndex = 0;
    }

    public function valid(): bool
    {
        return isset($this->products[$this->currentIndex]);
    }
}

$basket = new Basket();
$basket->addProduct(new Product('Лапша', 100));
$basket->addProduct(new Product('Пельмени', 200));
$basket->addProduct(new Product('Яблоки',90));

foreach ($basket as $product) {
    printArray($product->describe() . PHP_EOL);
}

printArray('Итого: ' . $basket->getPrice() . PHP_EOL);