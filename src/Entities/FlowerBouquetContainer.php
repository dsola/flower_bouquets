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
        foreach ($this->flowers as $key => $flowerInContainer) {
            if ($flowerInContainer->isSameAs($flower)) {
                return $this->extractQuantityFromFlower($flowerInContainer, $flower->quantity(), $key);
            }
        }

        return null;
    }

    /**
     * @param int $quantity
     * @return Flower[]
     */
    public function extractExactQuantityOfFlowers(int $quantity): array
    {
        $flowersToReturn = [];
        $quantityLeft = $quantity;
        foreach ($this->flowers as $key => $flowerInContainer) {
            if ($quantityLeft === 0) {
                break;
            }
            if ($flowerInContainer->quantity() === 0) {
                continue;
            }

            $quantityToExtract = $this->calculateExactQuantityToExtract($quantityLeft, $flowerInContainer);
            $this->extractQuantityFromFlower($flowerInContainer, $quantityToExtract, $key);
            $flowersToReturn[] = new Flower(
                new FlowerSpecie($flowerInContainer->specie()),
                new FlowerSize($flowerInContainer->size()),
                $quantityToExtract
            );
            $quantityLeft = max($quantityLeft - $flowerInContainer->quantity(), 0);
        }

        return $flowersToReturn;
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

    /**
     * @return Flower[]
     */
    public function flowers(): array
    {
        return $this->flowers;
    }

    public function bouquetDesigns(): array
    {
        return $this->bouquetDesigns;
    }

    public function extractQuantityFromFlower(Flower $flowerInContainer, int $quantity, int $key): Flower
    {
        $flowerWithQuantityExtracted = $flowerInContainer->extractQuantity($quantity);
        $this->flowers[$key] = $flowerWithQuantityExtracted;

        return $flowerWithQuantityExtracted;
    }

    public function calculateExactQuantityToExtract(int $quantityLeft, Flower $flowerInContainer): int
    {
        $quantityToExtract = $quantityLeft;
        if ($quantityToExtract > $flowerInContainer->quantity()) {
            $quantityToExtract = $flowerInContainer->quantity();
        }

        return $quantityToExtract;
    }
}