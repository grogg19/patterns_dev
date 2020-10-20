<?php
/**
 * Паттерн Adapter - Адаптер
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

interface SocialNetworkAuth {
    public function auth();
    public function getUserData();
}

class VkAuth implements SocialNetworkAuth
{
    public function auth()
    {
        // Логика авторизации ВК
    }

    public function getUserData()
    {
        // отправляем запросы, получаем данные
    }
}

class InstagramOAuth
{
    public function authByID()
    {
        // Реализация
    }

    public function getUserID()
    {

    }

    public function getPhotos()
    {

    }

    public function getUserInfo()
    {

    }
}

class InstagramAdapter implements SocialNetworkAuth
{
    private $adaptee;

    public function __construct()
    {
        $this->adaptee = new InstagramOAuth();
    }

    public function auth()
    {
        $this->adaptee->authByID($this->adaptee->getUserID());
    }

    public function getUserData()
    {
        $this->adaptee->getUserInfo();
    }
}

function auth(SocialNetworkAuth $provider)
{
    $provider->auth();
}

$instagram = new InstagramAdapter();
auth($instagram);

$vk = new VkAuth();
auth($vk);