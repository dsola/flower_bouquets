<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Unit\Aggregates;

use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Aggregates\FlowerBouquetContainer;
use Solaing\FlowerBouquets\Tests\Factories\FlowerFactory;

final class ContainerExtractsExactQuantityOfFlowersTest extends TestCase
{
    public final function test_when_the_bouquet_has_no_flowers() {
        $container = new FlowerBouquetContainer();

        $this->assertEmpty($container->extractExactQuantityOfFlowers(10));
    }

    public final function test_when_flower_has_more_quantity() {
        $container = new FlowerBouquetContainer();
        $flower = FlowerFactory::withQuantity(15);
        $container->addFlower($flower);

        $flowers = $container->extractExactQuantityOfFlowers(10);
        $this->assertEquals(1, sizeof($flowers));
        $flowerInContainer = $container->flowers()[0];
        $this->assertEquals(5, $flowerInContainer->quantity());
    }

    public final function test_when_flower_has_less_quantity() {
        $container = new FlowerBouquetContainer();
        $flower = FlowerFactory::withQuantity(3);
        $container->addFlower($flower);

        $flowers = $container->extractExactQuantityOfFlowers(10);
        $this->assertEquals(1, sizeof($flowers));
        $flowerInContainer = $container->flowers()[0];
        $this->assertEquals(0, $flowerInContainer->quantity());
    }

    public final function test_flowers_with_quantity_0_are_not_included() {
        $container = new FlowerBouquetContainer();
        $flower1 = FlowerFactory::withQuantity(0);
        $flower2 = FlowerFactory::withQuantity(5);
        $container->addFlower($flower1);
        $container->addFlower($flower2);

        $flowers = $container->extractExactQuantityOfFlowers(10);
        $this->assertEquals(1, sizeof($flowers));
    }

    public final function test_extracted_flower_has_the_quantity_requested() {
        $container = new FlowerBouquetContainer();
        $flower1 = FlowerFactory::withQuantity(10);
        $container->addFlower($flower1);

        $flowers = $container->extractExactQuantityOfFlowers(5);
        $flowerExtracted = $flowers[0];
        $this->assertEquals(5, $flowerExtracted->quantity());
    }
}