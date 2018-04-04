<?php

namespace Skygsn\Sitemap;

use PHPUnit\Framework\TestCase;
use Skygsn\Sitemap\Formatter\XmlSitemapFormatter;
use Skygsn\Sitemap\Formatter\XmlUrlFormatter;
use Skygsn\Sitemap\Storage\MemoryStorage;

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
            new Config(),
            $this->storage,
            new XmlSitemapFormatter(),
            new XmlUrlFormatter()
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
    public function test1()
    {
        $sitemap = new Sitemap([
            new Url('http://skygsn.com/cheats/index.html', '2015-22-22'),
            new Url('http://skygsn.com/games/index.html', '2015-22-22'),
        ], 'main', '2015-22-22');

        $this->generator->create([$sitemap]);

        $sitemapFromStorage = stream_get_contents($this->storage->getResource());

        $this->assertEquals('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"><url><loc>http://skygsn.com/cheats/index.html</loc><priority>0.5</priority><changefreq>weekly</changefreq></url><url><loc>http://skygsn.com/games/index.html</loc><priority>0.5</priority><changefreq>weekly</changefreq></url></urlset>', $sitemapFromStorage);
    }
}