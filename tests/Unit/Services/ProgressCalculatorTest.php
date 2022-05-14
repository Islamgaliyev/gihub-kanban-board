<?php

namespace Tests\Unit\Services;

use App\Services\ProgressCalculator;
use PHPUnit\Framework\TestCase;

class ProgressCalculatorTest extends TestCase
{
    /**
     * @dataProvider provider
     *
     * @param $complete
     * @param $remaining
     * @param $expected
     */
    public function testCalculate($complete, $remaining, $expected): void
    {
        $calculator = (new ProgressCalculator());

        $this->assertEquals($expected, $calculator->calculate($complete, $remaining));
    }

    /**
     * @return array
     */
    private function provider(): array
    {
        return [
            [-1, -2, []],
            [5, 15, ['percent' => 25]],
            [0, 0, []],
            [6, 10, ['percent' => 38]],
            [1, 2, ['percent' => 33]],
        ];
    }

}
