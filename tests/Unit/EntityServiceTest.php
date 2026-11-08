<?php

namespace Tests\Unit;

use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EntityServiceTest extends TestCase
{
    public function test_calculate_lesson_duration()
    {
        $this->assertSame(80, calculateLessonDuration('08:30', '09:50'));
        $this->assertSame(90, calculateLessonDuration('10:10', '11:40'));
    }

    public function test_calculate_lesson_duration_rejects_wrong_format()
    {
        $this->expectException(InvalidArgumentException::class);

        calculateLessonDuration('8:30', '09:50');
    }

    public function test_calculate_lesson_duration_rejects_end_before_start()
    {
        $this->expectException(InvalidArgumentException::class);

        calculateLessonDuration('10:00', '09:00');
    }

    public function test_is_room_suitable()
    {
        $this->assertTrue(isRoomSuitable(30, 25));
        $this->assertTrue(isRoomSuitable(25, 25));
        $this->assertFalse(isRoomSuitable(20, 25));
        $this->assertFalse(isRoomSuitable(30, 0));
    }

    public function test_calculate_room_occupancy()
    {
        $this->assertEquals(75.0, calculateRoomOccupancy(30, 40));
        $this->assertEquals(0.0, calculateRoomOccupancy(0, 40));
        $this->assertEquals(100.0, calculateRoomOccupancy(40, 40));
    }

    public function test_calculate_room_occupancy_throws_exception_for_invalid_value()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Неприпустима кількість занять!');

        calculateRoomOccupancy(45, 40);
    }

    public function test_calculate_room_occupancy_throws_exception_for_zero_total()
    {
        $this->expectException(Exception::class);

        calculateRoomOccupancy(0, 0);
    }
}
