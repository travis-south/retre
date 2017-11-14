<?php

namespace TravisSouth\Retre\Adapters\Gitlab;

use TravisSouth\Retre\InitializeInterface;

class Initialize implements InitializeInterface
{
    public function __construct(string $endpoint, string $token)
    {
        $this->endpoint = $endpoint;
        $this->token = $token;
    }

    public function getGroupInstance()
    {
        return new Groups($this->endpoint, $this->token);
    }

    public function getRepoInstance()
    {
        return new Repo($this->endpoint, $this->token);
    }
}
