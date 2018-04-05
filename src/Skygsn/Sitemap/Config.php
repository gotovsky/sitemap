<?php

namespace Skygsn\Sitemap;

use Skygsn\Sitemap\Exception\ConfigException;
use Skygsn\Sitemap\Validator\SitemapValidator;
use Skygsn\Sitemap\Validator\UrlValidator;

class Config
{
    const DEFAULT_URLS_PER_SITEMAP_LIMIT = 50000;

    /**
     * @var int
     */
    private $urlsPerSitemapLimit = self::DEFAULT_URLS_PER_SITEMAP_LIMIT;

    /**
     * @var UrlValidator[]
     */
    private $urlValidators = [];

    /**
     * @var SitemapValidator[]
     */
    private $sitemapValidators = [];

    /**
     * @var string
     */
    private $siteUrl;

    /**
     * @param string $siteUrl
     */
    public function __construct(string $siteUrl)
    {
        $this->siteUrl = $siteUrl;
    }

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

    /**
     * @return UrlValidator[]
     */
    public function getUrlValidators(): array
    {
        return $this->urlValidators;
    }

    /**
     * @return SitemapValidator[]
     */
    public function getSitemapValidators(): array
    {
        return $this->sitemapValidators;
    }

    /**
     * @param SitemapValidator $sitemapValidator
     */
    public function addSitemapValidator(SitemapValidator $sitemapValidator)
    {
        $this->sitemapValidators[] = $sitemapValidator;
    }

    /**
     * @param UrlValidator $urlValidator
     */
    public function addUrlValidator(UrlValidator $urlValidator)
    {
        $this->urlValidators[] = $urlValidator;
    }

    /**
     * @return string
     */
    public function getSitemapBaseUrl(): string
    {
        return $this->siteUrl;
    }
}