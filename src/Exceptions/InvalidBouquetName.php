<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Exceptions;


final class InvalidBouquetName extends \InvalidArgumentException
{
    public static function fromInvalidName(string $name): self
    {
        return new self("The bouquet name '$name'' is invalid");
    }
}