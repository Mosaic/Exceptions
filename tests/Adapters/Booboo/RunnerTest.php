<?php

namespace Mosaic\Exceptions\Tests\Adapters\Booboo;

use League\BooBoo\Formatter\HtmlFormatter;
use League\BooBoo\Handler\LogHandler;
use League\BooBoo\Runner as Booboo;
use Mockery\Mock;
use Mosaic\Exceptions\Adapters\Booboo\Runner;
use Psr\Log\NullLogger;

class RunnerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Runner
     */
    protected $runner;

    /**
     * @var Mock
     */
    protected $delegate;

    public function setUp()
    {
        $this->runner = new Runner(
            $this->delegate = \Mockery::mock(Booboo::class)
        );
    }

    public function test_can_register_exception_handler()
    {
        $this->delegate->shouldReceive('register')->once();

        $this->runner->register();
    }

    public function test_can_handle_exceptions()
    {
        $e = new \Exception();

        $this->delegate->shouldReceive('exceptionHandler')->with($e)->once();

        $this->runner->handleException($e);
    }

    public function test_can_add_handler()
    {
        $handler = new LogHandler(new NullLogger);

        $this->delegate->shouldReceive('pushHandler')->with($handler)->once();

        $this->assertEquals($this->runner, $this->runner->addHandler($handler));
    }

    public function test_can_add_formatter()
    {
        $formatter = new HtmlFormatter;

        $this->delegate->shouldReceive('pushFormatter')->with($formatter)->once();

        $this->assertEquals($this->runner, $this->runner->addFormatter($formatter));
    }

    public function tearDown()
    {
        \Mockery::close();
    }
}
