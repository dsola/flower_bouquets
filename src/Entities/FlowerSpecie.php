<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Entities;

use Solaing\FlowerBouquets\Exceptions\InvalidFlowerSpecie;

final class FlowerSpecie
{
    private $name;

    public function __construct(string $name)
    {
        if (!preg_match('/^[a-z]$/', $name)) {
            throw InvalidFlowerSpecie::fromCharacter($name);
        }
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}