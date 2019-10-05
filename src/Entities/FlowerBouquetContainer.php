<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Entities;


final class FlowerBouquetContainer
{
    private $flowers = [];
    private $bouquetDesigns = [];

    public function addFlower(Flower $flower): void
    {

    }

    public function addBouquetDesign(BouquetDesign $bouquetDesign): void
    {

    }

    public function isFlowerAlreadyInTheContainer(Flower $flower): bool
    {
        return true;
    }
}