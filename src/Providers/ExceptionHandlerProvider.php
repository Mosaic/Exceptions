<?php

namespace Mosaic\Exceptions\Providers;

use Interop\Container\Definition\DefinitionProviderInterface;
use Mosaic\Exceptions\Runner;

abstract class ExceptionHandlerProvider implements DefinitionProviderInterface
{
    /**
     * Returns the definition to register in the container.
     *
     * Definitions must be indexed by their entry ID. For example:
     *
     *     return [
     *         'logger' => ...
     *         'mailer' => ...
     *     ];
     *
     * @return array
     */
    public function getDefinitions()
    {
        $runner = $this->getRunner();

        $runner->register();

        return [
            Runner::class => $runner
        ];
    }

    /**
     * @return Runner
     */
    abstract public function getRunner() : Runner;
}
