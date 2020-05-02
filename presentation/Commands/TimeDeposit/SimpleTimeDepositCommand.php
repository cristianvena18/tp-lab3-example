<?php


namespace Presentation\Commands\TimeDeposit;


class SimpleTimeDepositCommand
{
    private string $name;
    private string $surname;
    private float $amount;
    private int $days;

    public function __construct(string $name, string $surname, float $amount, int $days)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->amount = $amount;
        $this->days = $days;
    }

    public function getName(): string {
        return $this->name;
    }
    public function getSurname(): string {
        return $this->surname;
    }
    public function getAmount(): float {
        return $this->amount;
    }
    public function getDays(): int {
        return $this->days;
    }
}
