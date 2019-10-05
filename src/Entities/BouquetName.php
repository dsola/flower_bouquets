<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Entities;

use Solaing\FlowerBouquets\Exceptions\InvalidBouquetName;

final class BouquetName
{
    private $name;

    public function __construct(string $name)
    {
        if (!preg_match('/^[A-Z]$/', $name)) {
            throw InvalidBouquetName::fromCharacter($name);
        }
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}