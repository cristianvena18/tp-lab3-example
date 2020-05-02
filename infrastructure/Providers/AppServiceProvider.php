<?php

namespace Infrastructure\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Cache\Provider\Redis\RedisProvider;
use Infrastructure\Hash\HashManager;
use Infrastructure\Hash\HashManagerInterface;
use Psr\Cache\CacheItemPoolInterface;
use Redis;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HashManagerInterface::class, HashManager::class);

        $this->app->singleton(Redis::class, function (Application $application) {
            $client = new Redis();

            $config = $application->make('config')->get('database.redis.cache');

            if (! $client->connect($config['host'], (int) $config['port'])) {
                throw new \Exception("Could not connect to Redis at {$config['host']}:{$config['port']}");
            }

            return $client;
        });
        $this->app->bind(CacheItemPoolInterface::class, RedisProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
