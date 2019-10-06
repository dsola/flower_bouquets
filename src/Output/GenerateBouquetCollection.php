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
    private function __construct()
    {
    }

    /**
     * @param FlowerBouquetContainer $container
     * @return Bouquet[]
     */
    public static function fromContainer(FlowerBouquetContainer $container): array
    {
        /** @var Bouquet[] $bouquets */
        $bouquets = [];
        /** @var BouquetDesign[] $bouquetDesigns */
        $bouquetDesigns = $container->bouquetDesigns();
        foreach ($bouquetDesigns as $bouquetDesign) {
            $bouquets[] = self::generateBouquet($bouquetDesign, $container);
        }

        foreach ($bouquets as $key => $bouquet) {
            $totalFlowersLeft = $bouquet->totalFlowersLeft();
            if ($totalFlowersLeft > 0) {
                $bouquets[$key] = self::refillBouquet($container, $totalFlowersLeft, $bouquet);
            }
        }

        return $bouquets;
    }

    private static function generateBouquet(BouquetDesign $bouquetDesign, FlowerBouquetContainer $container): Bouquet
    {
        $flowersInBouquet = [];
        foreach ($bouquetDesign->flowers() as $flower) {
            $flowerExtracted = $container->extractFlower($flower);
            if (null === $flowerExtracted) {
                continue;
            }
            // Extract the quantity left in the container
            $flowersInBouquet[] = $flower->extractQuantity($flowerExtracted->quantity());
        }

        return new Bouquet(
            new BouquetName($bouquetDesign->name()),
            new FlowerSize($bouquetDesign->flowerSize()),
            $flowersInBouquet,
            $bouquetDesign->totalFlowers()
        );
    }

    private static function refillBouquet(FlowerBouquetContainer $container, int $totalFlowersLeft, Bouquet $bouquet): Bouquet
    {
        $flowersFromContainer = $container->extractExactQuantityOfFlowers($totalFlowersLeft);

        return $bouquet->addMoreFlowers($flowersFromContainer);
    }
}