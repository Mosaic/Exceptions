<?php

namespace Mosaic\Exceptions\Formatters;

use Mosaic\Contracts\Application;
use Mosaic\Contracts\Exceptions\ExceptionFormatter;
use Mosaic\Exceptions\ErrorResponse;
use Throwable;

class SmartFormatter implements ExceptionFormatter
{
    /**
     * @var HtmlFormatter
     */
    private $formatter;

    /**
     * @var WhoopsFormatter
     */
    private $whoops;

    /**
     * @var Application
     */
    private $app;

    /**
     * EnvBasedWhoopsFormatter constructor.
     *
     * @param Application     $app
     * @param WhoopsFormatter $whoops
     * @param HtmlFormatter   $formatter
     */
    public function __construct(Application $app, WhoopsFormatter $whoops, HtmlFormatter $formatter)
    {
        $this->formatter = $formatter;
        $this->whoops    = $whoops;
        $this->app       = $app;
    }

    /**
     * @param Throwable $e
     *
     * @return ErrorResponse
     */
    public function render(Throwable $e) : ErrorResponse
    {
        if ($this->app->isLocal()) {
            return $this->whoops->render($e);
        } else {
            return $this->formatter->render($e);
        }
    }
}
