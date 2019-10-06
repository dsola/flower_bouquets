<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Tests\Factories;


use Faker\Factory;
use Solaing\FlowerBouquets\Entities\BouquetDesign;
use Solaing\FlowerBouquets\Entities\BouquetName;
use Solaing\FlowerBouquets\Entities\FlowerSize;

final class BouquetDesignFactory
{
    public static function make(array $flowers = null, int $quantity = null): BouquetDesign
    {
        $faker = Factory::create();
        return new BouquetDesign(
            new BouquetName(strtoupper($faker->randomLetter)),
            new FlowerSize($faker->randomElement(['S', 'L'])),
            $flowers ?? self::generateFlowers(),
            $quantity ?? random_int(1, 200)
        );
    }

    private static function generateFlowers() {
        $flowers = [];
        $numOfInstances = random_int(1, 5);
        while ($numOfInstances > 0) {
            $flowers[] = FlowerFactory::make();
            --$numOfInstances;
        }

        return $flowers;
    }
}