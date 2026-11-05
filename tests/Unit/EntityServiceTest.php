<?php

namespace Tests\Unit;

use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EntityServiceTest extends TestCase
{
    public function test_calculate_total_price()
    {
        $this->assertSame(3001.0, calculateTotalPrice(1500.50, 2));
    }

    public function test_calculate_total_price_rejects_invalid_quantity()
    {
        $this->expectException(InvalidArgumentException::class);

        calculateTotalPrice(100.0, 0);
    }

    public function test_apply_discount()
    {
        $this->assertEquals(850.0, applyDiscount(1000, 15));
        $this->assertEquals(1000.0, applyDiscount(1000, 0));
        $this->assertEquals(0.0, applyDiscount(1000, 100));
    }

    public function test_apply_discount_throws_exception_for_invalid_value()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Неприпустиме значення знижки!');

        applyDiscount(1000, 150);
    }

    public function test_apply_discount_throws_exception_for_negative_value()
    {
        $this->expectException(Exception::class);

        applyDiscount(1000, -5);
    }

    public function test_is_available()
    {
        $this->assertTrue(isAvailable(12, 5));
        $this->assertTrue(isAvailable(5, 5));
        $this->assertFalse(isAvailable(3, 5));
        $this->assertFalse(isAvailable(10, 0));
    }
}
