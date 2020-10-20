<?php
/**
 *  Паттерн - Наблюдатель / Observer
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

interface Observer
{
    public function update($subject);

}

abstract class Subject
{
    protected $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    public function attach(Observer $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(Observer $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

class User extends Subject
{
    private $email;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function changeEmail($email)
    {
        $this->email = $email;
        $this->notify();
    }
}

class UserEmailServer implements Observer
{
    public function update($subject)
    {
        echo "Обновлены данные пользователя, посылаем уведомления на " . $subject->getEmail() . PHP_EOL;
    }
}

$user = new User();
$user->attach(new UserEmailServer());

$user->changeEmail("new_email@gmail.com");
