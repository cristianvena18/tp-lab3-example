<?php


namespace Presentation\Services\TimeDeposit;


use App\Exceptions\CommandInvalidException;
use Presentation\Commands\TimeDeposit\CompoundTimeDepositCommand;
use Presentation\Commands\TimeDeposit\SimpleTimeDepositCommand;
use Presentation\Results\TimeDeposit\TimeDepositResult;
use Presentation\ValueObjects\TimeDeposit;

class TimeDepositService
{
    /**
     * @param $command
     * @return TimeDepositResult
     * @throws CommandInvalidException
     */
    public function CalculateSimpleAndCompound($command) {
        if($command instanceof SimpleTimeDepositCommand)
        {
            return $this->CalculateSimpleTimeDeposit($command);
        }
        else if($command instanceof CompoundTimeDepositCommand)
        {
            return $this->CalculateCompoundTimeDeposit($command);
        }
        else
        {
            throw new CommandInvalidException("El command ingresado no es valido");
        }
    }

    private function CalculateSimpleTimeDeposit(SimpleTimeDepositCommand $command)
    {
        $days = $command->getDays();
        $amount = $command->getAmount();
        $timeDeposit = $this->CalculateTimeDeposit($amount, $days);
        $name = $command->getName();
        $surname = $command->getSurname();

        return new TimeDepositResult("$name $surname", [$timeDeposit]);
    }

    private function CalculateCompoundTimeDeposit(CompoundTimeDepositCommand $command)
    {
        $days = $command->getDays();

        $timeDeposits = [$this->CalculateTimeDeposit(
            $command->getAmount(),
            $days)];

        for ($i = 1; $i < 4; $i++) {
            $timeDeposits[] = $this->CalculateTimeDeposit(
                $timeDeposits[$i-1]->getAmount(),
                $days);
        }

        $name = $command->getName();
        $surname = $command->getSurname();

        return new TimeDepositResult("$name $surname", $timeDeposits);
    }

    private function CalculateTimeDeposit($amount, $days)
    {
        $interest = $this->getPercentageFromCountDays($days);
        $amountWithInterest = $amount + ($amount * ($interest / 100) * $days / 360);

        return new TimeDeposit($amountWithInterest, $interest, $days);
    }

    private function getPercentageFromCountDays(int $days): float {
        if($days < 60) {
            return 40;
        }
        else if ($days < 120) {
            return 45;
        }
        else if ($days < 360) {
            return 50;
        }
        else {
            return 60;
        }
    }
}
