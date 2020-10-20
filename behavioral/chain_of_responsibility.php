<?php
/**
 * Паттерн Цепочка ответственности / Chain of responsibility
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

abstract class Handler
{
    /**
     * @var Handler|null
     */
    private $next = null;

    public function link(Handler $next)
    {
        $this->next = $next;

        return $this->next;
    }

    public function handle($request)
    {
        if (!is_null($this->next)) {
            return $this->next->handle($request);
        }
        return false;
    }
}

class Operator extends Handler
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function handle($request)
    {
        if($this->isBusy()) {
            echo 'Оператор ' . $this->name . ' занят' . '</br>';
            return parent::handle($request);
        }
        echo 'Запрос: ' . $request . ' принят оператором ' . $this->name . '</br>';
        return true;
    }

    private function isBusy()
    {
        return (bool) rand(0, 4);
    }
}

class BusyHandler extends Handler
{
    private $request = null;

    public function handle($request)
    {
        if($this->request == $request) {
            echo 'Все операторы заняты' . '<br>';
            return false;
        }
        $this->request = $request;

        if ($result = parent::handle($request)) {
            return $result;
        }
    }
}

$busyHandler = new BusyHandler();
$busyHandler
    ->link(new Operator('#1'))
    ->link(new Operator('#2'))
    ->link(new Operator('#3'))
    ->link($busyHandler)
;

for ($i = 0; $i < 3; $i++)
{
    $result = $busyHandler->handle("request - " . $i);
    if (!$result) {
        echo 'Запрос передан на уровень выше' . "<br>";
    }
}