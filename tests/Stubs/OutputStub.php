<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Tests\Stubs;


use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class OutputStub implements OutputInterface
{
    private $writtenLines = [];

    public function write($messages, $newline = false, $options = 0)
    {
    }

    public function writeln($messages, $options = 0)
    {
        $this->writtenLines[] = $messages;
    }

    public function setVerbosity($level)
    {
    }

    public function getVerbosity()
    {
    }

    public function isQuiet()
    {
    }


    public function isVerbose()
    {
    }

    public function isVeryVerbose()
    {
    }

    public function isDebug()
    {
    }

    public function setDecorated($decorated)
    {
    }

    public function isDecorated()
    {
    }

    public function setFormatter(OutputFormatterInterface $formatter)
    {
    }

    public function getFormatter()
    {
    }

    public function writtenLines(): array
    {
        return $this->writtenLines;
    }
}