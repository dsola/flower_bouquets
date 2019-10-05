<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Tests;


use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\GenerateBouquets;
use Solaing\FlowerBouquets\Tests\Stubs\OutputStub;

final class TheFlowerBouquetIsGeneratedInTheOutput extends TestCase
{
    private $output;

    public function setUp(): void
    {
        parent::setUp();
        $this->output = new OutputStub();
    }

    public final function test_the_flower_bouquets_title_is_generated() {
        (new GenerateBouquets($this->output))->exec(__DIR__. '/resources/empty_file.txt');

        $writtenLines = $this->output->writtenLines();
        $this->assertContains("----- Flower Bouquets ---", $writtenLines);
    }

    public function tearDown(): void
    {
        unset($this->output);
        parent::tearDown();
    }
}