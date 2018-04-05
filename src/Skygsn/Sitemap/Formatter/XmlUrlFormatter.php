<?php

namespace Skygsn\Sitemap\Formatter;

use Skygsn\Sitemap\Url;

class XmlUrlFormatter implements UrlFormatter
{
    /**
     * @inheritdoc
     */
    public function format(Url $url)
    {
        return sprintf(
            '<url><loc>%s</loc>%s%s%s</url>',
            $url->getLocation(),
            $this->formatLastModified($url),
            $this->formatChangeFrequency($url),
            $this->formatPriority($url)
        );
    }

    /**
     * @param Url $url
     * @return string
     */
    private function formatLastModified(Url $url): string
    {
        $lastModified = '';

        if ($url->getLastModified()) {
            $lastModified = sprintf('<lastmod>%s</lastmod>', $url->getLastModified()->format('Y-m-d'));
        }

        return $lastModified;
    }

    /**
     * @param Url $url
     * @return string
     */
    private function formatChangeFrequency(Url $url): string
    {
        $changeFrequency = '';

        if ($url->getPriority()) {
            $changeFrequency = sprintf('<changefreq>%s</changefreq>', $url->getChangeFrequency());
        }

        return $changeFrequency;
    }

    /**
     * @param Url $url
     * @return string
     */
    private function formatPriority(Url $url): string
    {
        $priority = '';

        if ($url->getPriority()) {
            $priority = sprintf('<priority>%s</priority>', $url->getPriority());
        }

        return $priority;
    }
}