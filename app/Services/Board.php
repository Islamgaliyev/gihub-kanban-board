<?php

namespace App\Services;

use Github\Client;
use Michelf\Markdown;

class Board
{
    protected array $repositories;

    protected string $account;

    protected array $pausedLabels;

    public function __construct(protected Client $client)
    {
        $this->repositories = explode('|', config('gh_repositories'));
        $this->account = config('gh_account');
        $this->pausedLabels = explode('|', config('gh_paused_labels'));
    }

    public function milestones(string $token): array
    {
        $milestones = [];
        $result = [];

        foreach ($this->repositories as $repository) {
            foreach ($this->getMilestonesByRepository($repository, $token) as $milestone) {
                $milestones[$milestone['title']] = $milestone;
                $milestones[$milestone['title']]['repository'] = $repository;
            }
        }

        ksort($milestones);

        foreach ($milestones as $name => $data) {
            $issues = $this->getIssues($data['repository'], $data['number'], $token);

            $percent = $this->getPercent($data['closed_issues'], $data['open_issues']);

            if ($percent) {
                $result[] = array(
                    'milestone' => $name,
                    'url' => $data['html_url'],
                    'progress' => $percent,
                    'queued' => $issues['queued'] ?? [],
                    'active' => $issues['active'] ?? [],
                    'completed' => $issues['completed'] ?? [],
                );
            }
        }

        return $result;
    }

    private function getIssues(string $repository, string $number, string $token): array
    {
        $result = [];
        $issues = $this
            ->authenticate($token)
            ->issues()
            ->all($this->account, $repository, ['milestone' => $number, 'state' => 'all']);

        foreach ($issues as $issue) {
            if (isset($issue['pull_request'])) {
                continue;
            }

            $body = $issue['body'] ?? '';

            $result[$this->getStatus($issue)][] = [
                'id' => $issue['id'],
                'number' => $issue['number'],
                'title' => $issue['title'],
                'body' => Markdown::defaultTransform($body),
                'url' => $issue['html_url'],
                'assignee' => (is_array($issue) && array_key_exists('assignee',
                        $issue) && !empty($issue['assignee'])) ? $issue['assignee']['avatar_url'] . '?s=16' : null,
                'paused' => $this->getPausedLabels($issue),
                'progress' => $this->getPercent(
                    substr_count(strtolower($body), '[x]'),
                    substr_count(strtolower($body), '[ ]')
                ),
                'closed' => $issue['closed_at'],
            ];
        }


        if (isset($result['active'])) {
            usort($result['active'], function ($a, $b) {
                return count($a['paused']) - count($b['paused']) === 0 ? strcmp($a['title'],
                    $b['title']) : count($a['paused']) - count($b['paused']);
            });
        }

        return $result;
    }

    private function getStatus(array $issue): string
    {
        if ($issue['state'] === 'closed') {
            return 'completed';
        }

        if ($issue['assignee'] !== null) {
            return 'active';
        }

        return 'queued';
    }

    private function getMilestonesByRepository(string $repository, string $token): array
    {
        return $this
            ->authenticate($token)
            ->issues()
            ->milestones()
            ->all($this->account, $repository);
    }

    private function authenticate($token): Client
    {
        $this->client->authenticate($token, null, \Github\AuthMethod::CLIENT_ID);

        return $this->client;
    }

    private function getPercent(int $complete, int $remaining): array
    {
        $total = $complete + $remaining;

        if ($total > 0) {
            $percent = ($complete || $remaining) ? round($complete / $total * 100) : 0;

            return [
                'total' => $total,
                'complete' => $complete,
                'remaining' => $remaining,
                'percent' => $percent,
            ];
        }

        return [];
    }

    private function getPausedLabels($issue): array
    {
        if (array_key_exists('labels', $issue) && !empty($issue['labels'])) {
            return array_filter($issue['labels'], function ($item) {
                return in_array($item['name'], $this->pausedLabels, true);
            });
        }

        return [];
    }
}
