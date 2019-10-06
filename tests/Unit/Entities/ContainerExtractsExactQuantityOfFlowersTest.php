<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Unit\Entities;

use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Entities\FlowerBouquetContainer;
use Solaing\FlowerBouquets\Tests\Factories\FlowerFactory;

final class ContainerExtractsExactQuantityOfFlowersTest extends TestCase
{
    public final function test_when_the_bouquet_has_no_flowers() {
        $container = new FlowerBouquetContainer();

        $this->assertEmpty($container->extractExactQuantityFromFlowers(10));
    }

    public final function test_when_flower_has_more_quantity() {
        $container = new FlowerBouquetContainer();
        $flower = FlowerFactory::withQuantity(15);
        $container->addFlower($flower);

        $flowers = $container->extractExactQuantityFromFlowers(10);
        $this->assertEquals(1, sizeof($flowers));
        $flowerInContainer = $container->flowers()[0];
        $this->assertEquals(5, $flowerInContainer->quantity());
    }

    public final function test_when_flower_has_less_quantity() {
        $container = new FlowerBouquetContainer();
        $flower = FlowerFactory::withQuantity(3);
        $container->addFlower($flower);

        $flowers = $container->extractExactQuantityFromFlowers(10);
        $this->assertEquals(1, sizeof($flowers));
        $flowerInContainer = $container->flowers()[0];
        $this->assertEquals(0, $flowerInContainer->quantity());
    }
}