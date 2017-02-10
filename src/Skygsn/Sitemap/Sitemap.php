<?php

namespace Skygsn\Sitemap;

class Sitemap
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $url;

    /**
     * @var Url[]
     */
    private $urls;

    /**
     * @var string
     */
    private $lastModified;

    /**
     * @param string $name
     * @param string $url
     * @param Url[] $urls
     * @param string $lastModified
     */
    public function __construct($name, $url, array $urls, $lastModified)
    {
        $this->name = $name;
        $this->url = $url;
        $this->urls = $urls;
        $this->lastModified = $lastModified;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Url[]
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * @return string
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}