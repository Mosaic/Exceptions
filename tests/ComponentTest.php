<?php

namespace Mosaic\Exceptions\Tests;

use Mosaic\Exceptions\Component;
use Mosaic\Exceptions\Providers\BoobooProvider;
use Mosaic\Exceptions\Providers\WhoopsProvider;
use Whoops\Handler\CallbackHandler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;

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

    public function test_can_add_formatters()
    {
        $component = Component::whoops()->formatters(
            $formatter = new PrettyPageHandler
        );

        $this->assertInstanceOf(Component::class, $component);
        $this->assertEquals('whoops', $component->getImplementation());
        $this->assertEquals([new WhoopsProvider([], [$formatter])], $component->getProviders());
    }

    public function test_can_add_handlers()
    {
        $component = Component::whoops()->handlers(
            $handler = new PrettyPageHandler
        );

        $this->assertInstanceOf(Component::class, $component);
        $this->assertEquals('whoops', $component->getImplementation());
        $this->assertEquals([new WhoopsProvider([$handler], [])], $component->getProviders());
    }

    public function test_can_add_callback_handlers()
    {
        $component = Component::whoops()->handlers(
            $handler = function () {}
        );

        $this->assertInstanceOf(Component::class, $component);
        $this->assertEquals('whoops', $component->getImplementation());
        $this->assertEquals([new WhoopsProvider([new CallbackHandler($handler)], [])], $component->getProviders());
    }

    public function test_can_add_callback_formatters()
    {
        $component = Component::whoops()->formatters(
            $formatter = function () {}
        );

        $this->assertInstanceOf(Component::class, $component);
        $this->assertEquals('whoops', $component->getImplementation());
        $this->assertEquals([new WhoopsProvider([], [new CallbackHandler($formatter)], [])], $component->getProviders());
    }

    public function test_can_add_handlers_and_formatters()
    {
        $component = Component::whoops()->handlers(
            $handler = new PrettyPageHandler
        )->formatters(
            $formatter = new PlainTextHandler
        );

        $this->assertInstanceOf(Component::class, $component);
        $this->assertEquals('whoops', $component->getImplementation());
        $this->assertEquals([new WhoopsProvider([$handler], [$formatter])], $component->getProviders());
    }
}
