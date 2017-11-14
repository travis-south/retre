<?php

namespace TravisSouth\Retre;

interface RepoInterface
{
    public function getRepoInfo(string $repo);
    public function getRepoId(string $repo);
}
