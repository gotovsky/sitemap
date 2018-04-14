<?php

namespace Skygsn\Sitemap\Validator;

use Skygsn\Sitemap\Url;

interface UrlValidator
{
    /**
     * @param Url $url
     * @param ValidationResultsBag $validationResultsBag
     */
    public function validate(Url $url, ValidationResultsBag $validationResultsBag);
}