<?php

namespace Mosaic\Exceptions;

use Mosaic\Common\Components\AbstractComponent;
use Mosaic\Exceptions\Definitions\BoobooDefinition;
use Mosaic\Exceptions\Definitions\WhoopsDefinition;

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
            new WhoopsDefinition()
        ];
    }

    /**
     * @return array
     */
    public function resolveBooboo() : array
    {
        return [
            new BoobooDefinition()
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
