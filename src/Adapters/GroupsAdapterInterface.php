<?php

namespace TravisSouth\Retre\Adapters;

interface GroupsAdapterInterface
{
    public function getRepos(string $group);
    public function getGroupInfo(string $group);
}
