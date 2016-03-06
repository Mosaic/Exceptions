<?php

namespace Mosaic\Exceptions\Definitions;

use League\BooBoo\Runner as BooBoo;
use Mosaic\Exceptions\Adapters\Booboo\Runner as Adapter;
use Mosaic\Exceptions\Runner;

class BoobooDefinition extends ExceptionHandlerDefinition
{
    /**
     * @return Runner
     */
    public function getRunner() : Runner
    {
        return new Adapter(
            new BooBoo([
                new \League\BooBoo\Formatter\HtmlFormatter()
            ])
        );
    }
}
