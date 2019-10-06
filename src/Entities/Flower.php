<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Entities;


final class Flower
{
    private $specie;
    private $bouquetSize;
    private $quantity;

    public function __construct(FlowerSpecie $specie, BouquetSize $size, int $quantity)
    {
        $this->specie = $specie;
        $this->bouquetSize = $size;
        $this->quantity = $quantity;
    }

    public static function fromLine(string $stringLine): self
    {
        $chars = str_split($stringLine);

        return new self(new FlowerSpecie($chars[0]), new BouquetSize($chars[1]), 1);
    }

    public function increaseQuantity(): self {
        $newFlower = clone $this;
        ++$newFlower->quantity;

        return $newFlower;
    }

    public function extractQuantity(int $quantity): self {
        $newFlower = clone $this;

        if ($newFlower->quantity() < $quantity) {
            $newFlower->quantity = 0;
        } else {
            $newFlower->quantity = $newFlower->quantity - $quantity;
        }

        return $newFlower;
    }

    public function specie(): string
    {
        return (string)$this->specie;
    }

    public function bouquetSize(): string
    {
        return (string)$this->bouquetSize;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function isSameAs(Flower $flower): bool
    {
        return $this->specie() === $flower->specie() && $this->bouquetSize() === $flower->bouquetSize();
    }

    public function render(): string
    {
        return $this->specie() . $this->quantity();
    }
}