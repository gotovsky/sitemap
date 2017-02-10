<?php

namespace Skygsn\Sitemap\Formatter;

use Skygsn\Sitemap\Sitemap;

interface SitemapFormatter
{
    /**
     * @param Sitemap $sitemap
     * @return string
     */
    public function formatIndex(Sitemap $sitemap);

    /**
     * @param Sitemap $sitemap
     * @param UrlFormatter $urlFormatter
     * @return string
     */
    public function formatFull(Sitemap $sitemap, UrlFormatter $urlFormatter);
}