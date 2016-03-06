<?php

namespace Mosaic\Exceptions\Adapters\Whoops;

use Mosaic\Exceptions\Runner as RunnerInterface;
use Throwable;
use Whoops\Run;

class Runner implements RunnerInterface
{
    /**
     * @var Run
     */
    private $delegate;

    /**
     * Runner constructor.
     * @param Run $delegate
     */
    public function __construct(Run $delegate)
    {
        $this->delegate = $delegate;
    }

    /**
     * Registers the error handlers
     * @return mixed
     */
    public function register()
    {
        $this->delegate->register();
    }

    /**
     * @param $handler
     * @return RunnerInterface
     */
    public function addHandler($handler)
    {
        $this->delegate->pushHandler($handler);

        return $this;
    }

    /**
     * @param $formatter
     * @return RunnerInterface
     */
    public function addFormatter($formatter)
    {
        $this->delegate->pushHandler($formatter);

        return $this;
    }

    /**
     * @param Throwable $e
     */
    public function handleException(Throwable $e)
    {
        $this->delegate->handleException($e);
    }
}
