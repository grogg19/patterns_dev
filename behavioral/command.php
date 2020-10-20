<?php
/**
 *  Паттерн - Команда / Command
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;


interface CommandInterface
{
    public function execute();
}

class Invoker
{
    /**
     * @var CommandInterface
     */
    private $command;

    /**
     * @param mixed $command
     */
    public function setCommand(CommandInterface $cmd)
    {
        $this->command = $cmd;
    }

    public function run()
    {
        $this->command->execute();
    }
}

class Receiver
{
    private $enableDate = false;
    private $output = [];

    public function write(string  $str)
    {
        if($this->enableDate) {
            $str .= '[' . date('Y-m-d H:i:s') . ']';
        }

        $this->output[] = $str;
    }

    public function getOutput()
    {
        return join("\n", $this->output);
    }

    public function enableDate()
    {
        $this->enableDate = true;
    }

    public function disableDate()
    {
        $this->enableDate = false;
    }
}

class HelloCommand implements CommandInterface
{
    /**
     * @var Receiver
     */

    private $output;

    public function __construct(Receiver $console)
    {
        $this->output = $console;
    }

    public function execute()
    {
        $this->output->write("Hello world!");
    }

}

class AddMessageDateCommand implements CommandInterface
{
    /**
     * @var Receiver
     */

    private $output;

    public function __construct(Receiver $console)
    {
        $this->output = $console;
    }

    public function execute()
    {
        $this->output->enableDate();
    }

    public function undo()
    {
        $this->output->disableDate();
    }
}


$invoker = new Invoker();
$receiver = new Receiver();

$invoker->setCommand(new HelloCommand($receiver));
$invoker->run();

printArray($receiver->getOutput() . PHP_EOL);
printArray("#############################" . PHP_EOL);

$messageDateCommand = new AddMessageDateCommand($receiver);
$messageDateCommand->execute();
$invoker->run();
printArray($receiver->getOutput() . PHP_EOL);

printArray("#############################" . PHP_EOL);

$messageDateCommand->undo();
$invoker->run();
printArray($receiver->getOutput() . PHP_EOL);
