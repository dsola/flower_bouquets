<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Entities;


final class Flower
{
    private $specie;
    private $size;
    private $quantity;

    private function __construct(string $specie, FlowerSize $size, int $quantity)
    {
        $this->specie = $specie;
        $this->size = $size;
        $this->quantity = $quantity;
    }

    public static function fromLine(string $stringLine): self
    {
        $chars = str_split($stringLine);

        return new self($chars[0], new FlowerSize($chars[1]), 1);
    }

    public function specie(): string
    {
        return $this->specie;
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