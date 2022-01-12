<?php

namespace Skygsn\Sitemap;

use DateTime;
use DOMDocument;
use PHPUnit\Framework\TestCase;
use Skygsn\Sitemap\Formatter\XmlSitemapFormatter;
use Skygsn\Sitemap\Formatter\XmlUrlFormatter;
use Skygsn\Sitemap\Storage\MemoryStorage;
use Skygsn\Sitemap\Validator\ValidationResultsBag;

class GeneratorTest extends TestCase
{
    /**
     * @var MemoryStorage
     */
    private $storage;

    /**
     * @var Generator
     */
    private $generator;

    protected function setUp()
    {
        $this->storage = new MemoryStorage();
        $this->generator = new Generator(
            new Config('http://skygsn.com/sitemap'),
            $this->storage,
            new XmlSitemapFormatter(new XmlUrlFormatter()),
            new ValidationResultsBag()
        );
    }

    protected function tearDown()
    {
        $this->storage->clean();
    }

    /**
     * @test
     */
    public function create_NoSitemapGiven_DoesNothing()
    {
        $this->generator->create([]);

        $this->assertNull($this->storage->getResource());
    }

    /**
     * @test
     */
    public function create_GivenOneSitemap_CreatesFormattedXmlAndPersistsIt()
    {
        $sitemap = new Sitemap([
            new Url('http://skygsn.com/cheats/index.html', $this->createDateTimeFromString('2015-12-25')),
        ]);

        $this->generator->create([$sitemap]);

        $sitemapFromStorage = stream_get_contents($this->storage->getResource());

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas' .
            '/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sit' .
            'emaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"><url><loc>' .
            'http://skygsn.com/cheats/index.html</loc><lastmod>2015-12-25</lastmod></url></urlset>',
            $sitemapFromStorage
        );
    }

    /**
     * @test
     */
    public function create_GivenTwoSitemaps_CreatesIndexFileFormThem()
    {
        $sitemaps = [
            new Sitemap([
                new Url('http://skygsn.com/cheats/index.html', $this->createDateTimeFromString('2015-12-25'))
            ], 'cheats.xml'),
            new Sitemap([
                new Url('http://skygsn.com/videos/index.html', $this->createDateTimeFromString('2015-12-25'))
            ], 'videos.xml'),
        ];

        $this->generator->create($sitemaps);

        $sitemapFromStorage = stream_get_contents($this->storage->getResource());

        $this->assertEquals(
            '<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' .
            '<sitemap><loc>http://skygsn.com/sitemap/cheats.xml</loc></sitemap>' .
            '<sitemap><loc>http://skygsn.com/sitemap/videos.xml</loc></sitemap></sitemapindex>',
            $sitemapFromStorage
        );
    }

    /**
     * @param string $dateString
     * @return DateTime
     */
    private function createDateTimeFromString(string $dateString): DateTime
    {
        return DateTime::createFromFormat('Y-m-d', $dateString);
    }
}