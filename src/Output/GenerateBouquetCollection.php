<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Output;

use Solaing\FlowerBouquets\Entities\Bouquet;
use Solaing\FlowerBouquets\Entities\BouquetDesign;
use Solaing\FlowerBouquets\Entities\BouquetName;
use Solaing\FlowerBouquets\Entities\FlowerBouquetContainer;
use Solaing\FlowerBouquets\Entities\FlowerSize;

final class GenerateBouquetCollection
{
    public function fromContainer(FlowerBouquetContainer $container): array
    {
        /** @var Bouquet[] $bouquets */
        $bouquets = [];
        /** @var BouquetDesign[] $bouquetDesigns */
        $bouquetDesigns = $container->bouquetDesigns();
        foreach ($bouquetDesigns as $bouquetDesign) {
            $bouquets[] = $this->generateBouquet($bouquetDesign, $container);
        }

        foreach ($bouquets as $key => $bouquet) {
            $totalFlowersLeft = $bouquet->totalFlowersLeft();
            if ($totalFlowersLeft > 0) {
                $bouquets[$key] = $this->refillBouquet($container, $totalFlowersLeft, $bouquet);
            }
        }

        return $bouquets;
    }

    private function generateBouquet(BouquetDesign $bouquetDesign, FlowerBouquetContainer $container): Bouquet
    {
        $flowersInBouquet = [];
        foreach ($bouquetDesign->flowers() as $flower) {
            $flower = $container->extractFlower($flower);
            if (null === $flower) {
                continue;
            }
            $flowersInBouquet[] = $flower;
        }

        return new Bouquet(
            new BouquetName($bouquetDesign->name()),
            new FlowerSize($bouquetDesign->flowerSize()),
            $flowersInBouquet,
            $bouquetDesign->totalFlowers()
        );
    }

    public function refillBouquet(FlowerBouquetContainer $container, int $totalFlowersLeft, Bouquet $bouquet): Bouquet
    {
        $flowersFromContainer = $container->getFlowersWithExactQuantity($totalFlowersLeft);

        return $bouquet->addMoreFlowers($flowersFromContainer);
    }
}