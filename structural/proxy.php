<?php
/**
 * Паттерн Прокси - Proxy
 */

interface Balance
{
    public function getBalance();
}

class BankAccount implements Balance
{
    public function getBalance()
    {
        sleep(2); // Имитируем запрос
        return 100;
    }
}

class BankAccountProxy extends BankAccount implements Balance
{
    protected $balance;

    public function getBalance()
    {
        if(!is_null($this->balance)) {
            return $this->balance;
        }
        return $this->balance = parent::getBalance();
    }
}


$bankAccount = new BankAccount();

echo date('H:i:s') . ' - ' . $bankAccount->getBalance() . ' - ' . date('H:i:s') . '<br>';
echo date('H:i:s') . ' - ' . $bankAccount->getBalance() . ' - ' . date('H:i:s') . '<br>';

$bankAccount = new BankAccountProxy();
echo date('H:i:s') . ' - ' . $bankAccount->getBalance() . ' - ' . date('H:i:s') . '<br>';
echo date('H:i:s') . ' - ' . $bankAccount->getBalance() . ' - ' . date('H:i:s') . '<br>';