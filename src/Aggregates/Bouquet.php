<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Aggregates;


use Solaing\FlowerBouquets\Entities\BouquetName;
use Solaing\FlowerBouquets\Entities\Flower;
use Solaing\FlowerBouquets\Entities\BouquetSize;
use Solaing\FlowerBouquets\Exceptions\TooManyFlowersInTheBouquet;

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

    public function __construct(BouquetName $name, BouquetSize $flowerSize, array $flowers, int $totalFlowers)
    {
        $this->name = $name;
        $this->flowerSize = $flowerSize;
        $this->flowers = $flowers;
        $this->totalFlowers = $totalFlowers;
    }

    public function name(): string
    {
        return (string)$this->name;
    }

    public function flowerSize(): BouquetSize
    {
        return $this->flowerSize;
    }

    public function flowers(): array
    {
        return $this->flowers;
    }

    public function totalFlowersLeft(): int
    {
        $totalQuantityOfFlowers = $this->getTotalQuantityOfFlowers($this->flowers);

        return max($this->totalFlowers - $totalQuantityOfFlowers, 0);
    }

    /**
     * @param array $flowers
     * @return $this
     *
     * @throws TooManyFlowersInTheBouquet
     */
    public function addMoreFlowers(array $flowers): self
    {
        $totalQuantityOfFlowers = $this->mergeTotalQuantityOfFlowers($flowers);
        if ($totalQuantityOfFlowers > $this->totalFlowers) {
            throw TooManyFlowersInTheBouquet::withQuantities(
                $this->name(),
                $this->totalFlowers,
                $totalQuantityOfFlowers
            );
        }
        $newBouquet = clone $this;
        $newBouquet->flowers = array_merge($newBouquet->flowers, $flowers);

        return $newBouquet;
    }

    public function render(): string
    {
        $output = $this->name . $this->flowerSize();
        foreach ($this->flowers as $flower) {
            $output .= $flower->render();
        }

        return $output;
    }

    private function getTotalQuantityOfFlowers(array $flowers): int
    {
        if (sizeof($flowers) === 0) {
            return 0;
        }
        return array_reduce($flowers, function ($totalFlowers, Flower $flower) {
            return $totalFlowers + $flower->quantity();
        });
    }


    public function mergeTotalQuantityOfFlowers(array $flowers): int
    {
        return $this->getTotalQuantityOfFlowers($this->flowers) + $this->getTotalQuantityOfFlowers($flowers);
    }
}