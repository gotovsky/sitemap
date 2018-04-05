<?php

namespace Skygsn\Sitemap;

use Skygsn\Sitemap\Formatter\SitemapFormatter;
use Skygsn\Sitemap\Formatter\UrlFormatter;
use Skygsn\Sitemap\Storage\Storage;
use Skygsn\Sitemap\Validator\ValidationResultsBag;

/**
 * 1. Можно передать много файлов, если больше одного автоматически создается индексный файл
 * 2. Если передан один файл но в нем больше 50000 адресов так же создается индексный файл (если указано название то name1, name2, name3, если нет то sitemap1, sitemap2)
 * 3. Препроцессоры: например, проверяющий при генерации на корректный ответ сервера
 * 4. Сжатие gzip
 */

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

            $this->storage->save('sitemapindex', $this->sitemapFormatter->formatIndex($savedSitemaps, $this->config));
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
