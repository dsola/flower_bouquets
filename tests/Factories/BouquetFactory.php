<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Tests\Factories;


use Faker\Factory;
use Solaing\FlowerBouquets\Aggregates\Bouquet;
use Solaing\FlowerBouquets\Entities\BouquetName;
use Solaing\FlowerBouquets\Entities\Flower;
use Solaing\FlowerBouquets\Entities\FlowerSize;

final class BouquetFactory
{
    public static function build(string $name, string $size, array $flowers, int $totalOfFlowers): Bouquet
    {
        return new Bouquet(
            new BouquetName(strtoupper($name)),
            new FlowerSize($size),
            $flowers,
            $totalOfFlowers
        );
    }

    /**
     * @param Flower[] $flowers
     * @param int $totalOfFlowers
     * @return Bouquet
     */
    public static function buildWithFlowers(array $flowers, int $totalOfFlowers): Bouquet
    {
        $faker = Factory::create();

        return new Bouquet(
            new BouquetName(strtoupper($faker->randomLetter)),
            new FlowerSize($faker->randomElement(['S', 'L'])),
            $flowers,
            $totalOfFlowers
        );
    }

    public static function buildWithNameAndSize(string $name, string $size): Bouquet
    {
        return new Bouquet(
            new BouquetName($name),
            new FlowerSize($size),
            [],
            0
        );
    }
}