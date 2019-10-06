<?php
declare(strict_types=1);

namespace Solaing\FlowerBouquets\Tests\Unit\Output;

use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\Entities\FlowerBouquetContainer;
use Solaing\FlowerBouquets\Output\GenerateBouquetCollection;
use Solaing\FlowerBouquets\Tests\Factories\BouquetDesignFactory;
use Solaing\FlowerBouquets\Tests\Factories\FlowerFactory;

final class BouquetCollectionHasBeenGeneratedProperlyTest extends TestCase
{
    public final function test_bouquet_collection_is_empty_when_the_container_does_not_have_bouquet_designs() {
        $container = new FlowerBouquetContainer();

        $collection = GenerateBouquetCollection::fromContainer($container);

        $this->assertEmpty($collection);
    }

    public final function test_bouquet_has_the_same_design_name_and_size() {
        $bouquetDesign = BouquetDesignFactory::make();
        $container = new FlowerBouquetContainer;
        $container->addBouquetDesign($bouquetDesign);

        $collection = GenerateBouquetCollection::fromContainer($container);

        $bouquet = $collection[0];
        $this->assertEquals($bouquetDesign->name(), $bouquet->name());
        $this->assertEquals($bouquetDesign->flowerSize(), $bouquet->flowerSize());
    }

    public final function test_bouquet_is_created_with_bouquet_design_and_exactly_same_flowers() {
        $flower1 = FlowerFactory::make("a", "S", 10);
        $flower2 = FlowerFactory::make("b", "S", 15);
        $flower3 = FlowerFactory::make("c", "S", 10);
        $flowers = [ $flower1, $flower2, $flower3 ];
        $bouquetDesign = BouquetDesignFactory::make($flowers, 35);
        $container = new FlowerBouquetContainer;
        $container->addFlower($flower1);
        $container->addFlower($flower2);
        $container->addFlower($flower3);
        $container->addBouquetDesign($bouquetDesign);

        $collection = GenerateBouquetCollection::fromContainer($container);

        $bouquet = $collection[0];
        $this->assertEquals($flowers, $bouquet->flowers());
        $this->assertEquals(0, $bouquet->totalFlowersLeft());
    }

    public final function test_bouquet_collection_is_created_with_bouquet_design_and_exactly_same_flowers() {
        $flower1 = FlowerFactory::make("a", "S", 10);
        $flower2 = FlowerFactory::make("b", "S", 15);
        $flower3 = FlowerFactory::make("c", "S", 10);
        $flowers = [ $flower1, $flower2, $flower3 ];
        $bouquetDesign = BouquetDesignFactory::make($flowers, 35);
        $container = new FlowerBouquetContainer;
        $container->addFlower($flower1);
        $container->addFlower($flower2);
        $container->addFlower($flower3);
        $container->addBouquetDesign($bouquetDesign);

        $collection = GenerateBouquetCollection::fromContainer($container);

        $bouquet = $collection[0];
        $this->assertEquals($flowers, $bouquet->flowers());
        $this->assertEquals(0, $bouquet->totalFlowersLeft());
    }

    public final function test_bouquet_collection_is_refilled_with_flowers_not_included_in_the_design() {
        $flower1 = FlowerFactory::make("a", "S", 10);
        $flower2 = FlowerFactory::make("b", "S", 15);
        $flower3 = FlowerFactory::make("c", "S", 5);
        $flower4 = FlowerFactory::make("z", "S", 5);
        $flowers = [ $flower1, $flower2, $flower3 ];
        $bouquetDesign = BouquetDesignFactory::make($flowers, 35);
        $container = (new FlowerBouquetContainer);
        $container->addFlower($flower1);
        $container->addFlower($flower2);
        $container->addFlower($flower3);
        $container->addFlower($flower4);
        $container->addBouquetDesign($bouquetDesign);

        $collection = GenerateBouquetCollection::fromContainer($container);

        $bouquet = $collection[0];
        $this->assertEquals([ $flower1, $flower2, $flower3, $flower4 ], $bouquet->flowers());
        $this->assertEquals(0, $bouquet->totalFlowersLeft());
    }

    public final function test_bouquet_is_refilled_but_still_some_flowers_left() {
        $flower1 = FlowerFactory::make("a", "S", 10);
        $flower2 = FlowerFactory::make("b", "S", 15);
        $flower3 = FlowerFactory::make("c", "S", 5);
        $flower4 = FlowerFactory::make("z", "S", 2);
        $flowers = [ $flower1, $flower2, $flower3 ];
        $bouquetDesign = BouquetDesignFactory::make($flowers, 35);
        $container = (new FlowerBouquetContainer);
        $container->addFlower($flower1);
        $container->addFlower($flower2);
        $container->addFlower($flower3);
        $container->addFlower($flower4);
        $container->addBouquetDesign($bouquetDesign);

        $collection = GenerateBouquetCollection::fromContainer($container);

        $bouquet = $collection[0];
        $this->assertEquals(3, $bouquet->totalFlowersLeft());
    }

    public final function test_bouquet_is_refilled_with_any_flower_from_design() {
        $flower1 = FlowerFactory::make("a", "S", 10);
        $flower2 = FlowerFactory::make("b", "S", 15);
        $flower3 = FlowerFactory::make("c", "S", 5);
        $flower4 = FlowerFactory::make("z", "S", 2);
        $flowers = [ $flower1, $flower2 ];
        $bouquetDesign = BouquetDesignFactory::make($flowers, 35);
        $container = (new FlowerBouquetContainer);
        $container->addFlower($flower3);
        $container->addFlower($flower4);
        $container->addBouquetDesign($bouquetDesign);

        $collection = GenerateBouquetCollection::fromContainer($container);

        $bouquet = $collection[0];
        $this->assertEquals([ $flower3, $flower4 ], $bouquet->flowers());
        $this->assertEquals(28, $bouquet->totalFlowersLeft());
    }

    public final function test_bouquet_collection_from_multiple_bouquet_designs() {
        $flower1 = FlowerFactory::make("a", "S", 10);
        $flower2 = FlowerFactory::make("b", "S", 15);
        $flower3 = FlowerFactory::make("c", "S", 5);
        $flower4 = FlowerFactory::make("z", "S", 2);
        $flower5 = FlowerFactory::make("i", "S", 8);

        $bouquetDesign1 = BouquetDesignFactory::make([ $flower1, $flower3 ], 15);
        $bouquetDesign2 = BouquetDesignFactory::make([ $flower2, $flower4 ], 25);

        $container = (new FlowerBouquetContainer);
        $container->addFlower($flower1);
        $container->addFlower($flower2);
        $container->addFlower($flower3);
        $container->addFlower($flower4);
        $container->addFlower($flower5);

        $container->addBouquetDesign($bouquetDesign1);
        $container->addBouquetDesign($bouquetDesign2);


        $collection = GenerateBouquetCollection::fromContainer($container);

        $bouquet1 = $collection[0];
        $this->assertEquals([ $flower1, $flower3 ], $bouquet1->flowers());
        $this->assertEquals(0, $bouquet1->totalFlowersLeft());
        $bouquet2 = $collection[1];
        $this->assertEquals([ $flower2, $flower4, $flower5 ], $bouquet2->flowers());
        $this->assertEquals(0, $bouquet2->totalFlowersLeft());
    }
}