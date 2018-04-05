<?php

namespace Skygsn\Sitemap;

use Skygsn\Sitemap\Formatter\XmlSitemapFormatter;
use Skygsn\Sitemap\Formatter\XmlUrlFormatter;
use Skygsn\Sitemap\Storage\FileSystemStorage;
use Skygsn\Sitemap\Validator\ValidationResultsBag;

class GeneratorFactory
{
    /**
     * @param string $directory
     * @return Generator
     */
    public static function createXmlSitemapGenerator($directory): Generator
    {
        return new Generator(
            new Config(),
            new FileSystemStorage($directory),
            new XmlSitemapFormatter(new XmlUrlFormatter()),
            new ValidationResultsBag()
        );
    }
}