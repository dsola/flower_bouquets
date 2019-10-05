<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Entities;


final class BouquetDesign
{
    private $name;
    private $flowerSize;
    private $flowers;
    private $totalFlowers;

    private function __construct(BouquetName $name, FlowerSize $flowerSize, array $flowers, int $totalFlowers)
    {
        $this->name = $name;
        $this->flowerSize = $flowerSize;
        $this->flowers = $flowers;
        $this->totalFlowers = $totalFlowers;
    }

    public static function fromLine(string $stringLine): self
    {
        $chars = str_split($stringLine);
        $name = new BouquetName($chars[0]);
        $flowerSize = new FlowerSize($chars[1]);
        $total = self::extractTotal($chars);
        $flowers = self::extractFlowers(
            array_slice($chars, 2, sizeof($chars) - strlen((string)$total) - 1),
            $flowerSize
        );

        return new self($name, $flowerSize, $flowers, $total);
    }

    private static function extractTotal(array $chars): int
    {
        $total = "";
        foreach (array_reverse($chars) as $char) {
            if (!is_numeric($char)) {
                break;
            }
            $total = $char . $total;
        }

        return (int)$total;
    }

    private static function extractFlowers(array $chars, FlowerSize $flowerSize): array
    {
        $flowers = [];

        return $flowers;
    }

    public function name(): string
    {
        return (string)$this->name;
    }

    public function flowerSize(): string
    {
        return (string)$this->flowerSize;
    }

    public function flowers(): array
    {
        return $this->flowers;
    }

    public function totalFlowers(): int
    {
        return $this->totalFlowers;
    }


}