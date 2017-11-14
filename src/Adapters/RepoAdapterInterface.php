<?php

namespace TravisSouth\Retre\Adapters;

interface RepoAdapterInterface
{
    public function getRepoInfo(string $repo);
    public function getRepoId(string $repo);
}
