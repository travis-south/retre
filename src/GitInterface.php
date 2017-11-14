<?php

namespace TravisSouth\Retre;

interface GitInterface
{
    public function getGroupInfo(string $group);
    public function getRepoId(string $repo);
    public function getRepoInfo(string $repo);
    public function getRepos(string $group);
}
