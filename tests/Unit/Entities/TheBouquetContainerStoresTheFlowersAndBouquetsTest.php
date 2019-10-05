<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Unit\Entities;

use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Entities\Flower;
use Solaing\FlowerBouquets\Entities\FlowerBouquetContainer;
use Solaing\FlowerBouquets\Tests\Factories\BouquetDesignFactory;
use Solaing\FlowerBouquets\Tests\Factories\FlowerFactory;

final class TheBouquetContainerStoresTheFlowersAndBouquetsTest extends TestCase
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

    final public function test_the_container_increases_the_quantity_of_flowers_if_the_specie_is_there() {
        $flower1 = FlowerFactory::make();
        $flower2 = FlowerFactory::make($flower1->specie());
        $container = new FlowerBouquetContainer();

        $container->addFlower($flower1);
        $container->addFlower($flower2);

        /** @var Flower $flower */
        $flower = $container->flowers()[0];
        $this->assertEquals($flower1->quantity() + 1, $flower->quantity());
    }

    final public function test_the_container_NOT_increase_the_quantity_if_the_specie_is_NOT_there() {
        $flower1 = FlowerFactory::make("a");
        $flower2 = FlowerFactory::make("b");
        $container = new FlowerBouquetContainer();

        $container->addFlower($flower1);
        $container->addFlower($flower2);

        /** @var Flower $flower */
        $flower = $container->flowers()[0];
        $this->assertEquals($flower1->quantity(), $flower->quantity());
    }
}