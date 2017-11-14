# Docs

Contains all details on how to use this (TBC).

## Usage

```php
use TravisSouth\Retre\Git;
use TravisSouth\Retre\Adapters\Gitlab\Initialize;

// Initialize your instance.
$gitlab = new Initialize('https://gitlab.com', 'asdfqwer');
$git = new Git($gitlab);

// Search for group foo
$git->getGroupInfo('foo');

// Retrieve all repositories under foor
$git->getRepos('foo');

// Search for repository bar
$git->getRepoInfo('bar');

// Retrieve repo id for bar
$git->getRepoId('bar');
```
