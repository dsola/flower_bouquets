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
        $total = self::extractFirstNumberOccurrence(array_reverse($chars));
        $numOfDigitsInTotal = strlen((string)$total);
        $flowerCharsSize = sizeof($chars) - 2 - $numOfDigitsInTotal;
        $flowers = self::extractFlowers(
            array_slice($chars, 2, $flowerCharsSize),
            $flowerSize
        );

        return new self($name, $flowerSize, $flowers, $total);
    }

    private static function extractFlowers(array $chars, FlowerSize $flowerSize): array
    {
        $flowers = [];

        while (sizeof($chars) > 0) {
            $flowerQuantity = self::extractFirstNumberOccurrence($chars);
            $chars = array_slice($chars, strlen((string)$flowerQuantity));
            $flowerSpecie = array_shift($chars);
            $flowers[] = new Flower(
                new FlowerSpecie($flowerSpecie),
                $flowerSize,
                $flowerQuantity
            );
        }

        return $flowers;
    }

    private static function extractFirstNumberOccurrence(array $chars): int
    {
        $total = "";
        foreach ($chars as $char) {
            if (!is_numeric($char)) {
                break;
            }
            $total = $char . $total;
        }

        return (int)$total;
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