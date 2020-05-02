<?php


namespace Presentation\ValueObjects;


class TimeDeposit
{
    public function __construct($amount, $interest, $days)
    {

    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
