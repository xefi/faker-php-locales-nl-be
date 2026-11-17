<?php

namespace Xefi\Faker\NlBe\Tests\Unit;

final class PhoneExtensionTest extends TestCase
{
    public function testPhoneNumberReturnsString(): void
    {
        $number = $this->faker->phoneNumber();

        $this->assertIsString($number);
        $this->assertNotEmpty($number);
    }

    public function testPhoneNumberFormat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^0[1-9]\d{7,8}$/', $this->faker->phoneNumber());
        }
    }

    public function testCellPhoneNumberFormat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^04[6-9]\d{7}$/', $this->faker->cellPhoneNumber());
        }
    }

    public function testLandlinePhoneNumberFormat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^0[1-35-9]\d{7}$/', $this->faker->landlinePhoneNumber());
        }
    }

    public function testIndicatoredPhoneNumberFormat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^\+32[1-9]\d{7,8}$/', $this->faker->indicatoredPhoneNumber());
        }
    }

    public function testSpacedCellPhoneNumberFormat(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $this->assertMatchesRegularExpression('/^04[6-9]\d \d{2} \d{2} \d{2}$/', $this->faker->spacedCellPhoneNumber());
        }
    }
}
