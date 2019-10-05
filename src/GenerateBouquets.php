<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets;

use Symfony\Component\Console\Output\OutputInterface;

final class GenerateBouquets
{
    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public function exec(string $filePath): void
    {
        $this->processFile($filePath);

        $this->output->writeln("-------------------------");
        $this->output->writeln("----- Flower Bouquets ---");
        $this->output->writeln("-------------------------");
    }

    /**
     * @param string $filePath
     */
    public function processFile(string $filePath): void
    {
        $fn = fopen($filePath, "r");

        while (!feof($fn)) {
            $result = fgets($fn);
        }

        fclose($fn);
    }
}