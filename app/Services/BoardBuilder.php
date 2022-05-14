<?php

namespace App\Services;

use Github\Client;

class BoardBuilder
{
    protected array $repositories;

    protected string $account;

    public function __construct(protected Client $client)
    {
        $this->repositories = explode('|', config('gh_repositories'));
        $this->account = config('gh_account');
    }

    public function build(string $token): array
    {
        $milestones = $this->getMilestones($token);

        ksort($milestones);

        return $this->buildBoard($milestones, $token);
    }

    private function getMilestones(string $token): array
    {
        $milestones = [];

        foreach ($this->repositories as $repository) {
            foreach ($this->getMilestonesByRepository($repository, $token) as $milestone) {
                $milestones[$milestone['title']] = $milestone;
                $milestones[$milestone['title']]['repository'] = $repository;
            }
        }

        return $milestones;
    }

    private function buildBoard(array $milestones, string $token): array
    {
        $milestoneBuilder = (new MilestoneBuilder());
        $result = [];

        foreach ($milestones as $name => $data) {
            $issues = $this->getIssues($data['repository'], $data['number'], $token);

            $progress = (new ProgressCalculator())->calculate($data['closed_issues'], $data['open_issues']);

            if ($progress) {
                $result[] = $milestoneBuilder->build($name, $data['html_url'], $progress, $issues);
            }
        }

        return $result;
    }

    private function getIssues(string $repository, string $milestoneNumber, string $token): array
    {
        $issueBuilder = (new IssueBuilder());

        $result = [];
        $issues = $this
            ->makeAuthorizationRequest($token)
            ->issues()
            ->all($this->account, $repository, ['milestone' => $milestoneNumber, 'state' => 'all']);

        foreach ($issues as $data) {
            if (isset($data['pull_request'])) {
                continue;
            }

            $result[$issueBuilder->buildStatus($data)][] = $issueBuilder->build($data);
        }


        if (isset($result['active'])) {
            usort($result['active'], static function ($a, $b) {
                return count($a['paused']) - count($b['paused']) === 0 ? strcmp($a['title'],
                    $b['title']) : count($a['paused']) - count($b['paused']);
            });
        }

        return $result;
    }

    private function getMilestonesByRepository(string $repository, string $token): array
    {
        return $this
            ->makeAuthorizationRequest($token)
            ->issues()
            ->milestones()
            ->all($this->account, $repository);
    }

    private function makeAuthorizationRequest($token): Client
    {
        $this->client->authenticate($token, null, \Github\AuthMethod::CLIENT_ID);

        return $this->client;
    }
}
