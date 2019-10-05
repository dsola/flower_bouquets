<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets;

use Solaing\FlowerBouquets\Input\GenerateFlowerBouquetContainer;
use Symfony\Component\Console\Output\OutputInterface;

final class GenerateBouquets
{
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var GenerateFlowerBouquetContainer
     */
    private $generateFlowerBouquetContainer;

    public function __construct(OutputInterface $output, GenerateFlowerBouquetContainer $generateFlowerBouquetContainer)
    {
        $this->output = $output;
        $this->generateFlowerBouquetContainer = $generateFlowerBouquetContainer;
    }

    public function exec(string $filePath): void
    {
        $container = $this->generateFlowerBouquetContainer->fromFilePath($filePath);

        $this->output->writeln("-------------------------");
        $this->output->writeln("----- Flower Bouquets ---");
        $this->output->writeln("-------------------------");
    }

}