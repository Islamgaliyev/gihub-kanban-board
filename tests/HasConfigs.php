<?php

namespace Tests;

trait HasConfigs
{
    private function mockConfigs(
        string $appMainPageUrl = 'http:://test.com/board/index',
        string $ghAccount = 'test_gh_account',
        string $ghClientId = 'test_gh_client_id',
        string $ghClientSecret = 'test_gh_client_secret',
        string $ghRepositories = 'test_repo',
        string $ghPausedLabels = 'question'
    ): void {
        $_ENV['APP_MAIN_PAGE_URL'] = $appMainPageUrl;
        $_ENV['GH_ACCOUNT'] = $ghAccount;
        $_ENV['GH_CLIENT_ID'] = $ghClientId;
        $_ENV['GH_CLIENT_SECRET'] = $ghClientSecret;
        $_ENV['GH_REPOSITORIES'] = $ghRepositories;
        $_ENV['GH_PAUSED_LABELS'] = $ghPausedLabels;
    }
}
