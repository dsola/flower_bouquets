<?php
declare(strict_types=1);


namespace Solaing\FlowerBouquets\Tests\Integration;


use PHPUnit\Framework\TestCase;
use Solaing\FlowerBouquets\GenerateBouquets;
use Solaing\FlowerBouquets\Input\GenerateFlowerBouquetContainer;
use Solaing\FlowerBouquets\Tests\Stubs\InputStub;
use Solaing\FlowerBouquets\Tests\Stubs\OutputStub;

final class TheFlowerBouquetsAreGeneratedInTheOutputTest extends TestCase
{
    private $output;
    private $input;

    public function setUp(): void
    {
        parent::setUp();
        $this->output = new OutputStub();
        $this->input = new InputStub();
    }

    public final function test_the_flower_bouquets_title_is_generated() {
        $filePath = __DIR__ . '/../resources/empty_file.txt';
        $this->input->setStream(fopen($filePath, 'r'));
        (new GenerateBouquets($this->input, $this->output))->exec();

        $writtenLines = $this->output->writtenLines();
        $this->assertContains("----- Flower Bouquets ---", $writtenLines);
    }

    public function tearDown(): void
    {
        unset($this->output);
        parent::tearDown();
    }
}