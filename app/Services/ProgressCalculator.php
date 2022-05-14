<?php

namespace App\Services;

class ProgressCalculator
{
    public function calculate(int $complete, int $remaining): array
    {
        $total = $complete + $remaining;

        if ($total <= 0) {
            return [];
        }

        $percent = ($complete || $remaining) ? round($complete / $total * 100) : 0;

        return [
            'percent' => $percent,
        ];
    }
}
