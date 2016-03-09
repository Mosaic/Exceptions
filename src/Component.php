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
     * @return array
     */
    public function resolveWhoops() : array
    {
        return [
            new WhoopsProvider()
        ];
    }

    /**
     * @return array
     */
    public function resolveBooboo() : array
    {
        return [
            new BoobooProvider()
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
}
