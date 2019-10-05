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
        $this->flowers[] = $flower;
    }

    public function addBouquetDesign(BouquetDesign $bouquetDesign): void
    {
        $this->bouquetDesigns[] = $bouquetDesign;
    }

    public function isFlowerSpecieAlreadyInTheContainer(Flower $flower): bool
    {
        foreach ($this->flowers as $flowerInContainer) {
            if ($flowerInContainer->specie() === $flower->specie()) {
                return true;
            }
        }

        return false;
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