<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets;

use Solaing\FlowerBouquets\Input\GenerateFlowerBouquetContainer;
use Solaing\FlowerBouquets\Output\GenerateBouquetCollection;
use Symfony\Component\Console\Input\StreamableInputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class GenerateBouquets
{
    private $output;
    /**
     * @var StreamableInputInterface
     */
    private $input;

    public function __construct(StreamableInputInterface $input, OutputInterface $output) {
        $this->output = $output;
        $this->input = $input;
    }

    public function exec(): void
    {
        $container = GenerateFlowerBouquetContainer::fromResource($this->input->getStream());

        $bouquets = GenerateBouquetCollection::fromContainer($container);

        $this->output->writeln("-------------------------");
        $this->output->writeln("----- Flower Bouquets ---");
        $this->output->writeln("-------------------------");
        foreach ($bouquets as $bouquet) {
            $this->output->writeln($bouquet->render());
        }
    }

}