<?php

namespace Skygsn\Sitemap\Validator;

use Skygsn\Sitemap\Sitemap;

interface SitemapValidator
{
    /**
     * @param Sitemap $sitemap
     * @param ValidationResultsBag $validationResultsBag
     */
    public function validate(Sitemap $sitemap, ValidationResultsBag $validationResultsBag);
}