<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Factories;

use Faker\Factory;
use Solaing\FlowerBouquets\Entities\Flower;
use Solaing\FlowerBouquets\Entities\FlowerSize;
use Solaing\FlowerBouquets\Entities\FlowerSpecie;

final class FlowerFactory
{
    public static function make(string $specie = null): Flower
    {
        $faker = Factory::create();

        return new Flower(
            new FlowerSpecie($specie ?? strtolower($faker->randomLetter)),
            new FlowerSize($faker->randomElement(["S", "L"])),
            random_int(1, 200)
        );
    }
}