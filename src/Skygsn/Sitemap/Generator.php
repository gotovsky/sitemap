<?php

namespace Skygsn\Sitemap;

use Skygsn\Sitemap\Formatter\SitemapFormatter;
use Skygsn\Sitemap\Formatter\UrlFormatter;
use Skygsn\Sitemap\Storage\Storage;

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
     * @var UrlFormatter
     */
    private $urlFormatter;

    /**
     * @param Config $config
     * @param Storage $storage
     * @param SitemapFormatter $sitemapFormatter
     * @param UrlFormatter $urlFormatter
     */
    public function __construct(
        Config $config,
        Storage $storage,
        SitemapFormatter $sitemapFormatter,
        UrlFormatter $urlFormatter
    )
    {
        $this->config = $config;
        $this->storage = $storage;
        $this->sitemapFormatter = $sitemapFormatter;
        $this->urlFormatter = $urlFormatter;
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
            $this->storage->save('dddd', $this->sitemapFormatter->formatFull(current($sitemaps), $this->urlFormatter));
        }
    }
}
