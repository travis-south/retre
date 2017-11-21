<?php

namespace TravisSouth\Retre\Adapters\Gitlab;

use TravisSouth\Retre\Adapters\GroupsAdapterInterface;

class Groups extends Gitlab implements GroupsAdapterInterface
{

    const GROUPS = 'groups';
    private $url;

    public function getGroupInfo(string $group)
    {
        if (!$group) {
            throw new \BadMethodCallException('group cannot be empty!');
        }

        $response = $this->client->get(self::GROUPS . '?per_page=100&search=' . $group);

        if ($response->getStatusCode() != 200) {
            throw new \DomainException('Invalid response code: ' . $response->getStatusCode());
        }

        $result = $this->getResponse($response);
        if (count($result) == 0) {
            throw new \DomainException('Group ' . $group . ' not found');
        }

        return $result[0];
    }

    public function getRepos(string $group)
    {
        $groupInfo = $this->getGroupInfo($group);
        $groupId = $groupInfo->id;
        
        $response = $this->client->get(self::GROUPS . '/' . $groupId . '/projects?per_page=100');

        if ($response->getStatusCode() != 200) {
            throw new \DomainException('Invalid response code: ' . $response->getStatusCode());
        }

        $result = $this->getResponse($response);

        if (count($result) == 0) {
            throw new \DomainException('No projects found in this group.');
        }

        return $result;
    }
}
