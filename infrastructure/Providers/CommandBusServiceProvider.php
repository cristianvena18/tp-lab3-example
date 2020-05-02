<?php
declare(strict_types=1);

namespace Infrastructure\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Infrastructure\CommandBus\CommandBus;
use Infrastructure\CommandBus\CommandBusInterface;
use Infrastructure\CommandBus\Handler\CommandNameExtractor\CommandNameExtractor;
use Infrastructure\CommandBus\Handler\Locator\HandlerInstanceResolver;
use Infrastructure\CommandBus\Handler\Locator\InferableLocator;
use Infrastructure\CommandBus\Handler\MethodNameInflector\HandleInflector;
use League\Tactician\Handler\CommandHandlerMiddleware;

class CommandBusServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(
            CommandBusInterface::class,
            static function (Application $application) {
                $handlerMiddleware = new CommandHandlerMiddleware(
                    new CommandNameExtractor(),
                    new InferableLocator(new HandlerInstanceResolver($application)),
                    new HandleInflector()
                );

                return new CommandBus([$handlerMiddleware]);
            }
        );
    }
}
