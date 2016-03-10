<?php

namespace Mosaic\Exceptions\Tests\Providers;

use Interop\Container\Definition\DefinitionProviderInterface;
use Mosaic\Exceptions\Providers\WhoopsProvider;
use Mosaic\Exceptions\Runner;

class WhoopsProviderTest extends \PHPUnit_Framework_TestCase
{
    public function getDefinition() : DefinitionProviderInterface
    {
        return new WhoopsProvider();
    }

    public function shouldDefine() : array
    {
        return [
            Runner::class
        ];
    }

    public function test_defines_all_required_contracts()
    {
        $definitions = $this->getDefinition()->getDefinitions();
        foreach ($this->shouldDefine() as $define) {
            $this->assertArrayHasKey($define, $definitions);
        }
    }
}
