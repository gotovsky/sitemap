<?php

namespace Skygsn\Sitemap;

use Skygsn\Sitemap\Formatter\SitemapFormatter;
use Skygsn\Sitemap\Formatter\UrlFormatter;
use Skygsn\Sitemap\Storage\Storage;
use Skygsn\Sitemap\Validator\ValidationResultsBag;

class Generator
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var Storage
     */
    private $storage;

    /**
     * @var SitemapFormatter
     */
    private $sitemapFormatter;

    /**
     * @var ValidationResultsBag
     */
    private $validationResultsBag;

    /**
     * @param Config $config
     * @param Storage $storage
     * @param SitemapFormatter $sitemapFormatter
     * @param UrlFormatter $urlFormatter
     * @param ValidationResultsBag $validationResultsBag
     */
    public function __construct(
        Config $config,
        Storage $storage,
        SitemapFormatter $sitemapFormatter,
        ValidationResultsBag $validationResultsBag
    ) {
        $this->config = $config;
        $this->storage = $storage;
        $this->sitemapFormatter = $sitemapFormatter;
        $this->validationResultsBag = $validationResultsBag;
    }

    /**
     * @param Sitemap[] $sitemaps
     */
    public function create(array $sitemaps)
    {
        if (empty($sitemaps)) {
            return;
        }

        if (count($sitemaps) == 1) {
            $formattedSitemap = $this->sitemapFormatter->format(
                current($sitemaps),
                $this->validationResultsBag, $this->config
            );

            if (!$this->validationResultsBag->hasErrors()) {
                $this->storage->save(current($sitemaps)->getName(), $formattedSitemap);
            }
        }

        if (count($sitemaps) > 1) {
            $formattedSitemaps = [];

            foreach ($sitemaps as $sitemap) {
                $formattedSitemaps[] = $this->sitemapFormatter->format(
                    $sitemap,
                    $this->validationResultsBag,
                    $this->config
                );
            }

            $savedSitemaps = [];
            if (!$this->validationResultsBag->hasErrors()) {
                foreach ($sitemaps as $key => $sitemap) {
                    $savedSitemaps[] = $this->storage->save($sitemap->getName(), $formattedSitemaps[$key]);
                }
            }

            $this->storage->save(
                $this->config->getSitemapIndexName(),
                $this->sitemapFormatter->formatIndex($savedSitemaps, $this->config)
            );
        }
    }

    /**
     * @return string[]
     */
    public function getErrors(): array
    {
        return $this->validationResultsBag->getErrors();
    }

    /**
     * @return string[]
     */
    public function getWarning(): array
    {
        return $this->validationResultsBag->getWarnings();
    }
}
