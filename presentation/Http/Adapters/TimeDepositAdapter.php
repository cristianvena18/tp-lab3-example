<?php


namespace Presentation\Http\Adapters;


use App\Exceptions\InvalidBodyException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Presentation\Commands\TimeDeposit\CompoundTimeDepositCommand;
use Presentation\Commands\TimeDeposit\SimpleTimeDepositCommand;

class TimeDepositAdapter
{
    private $rules = [
        'name' => 'bail|required|alpha|min:3',
        'surname' => 'bail|required|alpha|min:3',
        'amount' => 'bail|number|required',
        'days' => 'bail|integer|required|min:30',
        'compound' => 'bail|required|boolean'
    ];

    private $messages = [
      'name.required' => 'El nombre es requerido',
      'name.alpha' => 'Che pelotudo el nombre es alfabetico'
    ];

    /**
     * @param Request $request
     * @throws InvalidBodyException
     */
    public function from(Request $request)
    {
        $make = Validator::make($request->all(), $this->rules, $this->messages);

        if($make->fails())
        {
            throw new InvalidBodyException($make->errors()->all());
        }

        $compound = $request->input('compound');

        if($compound)
        {
            return new SimpleTimeDepositCommand(
                $request->input('name'),
                $request->input('surname'),
                $request->input('amount'),
                $request->input('days')
            );
        }
        else
        {
            return new CompoundTimeDepositCommand(
                $request->input('name'),
                $request->input('surname'),
                $request->input('amount'),
                $request->input('days')
            );
        }
    }
}
