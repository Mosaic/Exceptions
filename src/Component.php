<?php

namespace Mosaic\Exceptions;

use Mosaic\Common\Components\AbstractComponent;
use Mosaic\Exceptions\Providers\BoobooProvider;
use Mosaic\Exceptions\Providers\WhoopsProvider;

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
