<?php

namespace Mosaic\Exceptions\Providers;

use Mosaic\Exceptions\Adapters\Whoops\Runner as Adapter;
use Mosaic\Exceptions\Runner;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class WhoopsProvider extends ExceptionHandlerProvider
{
    /**
     * @return Runner
     */
    public function getRunner() : Runner
    {
        $adapter = new Adapter(
            new Run
        );

        $adapter->addFormatter(new PrettyPageHandler);

        return $adapter;
    }
}
