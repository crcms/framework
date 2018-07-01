<?php

/**
 * @author simon <crcms@crcms.cn>
 * @datetime 2018/6/28 20:42
 * @link http://crcms.cn/
 * @copyright Copyright &copy; 2018 Rights Reserved CRCMS
 */

namespace CrCms\Foundation\Client;

use CrCms\Foundation\Client\ConnectionFactory;
use CrCms\Foundation\Client\ConnectionManager;
use CrCms\Foundation\Client\ConnectionPool;
use CrCms\Foundation\Client\Contracts\ConnectionPool as ConnectionPoolContract;
use CrCms\Foundation\Client\Contracts\Selector;
use CrCms\Foundation\Client\Selectors\RandSelector;
use Illuminate\Support\ServiceProvider;

/**
 * Class ClientServiceProvider
 * @package CrCms\Foundation\Client
 */
class ClientServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = false;

    /**
     *
     */
    public function register()
    {
        $this->registerAlias();

        $this->registerConnectionServices();
    }

    /**
     *
     */
    protected function registerConnectionServices()
    {
        $this->app->singleton('client.factory', function ($app) {
            return new ConnectionFactory($app);
        });

        $this->app->singleton('client.selector', $this->app['config']->get('client.selector', RandSelector::class));

        $this->app->singleton('client.pool', function ($app) {
            return new ConnectionPool($app['client.selector']);
        });

        $this->app->singleton('client.manager', function ($app) {
            return new ConnectionManager($app, $app->make('client.factory'), $app->make('client.pool'));
        });
    }

    /**
     *
     */
    protected function registerAlias()
    {
        $this->app->alias('client.selector', Selector::class);
        $this->app->alias('client.factory', ConnectionFactory::class);
        $this->app->alias('client.pool', ConnectionPoolContract::class);
        $this->app->alias('client.manager', ConnectionManager::class);
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        /*return [
            'client.selector',
            'client.factory',
            'client.pool',
            'client.manager'
        ];*/
        return parent::provides();
    }
}