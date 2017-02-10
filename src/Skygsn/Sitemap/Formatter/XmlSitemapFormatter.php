<?php

namespace Skygsn\Sitemap\Formatter;

use Skygsn\Sitemap\Sitemap;

class XmlSitemapFormatter implements SitemapFormatter
{
    /**
     * @inheritdoc
     */
    public function formatIndex(Sitemap $sitemap)
    {
        return '<sitemap>
    <loc>' . $sitemap->getUrl() . '</loc>
</sitemap>';
    }

    /**
     * @param Sitemap $sitemap
     * @param UrlFormatter $urlFormatter
     * @return string
     */
    public function formatFull(Sitemap $sitemap, UrlFormatter $urlFormatter)
    {
        return '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . $this->getFormattedUrls($sitemap, $urlFormatter) . '
</urlset>';
    }

    /**
     * @param Sitemap $sitemap
     * @param UrlFormatter $urlFormatter
     * @return string
     */
    private function getFormattedUrls(Sitemap $sitemap, UrlFormatter $urlFormatter)
    {
        $result = '';

        foreach ($sitemap->getUrls() as $url) {
            $result .= $urlFormatter->format($url);
        }

        return $result;
    }
}