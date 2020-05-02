<?php
declare(strict_types=1);

namespace Infrastructure\QueryBus;

use Infrastructure\QueryBus\Query\QueryInterface;
use Infrastructure\QueryBus\Result\ResultInterface;

interface QueryBusInterface
{
    /**
     * Execute the given query and return a result
     * @param QueryInterface $query
     * @return ResultInterface
     */
    public function handle(QueryInterface $query): ResultInterface;
}
