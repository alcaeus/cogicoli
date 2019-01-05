<?php

declare(strict_types = 1);

namespace Alcaeus\Cogicoli\Loader;

use Alcaeus\Cogicoli\Contributor\ContributorList;
use Github\Client;

class GitHubLoader implements LoaderInterface
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function load(string $repositoryUrl): ContributorList
    {
        list($username, $repository) = $this->splitRepository($repositoryUrl);

        $contributors = $this->client->repository()->contributors($username, $repository, true);

        return [];
    }

    private function splitRepository(string $repositoryUrl): array
    {
        $urlInfos = parse_url($repositoryUrl, PHP_URL_PATH);
        if ('github.com' !== $urlInfos['hostname']) {
            throw new \RuntimeException('invalid url');
        }

        if (! preg_match('#/([^/]+)/([^/]+)#', $urlInfos['path'], $matches)) {
            throw new \RuntimeException('invalid url');
        }

        return [
            $matches[1],
            $matches[2]
        ];
    }
}
