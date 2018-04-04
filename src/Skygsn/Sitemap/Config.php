<?php

namespace Skygsn\Sitemap;

use Skygsn\Sitemap\Exception\ConfigException;

class Config
{
    const DEFAULT_URLS_PER_SITEMAP_LIMIT = 50000;

    /**
     * @var int
     */
    private $urlsPerSitemapLimit = self::DEFAULT_URLS_PER_SITEMAP_LIMIT;

    /**
     * @param int $urlsPerSitemapLimit
     */
    public function setUrlsPerSitemapLimit(int $urlsPerSitemapLimit)
    {
        $this->urlsPerSitemapLimit = $urlsPerSitemapLimit;

        if ($this->urlsPerSitemapLimit > self::DEFAULT_URLS_PER_SITEMAP_LIMIT) {
            throw new ConfigException(
                sprintf('urlsPerSitemapLimit can\'t be more than %s', self::DEFAULT_URLS_PER_SITEMAP_LIMIT)
            );
        }
    }

    /**
     * @return int
     */
    public function getUrlsPerSitemapLimit(): int
    {
        return $this->urlsPerSitemapLimit;
    }
}