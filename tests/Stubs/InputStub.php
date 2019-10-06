<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Stubs;

use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\StreamableInputInterface;

final class InputStub implements StreamableInputInterface
{
    private $stream;

    public function setStream($stream)
    {
        $this->stream = $stream;
    }

    public function getStream()
    {
        return $this->stream;
    }

    public function getFirstArgument()
    {
    }

    public function hasParameterOption($values, $onlyParams = false)
    {
    }

    public function getParameterOption($values, $default = false, $onlyParams = false)
    {
    }


    public function bind(InputDefinition $definition)
    {
    }

    public function validate()
    {
    }

    public function getArguments()
    {
    }

    public function getArgument($name)
    {
    }

    public function setArgument($name, $value)
    {
    }

    public function hasArgument($name)
    {
    }

    public function getOptions()
    {
    }

    public function getOption($name)
    {
    }

    public function setOption($name, $value)
    {
    }

    public function hasOption($name)
    {
    }

    public function isInteractive()
    {
    }

    public function setInteractive($interactive)
    {
    }
}