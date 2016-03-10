<?php

namespace Mosaic\Exceptions\Providers;

use League\BooBoo\Formatter\HtmlFormatter;
use League\BooBoo\Runner as BooBoo;
use Mosaic\Exceptions\Adapters\Booboo\Runner as Adapter;
use Mosaic\Exceptions\Runner;

class BoobooProvider extends ExceptionHandlerProvider
{
    /**
     * @return Runner
     */
    public function getRunner() : Runner
    {
        $adapter = new Adapter(
            new BooBoo($this->formatters, $this->handlers)
        );

        if ($this->needsDefault()) {
            $adapter->addFormatter(new HtmlFormatter);
        }

        return $adapter;
    }

    /**
     * @return bool
     */
    private function needsDefault()
    {
        return count($this->formatters) < 1;
    }
}
