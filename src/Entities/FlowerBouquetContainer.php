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
        $flowerInContainer = $this->getSameFlowerSpecieFromTheContainer($flower);
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

    private function getSameFlowerSpecieFromTheContainer(Flower $flower): ?Flower
    {
        foreach ($this->flowers as $flowerInContainer) {
            if ($flowerInContainer->specie() === $flower->specie()) {
                return $flowerInContainer;
            }
        }

        return null;
    }

    private function replaceFlowerFromSameSpecie(Flower $flower): void
    {
        foreach ($this->flowers as $key => $flowerInContainer) {
            if ($flowerInContainer->specie() === $flower->specie()) {
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