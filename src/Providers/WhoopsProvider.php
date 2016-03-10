<?php

namespace Mosaic\Exceptions\Providers;

use Mosaic\Exceptions\Adapters\Whoops\Runner as Adapter;
use Mosaic\Exceptions\Runner;
use Whoops\Handler\PlainTextHandler;
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

        foreach ($this->handlers as $handler) {
            $adapter->addHandler($handler);
        }

        foreach ($this->formatters as $formatter) {
            $adapter->addFormatter($formatter);
        }

        if ($this->needsDefault()) {
            $adapter->addFormatter(new PlainTextHandler);
        }

        return $adapter;
    }

    /**
     * @return bool
     */
    private function needsDefault()
    {
        return count($this->handlers) < 1 && count($this->formatters) < 1;
    }
}
