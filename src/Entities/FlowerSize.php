<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Entities;


use Solaing\FlowerBouquets\Exceptions\InvalidSize;

final class FlowerSize
{
    private const SMALL = 'S';
    private const LARGE = 'L';

    private $size;

    /**
     * @param string $size
     *
     * @throws InvalidSize
     */
    public function __construct(string $size)
    {
        if ($size !== self::LARGE && $size !== self::SMALL) {
            throw InvalidSize::fromSize($size);
        }
        $this->size = $size;
    }

    public function __toString(): string
    {
        return $this->size;
    }
}