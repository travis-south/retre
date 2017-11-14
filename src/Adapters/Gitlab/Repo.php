<?php

namespace TravisSouth\Retre\Adapters\Gitlab;

use TravisSouth\Retre\Adapters\RepoAdapterInterface;

class Repo extends Gitlab implements RepoAdapterInterface
{

    const PROJECTS = 'projects';
    private $url;

    public function getRepoInfo(string $repo)
    {
        if (!$repo) {
            throw new \BadMethodCallException('repo cannot be empty!');
        }

        $response = $this->client->get(self::PROJECTS . '?per_page=100&search=' . $repo);

        if ($response->getStatusCode() != 200) {
            throw new \DomainException('Invalid response code: ' . $response->getStatusCode());
        }

        $result = $this->getResponse($response);
        if (count($result) == 0) {
            throw new \DomainException('Repo not found');
        }

        return $result[0];
    }

    public function getRepoId(string $repo)
    {
        $repoInfo = $this->getRepoInfo($repo);
        
        return $repoInfo->id;
    }
}
