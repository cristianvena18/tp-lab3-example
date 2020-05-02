<?php


namespace Presentation\Http\Actions\TimeDeposit;


use App\Exceptions\CommandInvalidException;
use App\Exceptions\InvalidBodyException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Presentation\Http\Adapters\TimeDepositAdapter;
use Presentation\Services\TimeDeposit\TimeDepositService;

class TimeDepositAction
{
    private TimeDepositAdapter $adapter;
    private TimeDepositService $service;

    public function __construct(
        TimeDepositAdapter $adapter,
        TimeDepositService $service
    )
    {
        $this->adapter = $adapter;
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return View
     * @throws CommandInvalidException
     */
    public function __invoke(Request $request): View
    {
        try {
            $command = $this->adapter->from($request);

            $result = $this->service->CalculateSimpleAndCompound($command);

            return view('resultTimeDeposit')->with($result);
        } catch (InvalidBodyException $e) {
            redirect()->back()->withErrors($e->getMessages());
        } catch (CommandInvalidException $e) {
            throw $e;
        }
    }
}
