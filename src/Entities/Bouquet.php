<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Entities;


final class Bouquet
{
    private $name;
    private $flowerSize;
    /** @var Flower[] */
    private $flowers;
    /**
     * @var int
     */
    private $totalFlowers;

    public function __construct(BouquetName $name, FlowerSize $flowerSize, array $flowers, int $totalFlowers)
    {
        $this->name = $name;
        $this->flowerSize = $flowerSize;
        $this->flowers = $flowers;
        $this->totalFlowers = $totalFlowers;
    }

    public function name(): BouquetName
    {
        return $this->name;
    }

    public function flowerSize(): FlowerSize
    {
        return $this->flowerSize;
    }

    public function flowers(): array
    {
        return $this->flowers;
    }

    public function totalFlowersLeft(): int
    {
        // TODO: Add tests in entity
        $totalQuantityOfFlowers = array_reduce($this->flowers, function ($totalFlowers, Flower $flower) {
            return $totalFlowers + $flower->quantity();
        });

        return max($this->totalFlowers - $totalQuantityOfFlowers, 0);
    }

    public function addMoreFlowers(array $floers): self
    {
        //TODO: Add tests in entity
        return $this;
    }
}