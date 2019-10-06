<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Unit\Entities;

use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Entities\FlowerBouquetContainer;
use Solaing\FlowerBouquets\Tests\Factories\FlowerFactory;

final class FlowersAreExtractedFromTheContainerTest extends TestCase
{
    public final function test_flower_is_not_extracted_if_is_not_there() {
        $flower1 = FlowerFactory::make("a", "S");
        $flower2 = FlowerFactory::make("b", "L");
        $container = new FlowerBouquetContainer();
        $container->addFlower($flower1);

        $container->extractFlower($flower2);

        $flowerInContainer = $container->flowers()[0];
        $this->assertEquals($flower1->quantity(), $flowerInContainer->quantity());
    }

    public final function test_flower_quantity_is_less_when_flower_is_extracted() {
        $flower1 = FlowerFactory::make("a", "S", 10);
        $flower2 = FlowerFactory::make("a", "S", 7);
        $container = new FlowerBouquetContainer();
        $container->addFlower($flower1);

        $container->extractFlower($flower2);

        $flowerInContainer = $container->flowers()[0];
        $this->assertEquals(3, $flowerInContainer->quantity());
    }

    public final function test_flower_quantity_cannot_be_less_than_0() {
        $flower1 = FlowerFactory::make("a", "S", 10);
        $flower2 = FlowerFactory::make("a", "S", 15);
        $container = new FlowerBouquetContainer();
        $container->addFlower($flower1);

        $container->extractFlower($flower2);

        $flowerInContainer = $container->flowers()[0];
        $this->assertEquals(0, $flowerInContainer->quantity());
    }
}