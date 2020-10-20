<?php
/**
 *  Паттерн - Хранитель / Memento
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

class State
{
    const STATE_OPENED = 'opened';
    const  STATE_CLOSED = "closed";

    private $state;

    public function __construct(string $state)
    {
        $this->state = $state;
    }

    public function __toString(): string
    {
        return $this->state;
    }
}

class Memento
{
    private $state;

    public function __construct(State $stateToSave)
    {
        $this->state = $stateToSave;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }
}

class Ticket
{
    private $currentState;

    public function __construct()
    {
        $this->currentState = new State(State::STATE_OPENED);
    }

    public function open()
    {
        $this->currentState = new State(State::STATE_OPENED);
    }

    public function close()
    {
        $this->currentState = new State(State::STATE_CLOSED);
    }

    public function saveToMemento(): Memento
    {
        return new Memento(clone $this->currentState);
    }

    public function restoreFromMemento(Memento $memento)
    {
        $this->currentState = $memento->getState();
    }

    public function getState() : State
    {
        return $this->currentState;
    }
}

$ticket = new Ticket();
$ticket->open();

printArray($ticket->getState());

$memento = $ticket->saveToMemento();

$ticket->close();
printArray($ticket->getState());

$ticket->restoreFromMemento($memento);
printArray($ticket->getState());