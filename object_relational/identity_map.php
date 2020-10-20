<?php
/**
 *  Паттерн - Коллекция объектов / Identity Map
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

class IdentityMap
{
    private $items = [];

    public function hasId($id)
    {
        return isset($this->items[$id]);
    }

    public function get($id)
    {
        return $this->items[$id];
    }

    public function set($id, $value)
    {
        $this->items[$id] = $value;
        return $this;
    }
}

class UserMapper
{
    private $adapter;
    private $identityMap;

    public function __construct(StorageAdapter $adapter)
    {
        $this->adapter = $adapter;
        $this->identityMap = new IdentityMap();
    }

    public function findById($id)
    {
        if($this->identityMap->hasId($id)) {
            return $this->identityMap->get($id);
        }

        $result = $this->adapter->findId($id);
        if($result === null) {
            throw new \InvalidArgumentException("Пользователь #$id не найден.");
        }
        $item = $this->mapRowToUser($result);

        $this->identityMap->set($id, $item);

        return $item;
    }

    public function mapRowToUser(array $row): User
    {
        return User::fromState($row);
    }
}


