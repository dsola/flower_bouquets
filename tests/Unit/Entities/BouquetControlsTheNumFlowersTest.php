<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Tests\Unit\Entities;


use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Tests\Factories\BouquetFactory;
use Solaing\FlowerBouquets\Tests\Factories\FlowerFactory;

final class BouquetControlsTheNumFlowersTest extends TestCase
{
    public final function test_when_there_are_no_flowers() {
        $bouquet = BouquetFactory::buildWithFlowers([], 10);

        $this->assertEquals(10, $bouquet->totalFlowersLeft());
    }

    public final function test_when_the_are_some_flowers_left() {
        $bouquet = BouquetFactory::buildWithFlowers([
            FlowerFactory::make("a", "S", 2),
            FlowerFactory::make("b", "S", 1),
            FlowerFactory::make("s", "S", 3)
        ], 10);

        $this->assertEquals(4, $bouquet->totalFlowersLeft());
    }

    public final function test_when_there_are_no_flowers_left() {
        $bouquet = BouquetFactory::buildWithFlowers([
            FlowerFactory::make("a", "S", 2),
            FlowerFactory::make("b", "S", 1),
            FlowerFactory::make("s", "S", 7)
        ], 10);

        $this->assertEquals(0, $bouquet->totalFlowersLeft());
    }

    public final function test_cannot_be_less_than_0_flowers_left() {
        $bouquet = BouquetFactory::buildWithFlowers([
            FlowerFactory::make("a", "S", 2),
            FlowerFactory::make("b", "S", 4),
            FlowerFactory::make("s", "S", 7)
        ], 10);

        $this->assertEquals(0, $bouquet->totalFlowersLeft());
    }
}