<?php

namespace CrCms\Framework\Http\Commands;

use CrCms\Framework\Swoole\AbstractServerCommand;
use CrCms\Framework\Swoole\Server\Contracts\ServerContract;
use Illuminate\Filesystem\Filesystem;

/**
 * Class ServerCommand
 * @package CrCms\Framework\Http\Commands
 */
class ServerCommand extends AbstractServerCommand
{
    /**
     * @var string
     */
    protected $server = 'http';

    /**
     * @return ServerContract
     */
    public function server(): ServerContract
    {
        $this->cleanRunCache();

        return new \CrCms\Framework\Http\Server(
            $this->getLaravel(),
            config("swoole.servers.{$this->server}"),
            $this->server
        );
    }

    /**
     * @return void
     */
    protected function cleanRunCache(): void
    {
        (new Filesystem())->cleanDirectory(
            dirname($this->getLaravel()->getCachedServicesPath())
        );
    }
}