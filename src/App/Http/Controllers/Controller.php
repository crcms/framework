<?php

namespace CrCms\Foundation\App\Http\Controllers;

use CrCms\Foundation\App\Helpers\InstanceConcern;
use CrCms\Foundation\App\Services\ResponseFactory;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use InvalidArgumentException;

/**
 * @property-read ResponseFactory $response
 *
 * Class Controller
 * @package CrCms\Foundation\App\Http\Controllers
 */
class Controller extends BaseController
{
    use InstanceConcern, AuthorizesRequests, ValidatesRequests {
        __get as __instanceGet;
    }

    /**
     * @var
     */
    protected $repository;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return ResponseFactory
     */
    protected function response(): ResponseFactory
    {
        return app(ResponseFactory::class);
    }

    /**
     * @param string $name
     * @return ResponseFactory
     */
    public function __get(string $name)
    {
        if ($name === 'response') {
            return $this->response();
        }

        if ((bool)$instance = $this->__instanceGet($name)) {
            return $instance;
        }

        throw new InvalidArgumentException("Property not found [{$name}]");
    }
}

