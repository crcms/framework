<?php

namespace CrCms\Foundation\Swoole\Server\Events;

use App\Modules\Sms\Tasks\TestTask;
use CrCms\Foundation\Swoole\Server\AbstractServer;
use CrCms\Foundation\Swoole\Server\Contracts\EventContract;
use CrCms\Foundation\Swoole\Server\Contracts\TaskContract;

/**
 * Class TaskEvent
 * @package CrCms\Foundation\Swoole\Server\Events
 */
class TaskEvent extends AbstractEvent implements EventContract
{
    /**
     * @var int
     */
    protected $taskId;

    /**
     * @var int
     */
    protected $workId;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * TaskEvent constructor.
     * @param int $taskId
     * @param int $workerId
     * @param mixed $data
     */
    public function __construct(int $taskId, int $workerId, $data)
    {
        $this->taskId = $taskId;
        $this->workId = $workerId;
        $this->data = $data;
    }

    /**
     * @param AbstractServer $server
     */
    public function handle(AbstractServer $server): void
    {
        parent::handle($server); // TODO: Change the autogenerated stub

        /* @var TaskContract $object */
        $object = $this->data['object'];
        /* @var array $params */
        $params = $this->data['params'];

        $this->server->finish($object->handle(...$params));
    }
}