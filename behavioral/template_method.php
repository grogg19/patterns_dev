<?php
/**
 *  Паттерн - Шаблонный метод / Template method
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

abstract class Journey
{
    private $thingsToDo = [];
    final public function takeATrip()
    {
        $this->thingsToDo[] = $this->buyAFlight();
        $this->thingsToDo[] = $this->takeAPlane();
        $this->thingsToDo[] = $this->enjoyVacation();

        $buyGift = $this->buyGift();

        if($buyGift !== null) {
            $this->thingsToDo[] = $buyGift;
        }

        $this->thingsToDo[] = $this->takeAPlane();
    }

    abstract protected function enjoyVacation(): string;

    protected function buyGift()
    {
        return null;
    }

    private function buyAFlight(): string
    {
        return 'Покупаем билеты на самолет';
    }

    private function takeAPlane(): string
    {
        return 'Летим на самолете';
    }

    public function getThingsToDo(): array
    {
        return $this->thingsToDo;
    }
}

class CityJourney extends Journey
{
    protected function enjoyVacation(): string
    {
        return 'Жрать, бухать и отдыхать, искать приключения на свою жопу';
    }

    protected function buyGift(): string
    {
        return 'Купить магнитик';
    }
}

class BeachJourney extends Journey
{
    protected function enjoyVacation(): string
    {
        return "Купаться и загорать на пляже";
    }
}

$journey = rand(0, 1) ? new BeachJourney() : new CityJourney();
$journey->takeATrip();

foreach ($journey->getThingsToDo() as $item) {
    printArray($item);
}