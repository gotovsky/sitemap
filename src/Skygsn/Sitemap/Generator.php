<?php

namespace Skygsn\Sitemap;

use Skygsn\Sitemap\Formatter\SitemapFormatter;
use Skygsn\Sitemap\Formatter\XmlSitemapFormatter;
use Skygsn\Sitemap\Formatter\XmlUrlFormatter;

class Generator
{
    /**
     * @param Sitemap[] $sitemaps
     * @return string
     */
    public function create(array $sitemaps)
    {
        $formatter = new XmlSitemapFormatter();

        foreach ($sitemaps as $sitemap) {
            $this->createSitemapFile($formatter->formatFull($sitemap, new XmlUrlFormatter()), $sitemap->getName());
        }

        $this->createIndicesFile($this->createSitemapIndices($sitemaps, $formatter));
    }

    /**
     * @param array $sitemaps
     * @param SitemapFormatter $formatter
     * @return string
     */
    private function createSitemapIndices(array $sitemaps, SitemapFormatter $formatter)
    {
        $sitemapIndices = '<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
';

        foreach ($sitemaps as $sitemap) {
            $sitemapIndices .= $formatter->formatIndex($sitemap);
        }

        $sitemapIndices .= '
</sitemapindex>';

        return $sitemapIndices;
    }

    /**
     * @param string $sitemapIndices
     */
    private function createIndicesFile($sitemapIndices)
    {
        $file = fopen(dirname($_SERVER['SCRIPT_FILENAME']) . '/../web/sitemap/sitemap.xml', 'w+');
        fputs($file, $sitemapIndices);
        fclose($file);
    }

    /**
     * @param string $sitemap
     * @param string $name
     */
    private function createSitemapFile($sitemap, $name)
    {
        $file = fopen(dirname($_SERVER['SCRIPT_FILENAME']) . '/../web/sitemap/' . $name . '.xml', 'w+');
        fputs($file, $sitemap);
        fclose($file);
    }
}