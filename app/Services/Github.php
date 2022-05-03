<?php

namespace App\Services;

class Github
{
    private $client;
    private $milestone_api;
    private $account;

    public function __construct($token, $account)
    {
        $this->account = $account;
        $this->client= new \Github\Client();
        $this->client->authenticate($token, null, \Github\AuthMethod::CLIENT_ID);

        $this->milestone_api = $this->client->issues()->milestones();
    }

    public function milestones($repository)
    {
        return $this->milestone_api->all($this->account, $repository);
    }

    public function issues($repository, $milestone_id)
    {
        $issue_parameters = array('milestone' => $milestone_id, 'state' => 'all');
        return $this->client->api('issue')->all($this->account, $repository, $issue_parameters);
    }
}
