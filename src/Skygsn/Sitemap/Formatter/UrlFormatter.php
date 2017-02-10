<?php

namespace Skygsn\Sitemap\Formatter;

use Skygsn\Sitemap\Url;

interface UrlFormatter
{
    /**
     * @param Url $url
     * @return string
     */
    public function format(Url $url);
}