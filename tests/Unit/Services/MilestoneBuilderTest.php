<?php

namespace Tests\Unit\Services;

use App\Services\MilestoneBuilder;
use PHPUnit\Framework\TestCase;

class MilestoneBuilderTest extends TestCase
{
    /**
     * @dataProvider provider
     *
     * @param $name
     * @param $url
     * @param $progress
     * @param $issue
     * @param $expected
     */
    public function testBuild($name, $url, $progress, $issue, $expected): void
    {
        $milestoneBuilder = (new MilestoneBuilder());

        $this->assertEquals($expected, $milestoneBuilder->build($name, $url, $progress, $issue));
    }

    private function provider(): array
    {
        return [
            [
                'test_name',
                'https://api.github.com/repos/Islamgaliyev/nestjs-task-management/milestones/1',
                [
                    'percent' => 15,
                ],
                [
                    'queued' => [
                        [
                            "id" => 1225238313,
                            "number" => 24,
                            "title" => "New issue without labels",
                            "body" => "\n",
                            "url" => "https://github.com/Islamgaliyev/nestjs-task-management/issues/24",
                            "assignee" => "https://avatars.githubusercontent.com/u/23233615?v=4?s=16",
                            "paused" => [],
                            "progress" => [],
                            "closed" => "2022-05-09T05:22:05Z",
                        ],
                    ],
                    'active' => [],
                    'completed' => [
                        [
                            "id" => 1225238316,
                            "number" => 24,
                            "title" => "Issue test",
                            "body" => "\n",
                            "url" => "https://github.com/Islamgaliyev/nestjs-task-management/issues/26",
                            "assignee" => "https://avatars.githubusercontent.com/u/23233615?v=4?s=16",
                            "paused" => [],
                            "progress" => [],
                            "closed" => "2022-05-09T05:22:05Z",
                        ],
                    ],
                ],
                [
                    'milestone' => 'test_name',
                    'url' => 'https://api.github.com/repos/Islamgaliyev/nestjs-task-management/milestones/1',
                    'progress' => [
                        'percent' => 15,
                    ],
                    'queued' => [
                        [
                            "id" => 1225238313,
                            "number" => 24,
                            "title" => "New issue without labels",
                            "body" => "\n",
                            "url" => "https://github.com/Islamgaliyev/nestjs-task-management/issues/24",
                            "assignee" => "https://avatars.githubusercontent.com/u/23233615?v=4?s=16",
                            "paused" => [],
                            "progress" => [],
                            "closed" => "2022-05-09T05:22:05Z",
                        ],
                    ],
                    'active' => [],
                    'completed' => [
                        [
                            "id" => 1225238316,
                            "number" => 24,
                            "title" => "Issue test",
                            "body" => "\n",
                            "url" => "https://github.com/Islamgaliyev/nestjs-task-management/issues/26",
                            "assignee" => "https://avatars.githubusercontent.com/u/23233615?v=4?s=16",
                            "paused" => [],
                            "progress" => [],
                            "closed" => "2022-05-09T05:22:05Z",
                        ],
                    ],
                ],
            ],
        ];
    }
}
