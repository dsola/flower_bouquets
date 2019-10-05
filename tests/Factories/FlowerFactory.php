<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Factories;

use Faker\Factory;
use Solaing\FlowerBouquets\Entities\Flower;
use Solaing\FlowerBouquets\Entities\FlowerSize;
use Solaing\FlowerBouquets\Entities\FlowerSpecie;

final class FlowerFactory
{
    public static function make(string $specie = null, string $size = null, int $quantity = null): Flower
    {
        $faker = Factory::create();

        return new Flower(
            new FlowerSpecie($specie ?? strtolower($faker->randomLetter)),
            new FlowerSize($size ?? $faker->randomElement(["S", "L"])),
            $quantity ?? random_int(1, 200)
        );
    }
}