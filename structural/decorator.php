<?php
/**
 * Паттерн Декоратор - Decorator
 */

interface Booking
{
    public function calculatePrice(): int;
    public function getDescription(): string;
}

abstract class BookingDecorator implements Booking
{
    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }
}

class DoubleRoomBooking implements Booking
{
    public function calculatePrice(): int
    {
        return 40;
    }

    public function getDescription(): string
    {
        return "Номер на двоих";
    }
}

class Wifi extends BookingDecorator
{
    private const PRICE = 2;
    public function calculatePrice(): int
    {
        return $this->booking->calculatePrice() + self::PRICE;
    }

    public function getDescription(): string
    {
        return $this->booking->getDescription() . ", есть WIFI";
    }
}

class UnlimitedJuiceRefrigirator extends BookingDecorator
{
    private const PRICE = 100;
    public function calculatePrice(): int
    {
        return $this->booking->calculatePrice() + self::PRICE;
    }

    public function getDescription(): string
    {
        return $this->booking->getDescription() . ', бесконечный компот';
    }
}

class UnlimitedPornoChannels extends BookingDecorator
{
    private const PRICE = 250;
    public function calculatePrice(): int
    {
        return $this->booking->calculatePrice() + self::PRICE;
    }

    public function getDescription(): string
    {
        return $this->booking->getDescription(). ', безлимитная порнуха';
    }
}

// клиентский код

$booking = new Wifi(new DoubleRoomBooking());
$booking1 = new Wifi(new UnlimitedPornoChannels(new DoubleRoomBooking()));

echo $booking->getDescription() . '  всего за ' . $booking->calculatePrice() . '<br>';
echo $booking1->getDescription() . '  всего за ' . $booking1->calculatePrice() . '<br>';