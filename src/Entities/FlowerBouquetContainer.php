<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Entities;


final class FlowerBouquetContainer
{
    /** @var Flower[] */
    private $flowers = [];
    /** @var BouquetDesign[] */
    private $bouquetDesigns = [];

    public function addFlower(Flower $flower): void
    {
        $flowerInContainer = $this->getSameFlowerFromTheContainer($flower);
        if ($flowerInContainer === null) {
            $this->flowers[] = $flower;
        } else {
            $newFlowerInContainer = $flowerInContainer->increaseQuantity();

            $this->replaceFlowerFromSameSpecie($newFlowerInContainer);
        }
    }

    public function addBouquetDesign(BouquetDesign $bouquetDesign): void
    {
        $this->bouquetDesigns[] = $bouquetDesign;
    }

    public function containsFlower(Flower $flower): bool
    {
        $flower = $this->getSameFlowerFromTheContainer($flower);

        return $flower !== null && $flower->quantity() > 0;
    }

    public function extractFlower(Flower $flower): ?Flower
    {
        //TODO: Add tests
        foreach ($this->flowers as $key => $flowerInContainer) {
            if ($flowerInContainer->isSameAs($flower)) {
                $flowerWithQuantityExtracted = $flowerInContainer->extractQuantity($flower->quantity());
                $this->flowers[$key] = $flowerWithQuantityExtracted;

                return $flowerWithQuantityExtracted;
            }
        }

        return null;
    }


    public function getFlowersWithExactQuantity(int $quantity): array
    {
        //TODO: Return flowers that sums the exact quantity
        return [];
    }

    private function getSameFlowerFromTheContainer(Flower $flower): ?Flower
    {
        foreach ($this->flowers as $flowerInContainer) {
            if ($flowerInContainer->isSameAs($flower)) {
                return $flowerInContainer;
            }
        }

        return null;
    }

    private function replaceFlowerFromSameSpecie(Flower $flower): void
    {
        foreach ($this->flowers as $key => $flowerInContainer) {
            if ($flowerInContainer->isSameAs($flower)) {
                $this->flowers[$key] = $flower;
                return;
            }
        }
    }

    public function flowers(): array
    {
        return $this->flowers;
    }

    public function bouquetDesigns(): array
    {
        return $this->bouquetDesigns;
    }
}