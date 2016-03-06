<?php

namespace Mosaic\Exceptions\Adapters\Booboo;

use League\BooBoo\Runner as BooBoo;
use Mosaic\Exceptions\Runner as RunnerInterface;
use Throwable;

class Runner implements RunnerInterface
{
    /**
     * @var BooBoo
     */
    private $delegate;

    /**
     * @param BooBoo $delegate
     */
    public function __construct(BooBoo $delegate)
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
     * @param Throwable $e
     */
    public function handleException(Throwable $e)
    {
        $this->delegate->exceptionHandler($e);
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
        $this->delegate->pushFormatter($formatter);

        return $this;
    }
}
