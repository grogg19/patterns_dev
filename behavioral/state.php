<?php
/**
 *  Паттерн - Состояние / State
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

interface State
{
    public function proceedToNext(OrderContext $context);
    public function toString(): string;
}

class StateCreated implements State
{
    public function proceedToNext(OrderContext $context)
    {
        $context->setState(new StateShipped());
    }
    public function toString(): string
    {
        return "created";
    }
}

class StateShipped implements State
{
    public function proceedToNext(OrderContext $context)
    {

        $context->setState(new StateDone());
    }

    public function toString(): string
    {
        return "shipped";
    }
}

class StateDone implements State
{
    public function proceedToNext(OrderContext $context)
    {

    }

    public function toString(): string
    {
        return "done";
    }
}

class OrderContext
{
    /**
     * @var State
     */
    private $state;

    public function create(): OrderContext
    {
        $order = new self();
        $order->state = new StateCreated();

        return $order;
    }

    /**
     * @param State $state
     */
    public function setState(State $state)
    {
        $this->state = $state;
    }

    public function proceedToNext()
    {
        $this->state->proceedToNext($this);
    }

    public function toString()
    {
        return $this->state->toString();
    }
}

$order = OrderContext::create();
printArray($order->toString());

$order->proceedToNext();
printArray($order->toString());

$order->proceedToNext();
printArray($order->toString());

$order->proceedToNext();
printArray($order->toString());