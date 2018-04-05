<?php

namespace Skygsn\Sitemap\Validator;

use Skygsn\Sitemap\Url;

class UrlLengthValidator implements UrlValidator
{
    const MAX_URL_LENGTH = 2048;

    /**
     * @inheritdoc
     */
    public function validate(Url $url, ValidationResultsBag $validationResultsBag)
    {
        if (mb_strlen($url->getLocation()) > self::MAX_URL_LENGTH) {
            $validationResultsBag->addError(sprintf(
                'Url %s exceeds %s length limit',
                $url->getLocation(),
                self::MAX_URL_LENGTH
            ));
        }
    }
}