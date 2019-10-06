<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Exceptions;


final class TooManyFlowersInTheBouquet extends \InvalidArgumentException
{
    public static function withQuantities(string $bouquetName, int $expected, int $actual): self
    {
        return new self("The Bouquet $bouquetName can contain only $expected flowers, but received $actual.");
    }
}