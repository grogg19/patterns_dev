<?php
/**
 *  Паттерн - Деньги / Money
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

final class Money
{
    private $amount;
    private $currency;

    public function __construct($amount, $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    public function isEqual(Money $money)
    {
        if($this->getCurrency() === $money->getCurrency()) {
            return $this->getAmount() === $money->getAmount();
        } else {
            // Выполняем конвертацию и сравниваем
        }
    }
}

$money1 = new Money(1, '$');
$money2 = new Money(1, '$');

printArray(($money1 === $money2) ? 'Равны' : 'Не равны');
printArray($money1->isEqual($money2) ? 'Равны' : 'Не равны');