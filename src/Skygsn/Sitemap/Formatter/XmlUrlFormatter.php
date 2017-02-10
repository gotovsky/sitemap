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
        return "
    <url>
        <loc>" . $url->getLocation() . '</loc>
        <priority>' . $url->getPriority() . '</priority>
        <changefreq>' . $url->getChangeFrequency() . '</changefreq>
    </url>';
    }
}