<?php

namespace TravisSouth\Retre;

class Git implements GitInterface
{
    public function __construct(InitializeInterface $init)
    {
        $this->init = $init;
        $this->groupAdapter = $this->init->getGroupInstance();
        $this->repoAdapter = $this->init->getRepoInstance();
    }

    public function getRepos(string $group)
    {
        return $this->groupAdapter->getRepos($group);
    }

    public function getGroupInfo(string $group)
    {
        return $this->groupAdapter->getGroupInfo($group);
    }

    public function getRepoInfo(string $repo)
    {
        return $this->repoAdapter->getRepoInfo($repo);
    }
    
    public function getRepoId(string $repo)
    {
        return $this->repoAdapter->getRepoId($repo);
    }
}
