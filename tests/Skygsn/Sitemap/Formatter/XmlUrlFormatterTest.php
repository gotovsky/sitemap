<?php

namespace Skygsn\Sitemap\Formatter;

use PHPUnit\Framework\TestCase;
use Skygsn\Sitemap\Url;

class XmlUrlFormatterTest extends TestCase
{
    /**
     * @test
     */
    public function format_UrlGiven_ReturnsXmlStructure()
    {
        $formatter = new XmlUrlFormatter();

        $url = new Url('http://skygsn.com/cheats/index.html', '2012-11-22');

        $expectedXml = sprintf(
            '<url><loc>%s</loc><priority>%s</priority><changefreq>%s</changefreq></url>',
            'http://skygsn.com/cheats/index.html',
            '0.5',
            'weekly'
        );

        $this->assertEquals($expectedXml, $formatter->format($url));
    }
}