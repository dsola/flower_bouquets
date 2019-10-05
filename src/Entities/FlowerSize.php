<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Entities;


use Solaing\FlowerBouquets\Exceptions\InvalidFlowerSize;

final class FlowerSize
{
    private $size;

    /**
     * @param string $size
     *
     * @throws InvalidFlowerSize
     */
    public function __construct(string $size)
    {
        if (!preg_match('/^(S|L)$/', $size)) {
            throw InvalidFlowerSize::fromCharacter($size);
        }
        $this->size = $size;
    }

    public function __toString(): string
    {
        return $this->size;
    }
}