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
     * @param string $sitemapBaseUrl
     * @return Generator
     */
    public static function createXmlSitemapGenerator(string $directory, string $sitemapBaseUrl): Generator
    {
        return new Generator(
            new Config($sitemapBaseUrl),
            new FileSystemStorage($directory),
            new XmlSitemapFormatter(new XmlUrlFormatter()),
            new ValidationResultsBag()
        );
    }
}