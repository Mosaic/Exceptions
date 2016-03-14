<?php

namespace Mosaic\Exceptions;

use Mosaic\Common\Components\AbstractComponent;
use Mosaic\Exceptions\Providers\BoobooProvider;
use Mosaic\Exceptions\Providers\WhoopsProvider;
use Whoops\Handler\CallbackHandler;

/**
 * @method static $this whoops()
 * @method static $this booboo()
 */
final class Component extends AbstractComponent
{
    /**
     * @var array
     */
    protected $handlers = [];

    /**
     * @var array
     */
    protected $formatters = [];

    /**
     * @return array
     */
    public function resolveWhoops() : array
    {
        foreach ($this->formatters as $key => $formatter) {
            if (is_callable($formatter)) {
                $this->formatters[$key] = new CallbackHandler($formatter);
            }
        }

        foreach ($this->handlers as $key => $handler) {
            if (is_callable($handler)) {
                $this->handlers[$key] = new CallbackHandler($handler);
            }
        }

        return [
            new WhoopsProvider($this->handlers, $this->formatters)
        ];
    }

    /**
     * @return array
     */
    public function resolveBooboo() : array
    {
        return [
            new BoobooProvider($this->handlers, $this->formatters)
        ];
    }

    /**
     * @param  callable $callback
     * @return array
     */
    public function resolveCustom(callable $callback) : array
    {
        return $callback();
    }

    /**
     * @param mixed ...$handlers
     * @return $this
     */
    public function handlers(...$handlers)
    {
        $this->handlers = $handlers;

        return $this;
    }

    /**
     * @param mixed ...$formatters
     * @return $this
     */
    public function formatters(...$formatters)
    {
        $this->formatters = $formatters;

        return $this;
    }
}
