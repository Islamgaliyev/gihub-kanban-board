<?php

namespace Tests\Unit\Services;

use App\Services\IssueBuilder;
use PHPUnit\Framework\TestCase;
use Tests\HasConfigs;

class IssueBuilderTest extends TestCase
{
    use HasConfigs;

    /**
     * @dataProvider providerForIssue
     *
     * @param $input
     * @param $expected
     */
    public function testBuildIssue($input, $expected): void
    {
        $this->mockConfigs();

        $issueBuilder = (new IssueBuilder());

        $this->assertEquals($expected, $issueBuilder->build($input));
    }


    /**
     * @dataProvider providerForStatus
     *
     * @param $input
     * @param $expected
     */
    public function testBuildStatus($input, $expected): void
    {
        $issueBuilder = (new IssueBuilder());

        $this->assertEquals($expected, $issueBuilder->buildStatus($input));
    }

    private function providerForIssue(): array
    {
        return [
            [
                [
                    "url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/issues/24",
                    "repository_url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management",
                    "labels_url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/issues/24/labels{/name}",
                    "comments_url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/issues/24/comments",
                    "events_url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/issues/24/events",
                    "html_url" => "https://github.com/Islamgaliyev/nestjs-task-management/issues/24",
                    "id" => 1225238313,
                    "node_id" => "I_kwDODsazl85JB6cp",
                    "number" => 24,
                    "title" => "New issue without labels",
                    "user" => [
                        "login" => "Islamgaliyev",
                        "id" => 23233615,
                        "node_id" => "MDQ6VXNlcjIzMjMzNjE1",
                        "avatar_url" => "https://avatars.githubusercontent.com/u/23233615?v=4",
                        "gravatar_id" => "",
                        "url" => "https://api.github.com/users/Islamgaliyev",
                        "html_url" => "https://github.com/Islamgaliyev",
                        "followers_url" => "https://api.github.com/users/Islamgaliyev/followers",
                        "following_url" => "https://api.github.com/users/Islamgaliyev/following{/other_user}",
                        "gists_url" => "https://api.github.com/users/Islamgaliyev/gists{/gist_id}",
                        "starred_url" => "https://api.github.com/users/Islamgaliyev/starred{/owner}{/repo}",
                        "subscriptions_url" => "https://api.github.com/users/Islamgaliyev/subscriptions",
                        "organizations_url" => "https://api.github.com/users/Islamgaliyev/orgs",
                        "repos_url" => "https://api.github.com/users/Islamgaliyev/repos",
                        "events_url" => "https://api.github.com/users/Islamgaliyev/events{/privacy}",
                        "received_events_url" => "https://api.github.com/users/Islamgaliyev/received_events",
                        "type" => "User",
                        "site_admin" => false,
                    ],
                    "labels" => [],
                    "state" => "closed",
                    "locked" => false,
                    "assignee" => [
                        "login" => "Islamgaliyev",
                        "id" => 23233615,
                        "node_id" => "MDQ6VXNlcjIzMjMzNjE1",
                        "avatar_url" => "https://avatars.githubusercontent.com/u/23233615?v=4",
                        "gravatar_id" => "",
                        "url" => "https://api.github.com/users/Islamgaliyev",
                        "html_url" => "https://github.com/Islamgaliyev",
                        "followers_url" => "https://api.github.com/users/Islamgaliyev/followers",
                        "following_url" => "https://api.github.com/users/Islamgaliyev/following{/other_user}",
                        "gists_url" => "https://api.github.com/users/Islamgaliyev/gists{/gist_id}",
                        "starred_url" => "https://api.github.com/users/Islamgaliyev/starred{/owner}{/repo}",
                        "subscriptions_url" => "https://api.github.com/users/Islamgaliyev/subscriptions",
                        "organizations_url" => "https://api.github.com/users/Islamgaliyev/orgs",
                        "repos_url" => "https://api.github.com/users/Islamgaliyev/repos",
                        "events_url" => "https://api.github.com/users/Islamgaliyev/events{/privacy}",
                        "received_events_url" => "https://api.github.com/users/Islamgaliyev/received_events",
                        "type" => "User",
                        "site_admin" => false,
                    ],
                    "assignees" => [
                        [
                            "login" => "Islamgaliyev",
                            "id" => 23233615,
                            "node_id" => "MDQ6VXNlcjIzMjMzNjE1",
                            "avatar_url" => "https://avatars.githubusercontent.com/u/23233615?v=4",
                            "gravatar_id" => "",
                            "url" => "https://api.github.com/users/Islamgaliyev",
                            "html_url" => "https://github.com/Islamgaliyev",
                            "followers_url" => "https://api.github.com/users/Islamgaliyev/followers",
                            "following_url" => "https://api.github.com/users/Islamgaliyev/following{/other_user}",
                            "gists_url" => "https://api.github.com/users/Islamgaliyev/gists{/gist_id}",
                            "starred_url" => "https://api.github.com/users/Islamgaliyev/starred{/owner}{/repo}",
                            "subscriptions_url" => "https://api.github.com/users/Islamgaliyev/subscriptions",
                            "organizations_url" => "https://api.github.com/users/Islamgaliyev/orgs",
                            "repos_url" => "https://api.github.com/users/Islamgaliyev/repos",
                            "events_url" => "https://api.github.com/users/Islamgaliyev/events{/privacy}",
                            "received_events_url" => "https://api.github.com/users/Islamgaliyev/received_events",
                            "type" => "User",
                            "site_admin" => false,
                        ],
                    ],
                    "milestone" => [
                        "url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/milestones/1",
                        "html_url" => "https://github.com/Islamgaliyev/nestjs-task-management/milestone/1",
                        "labels_url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/milestones/1/labels",
                        "id" => 7938347,
                        "node_id" => "MI_kwDODsazl84AeSEr",
                        "number" => 1,
                        "title" => "Test milestone",
                        "description" => "",
                        "creator" => [
                            "login" => "Islamgaliyev",
                            "id" => 23233615,
                            "node_id" => "MDQ6VXNlcjIzMjMzNjE1",
                            "avatar_url" => "https://avatars.githubusercontent.com/u/23233615?v=4",
                            "gravatar_id" => "",
                            "url" => "https://api.github.com/users/Islamgaliyev",
                            "html_url" => "https://github.com/Islamgaliyev",
                            "followers_url" => "https://api.github.com/users/Islamgaliyev/followers",
                            "following_url" => "https://api.github.com/users/Islamgaliyev/following{/other_user}",
                            "gists_url" => "https://api.github.com/users/Islamgaliyev/gists{/gist_id}",
                            "starred_url" => "https://api.github.com/users/Islamgaliyev/starred{/owner}{/repo}",
                            "subscriptions_url" => "https://api.github.com/users/Islamgaliyev/subscriptions",
                            "organizations_url" => "https://api.github.com/users/Islamgaliyev/orgs",
                            "repos_url" => "https://api.github.com/users/Islamgaliyev/repos",
                            "events_url" => "https://api.github.com/users/Islamgaliyev/events{/privacy}",
                            "received_events_url" => "https://api.github.com/users/Islamgaliyev/received_events",
                            "type" => "User",
                            "site_admin" => false,
                        ],
                        "open_issues" => 3,
                        "closed_issues" => 2,
                        "state" => "open",
                        "created_at" => "2022-05-03T10:49:14Z",
                        "updated_at" => "2022-05-09T05:22:05Z",
                        "due_on" => "2022-05-15T07:00:00Z",
                        "closed_at" => null,
                    ],
                    "comments" => 0,
                    "created_at" => "2022-05-04T11:22:53Z",
                    "updated_at" => "2022-05-09T05:22:05Z",
                    "closed_at" => "2022-05-09T05:22:05Z",
                    "author_association" => "OWNER",
                    "active_lock_reason" => null,
                    "body" => null,
                    "reactions" => [
                        "url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/issues/24/reactions",
                        "total_count" => 0,
                        "+1" => 0,
                        0,
                        "laugh" => 0,
                        "hooray" => 0,
                        "confused" => 0,
                        "heart" => 0,
                        "rocket" => 0,
                        "eyes" => 0,
                    ],
                    "timeline_url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/issues/24/timeline",
                    "performed_via_github_app" => null,
                ],
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
            [
                [
                    "url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/issues/24",
                    "repository_url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management",
                    "labels_url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/issues/24/labels{/name}",
                    "comments_url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/issues/24/comments",
                    "events_url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/issues/24/events",
                    "html_url" => "https://github.com/Islamgaliyev/nestjs-task-management/issues/24",
                    "id" => 1225238313,
                    "node_id" => "I_kwDODsazl85JB6cp",
                    "number" => 24,
                    "title" => "New issue without labels",
                    "user" => [
                        "login" => "Islamgaliyev",
                        "id" => 23233615,
                        "node_id" => "MDQ6VXNlcjIzMjMzNjE1",
                        "avatar_url" => "https://avatars.githubusercontent.com/u/23233615?v=4",
                        "gravatar_id" => "",
                        "url" => "https://api.github.com/users/Islamgaliyev",
                        "html_url" => "https://github.com/Islamgaliyev",
                        "followers_url" => "https://api.github.com/users/Islamgaliyev/followers",
                        "following_url" => "https://api.github.com/users/Islamgaliyev/following{/other_user}",
                        "gists_url" => "https://api.github.com/users/Islamgaliyev/gists{/gist_id}",
                        "starred_url" => "https://api.github.com/users/Islamgaliyev/starred{/owner}{/repo}",
                        "subscriptions_url" => "https://api.github.com/users/Islamgaliyev/subscriptions",
                        "organizations_url" => "https://api.github.com/users/Islamgaliyev/orgs",
                        "repos_url" => "https://api.github.com/users/Islamgaliyev/repos",
                        "events_url" => "https://api.github.com/users/Islamgaliyev/events{/privacy}",
                        "received_events_url" => "https://api.github.com/users/Islamgaliyev/received_events",
                        "type" => "User",
                        "site_admin" => false,
                    ],
                    "labels" => [['name' => 'question']],
                    "state" => "closed",
                    "locked" => false,
                    "assignee" => [
                        "login" => "Islamgaliyev",
                        "id" => 23233615,
                        "node_id" => "MDQ6VXNlcjIzMjMzNjE1",
                        "avatar_url" => "https://avatars.githubusercontent.com/u/23233615?v=4",
                        "gravatar_id" => "",
                        "url" => "https://api.github.com/users/Islamgaliyev",
                        "html_url" => "https://github.com/Islamgaliyev",
                        "followers_url" => "https://api.github.com/users/Islamgaliyev/followers",
                        "following_url" => "https://api.github.com/users/Islamgaliyev/following{/other_user}",
                        "gists_url" => "https://api.github.com/users/Islamgaliyev/gists{/gist_id}",
                        "starred_url" => "https://api.github.com/users/Islamgaliyev/starred{/owner}{/repo}",
                        "subscriptions_url" => "https://api.github.com/users/Islamgaliyev/subscriptions",
                        "organizations_url" => "https://api.github.com/users/Islamgaliyev/orgs",
                        "repos_url" => "https://api.github.com/users/Islamgaliyev/repos",
                        "events_url" => "https://api.github.com/users/Islamgaliyev/events{/privacy}",
                        "received_events_url" => "https://api.github.com/users/Islamgaliyev/received_events",
                        "type" => "User",
                        "site_admin" => false,
                    ],
                    "assignees" => [
                        [
                            "login" => "Islamgaliyev",
                            "id" => 23233615,
                            "node_id" => "MDQ6VXNlcjIzMjMzNjE1",
                            "avatar_url" => "https://avatars.githubusercontent.com/u/23233615?v=4",
                            "gravatar_id" => "",
                            "url" => "https://api.github.com/users/Islamgaliyev",
                            "html_url" => "https://github.com/Islamgaliyev",
                            "followers_url" => "https://api.github.com/users/Islamgaliyev/followers",
                            "following_url" => "https://api.github.com/users/Islamgaliyev/following{/other_user}",
                            "gists_url" => "https://api.github.com/users/Islamgaliyev/gists{/gist_id}",
                            "starred_url" => "https://api.github.com/users/Islamgaliyev/starred{/owner}{/repo}",
                            "subscriptions_url" => "https://api.github.com/users/Islamgaliyev/subscriptions",
                            "organizations_url" => "https://api.github.com/users/Islamgaliyev/orgs",
                            "repos_url" => "https://api.github.com/users/Islamgaliyev/repos",
                            "events_url" => "https://api.github.com/users/Islamgaliyev/events{/privacy}",
                            "received_events_url" => "https://api.github.com/users/Islamgaliyev/received_events",
                            "type" => "User",
                            "site_admin" => false,
                        ],
                    ],
                    "milestone" => [
                        "url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/milestones/1",
                        "html_url" => "https://github.com/Islamgaliyev/nestjs-task-management/milestone/1",
                        "labels_url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/milestones/1/labels",
                        "id" => 7938347,
                        "node_id" => "MI_kwDODsazl84AeSEr",
                        "number" => 1,
                        "title" => "Test milestone",
                        "description" => "",
                        "creator" => [
                            "login" => "Islamgaliyev",
                            "id" => 23233615,
                            "node_id" => "MDQ6VXNlcjIzMjMzNjE1",
                            "avatar_url" => "https://avatars.githubusercontent.com/u/23233615?v=4",
                            "gravatar_id" => "",
                            "url" => "https://api.github.com/users/Islamgaliyev",
                            "html_url" => "https://github.com/Islamgaliyev",
                            "followers_url" => "https://api.github.com/users/Islamgaliyev/followers",
                            "following_url" => "https://api.github.com/users/Islamgaliyev/following{/other_user}",
                            "gists_url" => "https://api.github.com/users/Islamgaliyev/gists{/gist_id}",
                            "starred_url" => "https://api.github.com/users/Islamgaliyev/starred{/owner}{/repo}",
                            "subscriptions_url" => "https://api.github.com/users/Islamgaliyev/subscriptions",
                            "organizations_url" => "https://api.github.com/users/Islamgaliyev/orgs",
                            "repos_url" => "https://api.github.com/users/Islamgaliyev/repos",
                            "events_url" => "https://api.github.com/users/Islamgaliyev/events{/privacy}",
                            "received_events_url" => "https://api.github.com/users/Islamgaliyev/received_events",
                            "type" => "User",
                            "site_admin" => false,
                        ],
                        "open_issues" => 3,
                        "closed_issues" => 2,
                        "state" => "open",
                        "created_at" => "2022-05-03T10:49:14Z",
                        "updated_at" => "2022-05-09T05:22:05Z",
                        "due_on" => "2022-05-15T07:00:00Z",
                        "closed_at" => null,
                    ],
                    "comments" => 0,
                    "created_at" => "2022-05-04T11:22:53Z",
                    "updated_at" => "2022-05-09T05:22:05Z",
                    "closed_at" => "2022-05-09T05:22:05Z",
                    "author_association" => "OWNER",
                    "active_lock_reason" => null,
                    "body" => null,
                    "reactions" => [
                        "url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/issues/24/reactions",
                        "total_count" => 0,
                        "+1" => 0,
                        0,
                        "laugh" => 0,
                        "hooray" => 0,
                        "confused" => 0,
                        "heart" => 0,
                        "rocket" => 0,
                        "eyes" => 0,
                    ],
                    "timeline_url" => "https://api.github.com/repos/Islamgaliyev/nestjs-task-management/issues/24/timeline",
                    "performed_via_github_app" => null,
                ],
                [
                    "id" => 1225238313,
                    "number" => 24,
                    "title" => "New issue without labels",
                    "body" => "\n",
                    "url" => "https://github.com/Islamgaliyev/nestjs-task-management/issues/24",
                    "assignee" => "https://avatars.githubusercontent.com/u/23233615?v=4?s=16",
                    "paused" => [['name' => 'question']],
                    "progress" => [],
                    "closed" => "2022-05-09T05:22:05Z",
                ],
            ],
        ];
    }

    private function providerForStatus(): array
    {
        return [
            [
                [
                    'state' => 'closed',
                    'assignee' => 'user',
                ],
                'completed',
            ],
            [
                [
                    'state' => 'open',
                    'assignee' => 'user',
                ],
                'active',
            ],
            [
                [
                    'state' => 'open',
                    'assignee' => null,
                ],
                'queued',
            ],
        ];
    }

}
