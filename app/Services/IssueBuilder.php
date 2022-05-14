<?php

namespace App\Services;

use Michelf\Markdown;

class IssueBuilder
{
    public function build(array $data): array
    {
        $body = $data['body'] ?? '';

        return [
            'id' => $data['id'],
            'number' => $data['number'],
            'title' => $data['title'],
            'body' => Markdown::defaultTransform($body),
            'url' => $data['html_url'],
            'assignee' => $this->buildAssignee($data),
            'paused' => $this->buildPausedLabels($data),
            'progress' => (new ProgressCalculator())->calculate(
                substr_count(strtolower($body), '[x]'),
                substr_count(strtolower($body), '[ ]')
            ),
            'closed' => $data['closed_at'],
        ];
    }

    public function buildStatus(array $data): string
    {
        if ($data['state'] === 'closed') {
            return 'completed';
        }

        if ($data['assignee'] !== null) {
            return 'active';
        }

        return 'queued';
    }

    private function buildAssignee(array $data): ?string
    {
        return (array_key_exists('assignee', $data) && !empty($data['assignee']))
            ? $data['assignee']['avatar_url'] . '?s=16'
            : null;
    }

    private function buildPausedLabels(array $data): array
    {
        $paused = explode('|', config('gh_paused_labels'));

        if (array_key_exists('labels', $data) && !empty($data['labels'])) {
            return array_filter($data['labels'], static function ($item) use ($paused) {
                return in_array($item['name'], $paused, true);
            });
        }

        return [];
    }
}
