<?php

namespace Mosaic\Exceptions\Definitions;

use Mosaic\Exceptions\Adapters\Whoops\Runner as Adapter;
use Mosaic\Exceptions\Runner;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class WhoopsDefinition extends ExceptionHandlerDefinition
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
