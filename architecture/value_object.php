<?php
/**
 *  Паттерн - Объект значение / Value Object
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

final class Point
{
    private $x, $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    public function isEqual(Point $point)
    {
        return $this->getX() == $point->getX() && $this->getY() == $point->getY();
    }
}

$point1 = new Point(1, 2);
$point2 = new Point(1, 2);

printArray(($point1 === $point2) ? 'Равны' : 'Не равны');
printArray($point1->isEqual($point2) ? 'Равны' : 'Не равны');