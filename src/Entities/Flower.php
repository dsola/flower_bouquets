<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Entities;


final class Flower
{
    private $specie;
    private $size;
    private $quantity;

    public function __construct(FlowerSpecie $specie, FlowerSize $size, int $quantity)
    {
        $this->specie = $specie;
        $this->size = $size;
        $this->quantity = $quantity;
    }

    public static function fromLine(string $stringLine): self
    {
        $chars = str_split($stringLine);

        return new self(new FlowerSpecie($chars[0]), new FlowerSize($chars[1]), 1);
    }

    public function increaseQuantity(): self {
        $newFlower = clone $this;
        ++$newFlower->quantity;

        return $newFlower;
    }

    public function specie(): string
    {
        return (string)$this->specie;
    }

    public function size(): string
    {
        return (string)$this->size;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }
}