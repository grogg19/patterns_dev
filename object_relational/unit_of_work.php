<?php
/**
 *  Паттерн - Единица работы / Unit of Work
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

class UnitOfWork
{
    private $news = [];
    private $updates = [];
    private $deletes = [];

    public function addNew($item)
    {
        $this->news[] = $item;
        return $this;
    }

    public function addUpdate($item)
    {
        $this->updates[] = $item;
        return $this;
    }

    public function addDelete($item)
    {
        $this->deletes[] = $item;
        return $this;
    }

    public function commit()
    {
        foreach ($this->news as $item) {
            printArray('Добавляем ' . $item . PHP_EOL);
        }

        foreach ($this->updates as $item) {
            printArray('Обновляем ' . $item . PHP_EOL);
        }

        foreach ($this->deletes as $item) {
            printArray('Удаляем ' . $item . PHP_EOL);
        }
    }
}

$work = new UnitOfWork();
$work
    ->addNew("Масла в огонь")
    ->addUpdate("Cметану")
    ->addUpdate("Иммунитет")
    ->addDelete("Болезнь")
    ->addNew("Чудесное настроение")
    ->commit();
;

