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
            '<url><loc>%s</loc><priority>%s</priority><changefreq>%s</changefreq></url>',
            $url->getLocation(),
            $url->getPriority(),
            $url->getChangeFrequency()
        );
    }
}