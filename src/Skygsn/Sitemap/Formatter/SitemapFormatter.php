<?php

namespace Skygsn\Sitemap\Formatter;

use Skygsn\Sitemap\Config;
use Skygsn\Sitemap\Sitemap;
use Skygsn\Sitemap\Validator\ValidationResultsBag;

interface SitemapFormatter
{
    /**
     * @param string[] $sitemapNames
     * @param Config $config
     * @return string
     */
    public function formatIndex(array $sitemapNames, Config $config): string;

    /**
     * @param Sitemap $sitemap
     * @param ValidationResultsBag $validationResultsBag
     * @param Config $config
     * @return string
     */
    public function format(Sitemap $sitemap, ValidationResultsBag $validationResultsBag, Config $config): string;
}