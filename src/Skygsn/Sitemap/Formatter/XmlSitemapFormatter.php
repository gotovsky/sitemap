<?php

namespace Skygsn\Sitemap\Formatter;

use DOMDocument;
use Skygsn\Sitemap\Config;
use Skygsn\Sitemap\Sitemap;
use Skygsn\Sitemap\Validator\ValidationResultsBag;

class XmlSitemapFormatter implements SitemapFormatter
{
    /**
     * @var UrlFormatter
     */
    private $urlFormatter;

    /**
     * @param UrlFormatter $urlFormatter
     */
    public function __construct(UrlFormatter $urlFormatter)
    {
        $this->urlFormatter = $urlFormatter;
    }

    /**
     * @inheritdoc
     */
    public function formatIndex(array $sitemapNames, Config $config): string
    {
        $sitemapUrls = [];

        foreach ($sitemapNames as $sitemapName) {
            $sitemapUrls[] = sprintf(
                '<sitemap><loc>%s</loc></sitemap>',
                $config->getSitemapBaseUrl() . '/' . $sitemapName
            );
        }

        $xml = sprintf('<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/' .
            'sitemap/0.9">%s</sitemapindex>',
            implode('', $sitemapUrls)
        );

        return $this->createFormattedXml($xml)->saveXML();
    }

    /**
     * @inheritdoc
     */
    public function format(Sitemap $sitemap, ValidationResultsBag $validationResultsBag, Config $config): string
    {
        foreach ($config->getSitemapValidators() as $sitemapValidator) {
            $sitemapValidator->validate($sitemap, $this->$validationResultsBag);
        }

        $xml = sprintf('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/' .
            'sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' .
            ' xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' .
            ' http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">%s</urlset>',
            $this->getFormattedUrls($sitemap, $validationResultsBag, $config)
        );

        return $this->createFormattedXml($xml)->saveXML();
    }

    /**
     * @param Sitemap $sitemap
     * @param ValidationResultsBag $validationResultsBag
     * @param Config $config
     * @return string
     */
    private function getFormattedUrls(
        Sitemap $sitemap,
        ValidationResultsBag $validationResultsBag,
        Config $config
    ): string {
        $formattedUrls = [];

        foreach ($sitemap->getUrls() as $url) {
            foreach ($config->getUrlValidators() as $validator) {
                $validator->validate($url, $validationResultsBag);
            }

            $formattedUrls[] = $this->urlFormatter->format($url);
        }

        return implode('', $formattedUrls);
    }

    /**
     * @param string $xml
     * @return DOMDocument
     */
    private function createFormattedXml(string $xml): DOMDocument
    {
        $document = new DOMDocument('1.0', 'UTF-8');
        $document->formatOutput = true;
        $document->loadXML($xml);

        return $document;
    }
}