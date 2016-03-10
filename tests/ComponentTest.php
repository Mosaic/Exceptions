<?php

namespace Mosaic\Exceptions\Tests;

use Mosaic\Exceptions\Component;
use Mosaic\Exceptions\Providers\BoobooProvider;
use Mosaic\Exceptions\Providers\WhoopsProvider;

class ComponentTest extends \PHPUnit_Framework_TestCase
{
    public function test_can_resolve_booboo()
    {
        $component = Component::booboo();

        $this->assertInstanceOf(Component::class, $component);
        $this->assertEquals('booboo', $component->getImplementation());
        $this->assertEquals([new BoobooProvider()], $component->getProviders());
    }

    public function test_can_resolve_whoops()
    {
        $component = Component::whoops();

        $this->assertInstanceOf(Component::class, $component);
        $this->assertEquals('whoops', $component->getImplementation());
        $this->assertEquals([new WhoopsProvider()], $component->getProviders());
    }

    public function test_can_resolve_custom()
    {
        Component::extend('customExceptionHandler', function () {
            return [
                new WhoopsProvider()
            ];
        });

        $component = Component::customExceptionHandler();

        $this->assertInstanceOf(Component::class, $component);
        $this->assertEquals('customExceptionHandler', $component->getImplementation());
        $this->assertEquals([new WhoopsProvider()], $component->getProviders());
    }
}
