<?php

namespace Xefi\Faker\NlBe\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\NlBe\Extensions\AddressExtension;

final class AddressExtensionTest extends TestCase
{
    protected AddressExtension $extension;
    protected array $provinces = [];
    protected array $regions = [];
    protected array $cities = [];
    protected array $streetTypes = [];
    protected array $streetNames = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->extension = new AddressExtension(new Randomizer());
        $reflection = new ReflectionClass($this->extension);

        $this->provinces = $reflection->getProperty('provinces')->getValue($this->extension);
        $this->regions = $reflection->getProperty('regions')->getValue($this->extension);
        $this->cities = $reflection->getProperty('cities')->getValue($this->extension);
        $this->streetTypes = $reflection->getProperty('streetTypes')->getValue($this->extension);
        $this->streetNames = $reflection->getProperty('streetNames')->getValue($this->extension);
    }

    public function testRegion(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->regions); $i++) {
            $results[] = $this->faker->unique()->region();
        }

        $this->assertEqualsCanonicalizing(
            $this->regions,
            $results
        );
    }

    public function testProvince(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->provinces); $i++) {
            $results[] = $this->faker->unique()->province();
        }

        $this->assertEqualsCanonicalizing(
            $this->provinces,
            $results
        );
    }

    public function testCity(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->cities); $i++) {
            $results[] = $this->faker->unique()->city();
        }

        $this->assertEqualsCanonicalizing(
            $this->cities,
            $results
        );
    }

    public function testPostcode(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->unique()->postcode();

            $this->assertIsInt($result);
            $this->assertEquals(4, strlen($result));
            $this->assertTrue(
                ($result >= 1000 && $result <= 1299) || ($result >= 1500 && $result <= 3999) || ($result >= 8000 && $result <= 9999),
                "Postcode '{$result}' is outside the Brussels and Flemish ranges."
            );
        }
    }

    public function testHouseNumber(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $result = $this->faker->houseNumber();

            $this->assertIsInt($result);
            $this->assertLessThanOrEqual(300, $result);
            $this->assertGreaterThanOrEqual(1, $result);
        }
    }

    public function testStreetName(): void
    {
        $streets = [];
        foreach ($this->streetNames as $name) {
            foreach ($this->streetTypes as $type) {
                $streets[] = $name.$type;
            }
        }

        for ($i = 0; $i < 100; $i++) {
            $this->assertContains($this->faker->streetName(), $streets);
        }
    }

    public function testStreetAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\p{L}+ \d{1,3}$/u', $this->faker->streetAddress());
        }
    }

    public function testFullAddress(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\p{L}+ \d{1,3}, \d{4} [\p{L} -]+$/u', $this->faker->fullAddress());
        }
    }
}
