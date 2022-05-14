<?php

namespace App\Services;

class MilestoneBuilder
{
    public function build(string $name, string $url, array $progress, array $issues): array
    {
        return [
            'milestone' => $name,
            'url' => $url,
            'progress' => $progress,
            'queued' => $issues['queued'] ?? [],
            'active' => $issues['active'] ?? [],
            'completed' => $issues['completed'] ?? [],
        ];
    }
}
