<?php

namespace Skygsn\Sitemap;

use DateTime;

class Sitemap
{
    /**
     * @var string
     */
    private $name;

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
     * @param Url[] $urls
     * @param string $lastModified
     */
    public function __construct(array $urls, string $name = '', DateTime $lastModified = null)
    {
        $this->name = $name;
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
}