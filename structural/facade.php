<?php
/**
 * Паттерн Фасад - Facade
 */

interface OsInterface
{
    public function halt();
    public function getName(): string ;
}

interface BiosInterface
{
    public function execute();
    public function waitForKeyPress();
    public function launch(OsInterface $os);
    public function powerDown();
}

class Facade
{
    private $os;
    private $bios;

    public function __construct(BiosInterface $bios, OsInterface $os)
    {
        $this->bios = $bios;
        $this->os = $os;
    }

    public function turnOn()
    {
        $this->bios->execute();
        $this->bios->waitForKeyPress();
        $this->bios->launch($this->os);
    }

    public function turnOff()
    {
        $this->os->halt();
        $this->bios->powerDown();
    }
}