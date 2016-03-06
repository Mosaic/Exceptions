<?php

namespace Mosaic\Exceptions;

use Throwable;

interface Runner
{
    /**
     * Registers the error handlers
     * @return mixed
     */
    public function register();

    /**
     * @param $handler
     * @return Runner
     */
    public function addHandler($handler);

    /**
     * @param $formatter
     * @return Runner
     */
    public function addFormatter($formatter);

    /**
     * @param Throwable $e
     */
    public function handleException(Throwable $e);
}
