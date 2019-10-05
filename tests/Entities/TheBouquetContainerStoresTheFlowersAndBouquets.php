<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Entities;

use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Entities\FlowerBouquetContainer;
use Solaing\FlowerBouquets\Tests\Factories\BouquetDesignFactory;
use Solaing\FlowerBouquets\Tests\Factories\FlowerFactory;

final class TheBouquetContainerStoresTheFlowersAndBouquets extends TestCase
{
    final public function test_the_container_adds_flowers() {
        $flower = FlowerFactory::make();
        $container = new FlowerBouquetContainer();

        $container->addFlower($flower);

        $this->assertEquals($flower, $container->flowers()[0]);
    }

    final public function test_the_container_adds_bouquet_designs() {
        $bouquetDesign = BouquetDesignFactory::make();
        $container = new FlowerBouquetContainer();

        $container->addBouquetDesign($bouquetDesign);

        $this->assertEquals($bouquetDesign, $container->bouquetDesigns()[0]);
    }

    final public function test_the_container_knows_if_a_flower_specie_is_there() {
        $flower1 = FlowerFactory::make();
        $flower2 = FlowerFactory::make($flower1->specie());
        $container = new FlowerBouquetContainer();

        $container->addFlower($flower1);

        $this->assertTrue($container->isFlowerSpecieAlreadyInTheContainer($flower2));
    }

    final public function test_the_container_knows_if_a_flower_specie_is_NOT_there() {
        $flower1 = FlowerFactory::make("a");
        $flower2 = FlowerFactory::make("b");
        $container = new FlowerBouquetContainer();

        $container->addFlower($flower1);

        $this->assertFalse($container->isFlowerSpecieAlreadyInTheContainer($flower2));
    }
}