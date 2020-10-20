<?php
/**
 *  Паттерн - Стратегия / Strategy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

interface PaymentStrategy
{
    public function pay($amount);
}

class Order
{
    private $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function pay(PaymentStrategy $strategy)
    {
        $strategy->pay($this->amount);
    }
}

class YandexMoneyPayment implements PaymentStrategy
{
    public function pay($amount)
    {
        printArray("Оплата через Яндекс - деньги, сумма к оплате: " . $amount);
    }
}

class InnerAccountPayment implements PaymentStrategy
{
    public function pay($amount)
    {
        printArray('Списываем с внутреннего счета: ' . $amount);
    }
}

$order = new Order(500);
$order->pay(rand(0,1) ? new YandexMoneyPayment() : new InnerAccountPayment());