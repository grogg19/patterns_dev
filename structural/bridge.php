<?php
/**
 * Паттерн Bridge - Мост
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

interface Formatter
{
    public function format($text): string;
}

abstract class Service
{
    protected $formatter;

    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    public function setFormatter(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    abstract public function get();
}

class HtmlFormatter implements Formatter
{
    public function format($text): string
    {
        return '<h1>' . $text . '</h1>';
    }
}

class PlainTextFormatter implements Formatter
{
    public function format($text): string
    {
        return $text;
    }
}

class JsonFormatter implements Formatter
{
    public function format($text): string
    {
        return json_encode($text);
    }
}

class HelloWorldService extends Service
{
    public function get()
    {
        return $this->formatter->format("Hello world");
    }
}

$service = new HelloWorldService(new PlainTextFormatter());
echo $service->get() . "</br>";

$service->setFormatter(new HtmlFormatter());
echo $service->get() . '</br>';

$service->setFormatter(new JsonFormatter());
echo $service->get() .'<br>';
