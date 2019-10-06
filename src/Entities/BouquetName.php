<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Entities;

use Solaing\FlowerBouquets\Exceptions\InvalidBouquetName;

final class BouquetName
{
    private $name;

    /**
     * @param string $name
     *
     * @throws InvalidBouquetName
     */
    public function __construct(string $name)
    {
        if (!preg_match('/^[A-Z]$/', $name)) {
            throw InvalidBouquetName::fromInvalidName($name);
        }
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}