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

        $url = new Url('http://skygsn.com/cheats/index.html');

        $expectedXml = sprintf(
            '<url><loc>%s</loc></url>',
            'http://skygsn.com/cheats/index.html'
        );

        $this->assertEquals($expectedXml, $formatter->format($url));
    }
}