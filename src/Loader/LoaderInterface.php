<?php

declare(strict_types = 1);

namespace Alcaeus\Cogicoli\Loader;

use Alcaeus\Cogicoli\Contributor\ContributorList;

interface LoaderInterface
{
    public function load(string $repositoryUrl): ContributorList;
}
