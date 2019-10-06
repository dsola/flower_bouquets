<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Entities;


final class BouquetDesign
{
    private $name;
    private $bouquetSize;
    private $flowers;
    private $totalFlowers;

    public function __construct(BouquetName $name, BouquetSize $bouquetSize, array $flowers, int $totalFlowers)
    {
        $this->name = $name;
        $this->bouquetSize = $bouquetSize;
        $this->flowers = $flowers;
        $this->totalFlowers = $totalFlowers;
    }

    public static function fromLine(string $stringLine): self
    {
        $chars = str_split($stringLine);
        $name = new BouquetName($chars[0]);
        $flowerSize = new BouquetSize($chars[1]);
        $total = self::extractLastNumberOccurrence($chars);
        $numOfDigitsInTotal = strlen((string)$total);
        $flowerCharsSize = sizeof($chars) - 2 - $numOfDigitsInTotal;
        $flowers = self::extractFlowers(
            array_slice($chars, 2, $flowerCharsSize),
            $flowerSize
        );

        return new self($name, $flowerSize, $flowers, $total);
    }

    private static function extractFlowers(array $chars, BouquetSize $flowerSize): array
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

    public function name(): string
    {
        return (string)$this->name;
    }

    public function bouquetSize(): string
    {
        return (string)$this->bouquetSize;
    }

    /**
     * @return Flower[]
     */
    public function flowers(): array
    {
        return $this->flowers;
    }

    public function totalFlowers(): int
    {
        return $this->totalFlowers;
    }

    private static function extractFirstNumberOccurrence(array $chars): int
    {
        $total = "";
        foreach ($chars as $char) {
            if (!is_numeric($char)) {
                break;
            }
            $total =  $total . $char;
        }

        return (int)$total;
    }

    private static function extractLastNumberOccurrence(array $chars): int
    {
        $total = "";
        foreach (array_reverse($chars) as $char) {
            if (!is_numeric($char)) {
                break;
            }
            $total =  $char . $total;
        }

        return (int)$total;
    }
}