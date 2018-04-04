<?php

namespace Skygsn\Sitemap\Validator;

use Skygsn\Sitemap\Sitemap;

interface SitemapValidator
{
    /**
     * @param Sitemap $sitemap
     */
    public function validate(Sitemap $sitemap);
}