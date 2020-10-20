<?php
/**
 *  Паттерн - Преобразователь данных / Data Mapper
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

class User
{
    private $name;
    private $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public static function fromState(array $state)
    {
        return new static($state['name'], $state['email']);
    }
}

class StorageAdapter
{
    public function findId($id)
    {
        return ['name' => 'Пользователь 1', 'email' => 'noemail@mail.ru'];
    }
}

class UserMapper
{
    private $adapter;

    public function __construct(StorageAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function findById($id)
    {
        $result = $this->adapter->findId($id);
        if($result === null) {
            throw new \InvalidArgumentException("Пользователь #$id не найден.");
        }
        return $this->mapRowToUser($result);
    }

    public function mapRowToUser(array $row): User
    {
        return User::fromState($row);
    }
}

$mapper = new UserMapper(new StorageAdapter());
$user = $mapper->findById(1);
printArray($user);
