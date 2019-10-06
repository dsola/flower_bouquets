<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Tests\Unit\Aggregates;


use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Exceptions\TooManyFlowersInTheBouquet;
use Solaing\FlowerBouquets\Tests\Factories\BouquetFactory;
use Solaing\FlowerBouquets\Tests\Factories\FlowerFactory;

final class BouquetCanBeCompletelyFilledTest extends TestCase
{
    public final function test_bouquet_has_the_same_flowers_if_we_add_empty_collection() {
        $bouquet = BouquetFactory::buildWithFlowers([
            FlowerFactory::make(null, null, 1),
            FlowerFactory::make(null, null, 2),
            FlowerFactory::make(null, null, 3)
        ], 10);

        $newBouquet = $bouquet->addMoreFlowers([]);

        $this->assertEquals(3, sizeof($newBouquet->flowers()));
    }

    public final function test_bouquet_has_more_flowers_when_we_add_more() {
        $bouquet = BouquetFactory::buildWithFlowers([
            FlowerFactory::make(null, null, 1),
            FlowerFactory::make(null, null, 1),
            FlowerFactory::make(null, null, 2)
        ], 10);

        $newBouquet = $bouquet->addMoreFlowers([
            FlowerFactory::make(null, null, 1),
            FlowerFactory::make(null, null, 1),
            FlowerFactory::make(null, null,3)
        ]);

        $this->assertEquals(6, sizeof($newBouquet->flowers()));
    }

    public final function test_bouquet_not_allow_to_have_more_flowers_than_total() {
        $bouquet = BouquetFactory::buildWithFlowers([
            FlowerFactory::make(null, null, 1),
            FlowerFactory::make(null, null, 1),
            FlowerFactory::make(null, null, 2)
        ], 10);

        $this->expectException(TooManyFlowersInTheBouquet::class);

        $newBouquet = $bouquet->addMoreFlowers([
            FlowerFactory::make(null, null, 1),
            FlowerFactory::make(null, null, 1),
            FlowerFactory::make(null, null,25)
        ]);
    }
}