<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Entities;


use Solaing\FlowerBouquets\Exceptions\InvalidBouquetSize;

final class BouquetSize
{
    private $size;

    /**
     * @param string $size
     *
     * @throws InvalidBouquetSize
     */
    public function __construct(string $size)
    {
        if (!preg_match('/^(S|L)$/', $size)) {
            throw InvalidBouquetSize::fromCharacter($size);
        }
        $this->size = $size;
    }

    public function __toString(): string
    {
        return $this->size;
    }
}