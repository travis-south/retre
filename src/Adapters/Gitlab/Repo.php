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

        $response = $this->client->get(self::PROJECTS . '?per_page=100&membership=true&order_by=name&sort=asc&search=' . $repo);

        if ($response->getStatusCode() != 200) {
            throw new \DomainException('Invalid response code: ' . $response->getStatusCode());
        }

        $results = $this->getResponse($response);
        if (count($results) == 0) {
            throw new \DomainException('Repo ' . $repo . ' not found');
        }
        $result = $this->getExactMatch($results, $repo);

        if (!$result) {
            throw new \DomainException('Repo ' . $repo . ' not found');
        }

        return $result;
    }

    private function getExactMatch($results, $repo)
    {
        foreach ($results as $result) {
            if (strtolower(trim((string)$result->name)) === strtolower(trim((string)$repo))) {
                return $result;
            }
        }
        return false;
    }

    public function getRepoId(string $repo)
    {
        $repoInfo = $this->getRepoInfo($repo);
        
        return $repoInfo->id;
    }
}
