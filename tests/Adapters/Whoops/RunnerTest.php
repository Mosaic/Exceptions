<?php

namespace Mosaic\Exceptions\Tests\Adapters\Whoops;

use Mockery\Mock;
use Mosaic\Exceptions\Adapters\Whoops\Runner;
use Whoops\Handler\CallbackHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Whoops\Util\SystemFacade;

class RunnerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Runner
     */
    protected $runner;

    /**
     * @var Mock
     */
    protected $system;

    /**
     * @var Run
     */
    protected $delegate;

    public function setUp()
    {
        $this->system = \Mockery::mock(SystemFacade::class);

        $this->runner = new Runner(
            $this->delegate = new Run($this->system)
        );
    }

    public function test_can_register_exception_handler()
    {
        $this->system->shouldReceive('setErrorHandler')->with([
            $this->delegate,
            'handleError'
        ])->once();

        $this->system->shouldReceive('setExceptionHandler')->with([
            $this->delegate,
            'handleException'
        ])->once();

        $this->system->shouldReceive('registerShutdownFunction')->with([
            $this->delegate,
            'handleShutdown'
        ])->once();

        $this->runner->register();
    }

    public function test_can_handle_exceptions()
    {
        $this->system->shouldReceive('startOutputBuffering')->once();
        $this->system->shouldReceive('cleanOutputBuffer')->once();

        $e = new \Exception();

        $this->runner->handleException($e);
    }

    public function test_can_add_handler()
    {
        $handler = new CallbackHandler(function () {
        });

        $this->assertEquals($this->runner, $this->runner->addHandler($handler));
    }

    public function test_can_add_formatter()
    {
        $formatter = new PrettyPageHandler();

        $this->assertEquals($this->runner, $this->runner->addFormatter($formatter));
    }

    public function tearDown()
    {
        \Mockery::close();
    }
}
