<?php
/**
 * Паттерн Абстрактная фабрика
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

interface Chair {}
interface Table {}
interface Couch {}

class WoodenChair implements Chair {}
class WoodenTable implements Table {}
class WoodenCouch implements Couch {}

interface FurnitureFactory
{
    public function createChair(): Chair;
    public function createTable(): Table;
    public function createCouch(): Couch;
}

class WoodenFurnitureFactory implements FurnitureFactory
{
    public function createChair(): Chair
    {
        return new WoodenChair();
    }

    public function createTable(): Table
    {
        return new WoodenTable();
    }

    public function createCouch(): Couch
    {
        return new WoodenCouch();
    }
}

class Fabric
{
    const MATERIAL_WOOD = "wood";

    public static function createFactory($fabric): FurnitureFactory
    {
        switch ($fabric) {
            case static::MATERIAL_WOOD:
                return new WoodenFurnitureFactory();
        }
    }
}

function getFurnitureCollection($type)
{
    $fabric = Fabric::createFactory($type);

    return [
        'chair' => $fabric->createChair(),
        'table' => $fabric->createTable(),
        'couch' => $fabric->createCouch()
    ];
}

$collection = getFurnitureCollection(Fabric::MATERIAL_WOOD);

printArray($collection);